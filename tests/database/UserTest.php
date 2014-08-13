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

    protected function setUp()
    {
        parent::setUp();
        $this->sut = new User(new Author("spock"));

        $this->sut->addFan(new Author('chapel'));
        $this->sut->addFan(new Author('kirk'));
        $this->sut->addFan(new Author('mccoy'));
    }

    public function testCreate()
    {
        $this->collection->drop();
        $this->repo->persist($this->sut);
        $pk = $this->sut->getId();
        $this->assertInstanceOf('MongoId', $pk);

        return $pk;
    }

    /**
     * @depends testCreate
     */
    public function testRestore(\MongoId $pk)
    {
        $restore = $this->repo->findByPk((string) $pk);
        $this->sut->setId($pk);
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
        $this->repo->persist($obj);

        return $obj->getId();
    }

    /**
     * @depends testEdit
     */
    public function testRestoreEdited(\MongoId $pk)
    {
        $restore = $this->repo->findByPk((string) $pk);
        $this->assertEquals(4, $restore->getFanCount());

        return $restore->getId();
    }

    /**
     * @depends testRestoreEdited
     */
    public function testFollowed(\MongoId $pk)
    {
        $restore = $this->repo->findByPk((string) $pk);

        // adding a follower
        $restore->follow($restore); // to make sure there is a cycle
        $this->repo->persist($restore);
    }

}