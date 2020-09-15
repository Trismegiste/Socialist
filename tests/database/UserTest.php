<?php

/*
 * Socialist
 */

namespace tests\database;

use Trismegiste\Socialist\User;
use Trismegiste\Socialist\Author;

/**
 * UserTest tests the persistence of a User
 */
class UserTest extends MongoDbTestCase
{

    protected $sut;

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = new User(new Author("spock"));

        $this->sut->addFan(new Author('chapel'));
        $this->sut->addFan(new Author('kirk'));
        $this->sut->addFan(new Author('mccoy'));
    }

    public function testCreate()
    {
        $this->resetCollection();
        $this->repo->save($this->sut);
        $pk = $this->sut->getPk();
        $this->assertInstanceOf(\MongoDB\BSON\ObjectId::class, $pk);

        return $pk;
    }

    /**
     * @depends testCreate
     */
    public function testRestore(\MongoDB\BSON\ObjectId $pk)
    {
        $restore = $this->repo->load((string) $pk);
        $this->sut->setPk($pk);
        $this->assertEquals($this->sut, $restore);
        $this->assertEquals(3, $restore->getFanCount());

        return $restore;
    }

    /**
     * @depends testRestore
     */
    public function testEdit(User $obj)
    {
        $obj->addFan(new Author('scotty'));
        $this->repo->save($obj);
        $this->assertNotNull($obj->getPk());

        return $obj->getPk();
    }

    /**
     * @depends testEdit
     */
    public function testRestoreEdited(\MongoDB\BSON\ObjectId $pk)
    {
        $restore = $this->repo->load((string) $pk);
        $this->assertEquals(4, $restore->getFanCount());

        return $restore->getPk();
    }

    /**
     * @depends testRestoreEdited
     */
    public function testFollowed(\MongoDB\BSON\ObjectId $pk)
    {
        $restore = $this->repo->load((string) $pk);

        // adding a follower
        $guy = new User(new Author("pike"));
        $this->repo->save($guy);
        $this->assertNotNull($guy->getPk());
        $guy->follow($restore);
        $restore->follow($guy); // to make sure there is a cycle
        $this->repo->save($restore);

        return $restore->getPk();
    }

    /**
     * @depends testFollowed
     */
    public function testFollowedPersistence(\MongoDB\BSON\ObjectId $pk)
    {
        $restore = $this->repo->load((string) $pk);

        $this->assertEquals(1, $restore->getFollowingCount());
        $this->assertEquals(1, $restore->getFollowerCount());
        $this->assertCount(1, $restore->getFriendIterator());
        $this->assertEquals('pike', $restore->getFriendIterator()->key());
    }

}
