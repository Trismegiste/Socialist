<?php

/*
 * Socialist
 */

namespace tests\database;

use Trismegiste\Socialist\User;
use Trismegiste\Socialist\ConcreteAuthor;

/**
 * UserTest tests the persistence of a User
 */
class UserTest extends MongoDbTestCase
{

    protected $sut;

    protected function setUp()
    {
        parent::setUp();
        $this->sut = new User(new ConcreteAuthor("spock"));

        $this->sut->addFan(new ConcreteAuthor('chapel'));
        $this->sut->addFan(new ConcreteAuthor('kirk'));
        $this->sut->addFan(new ConcreteAuthor('mccoy'));
    }

    public function testCreate()
    {
        $this->collection->drop();
        $this->invocation->persist($this->sut);
        $pk = $this->sut->getId();
        $this->assertInstanceOf('MongoId', $pk);

        return $pk;
    }

    /**
     * @depends testCreate
     */
    public function testRestore(\MongoId $pk)
    {
        $restore = $this->invocation->findByPk((string) $pk);
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
        $obj->addFan(new ConcreteAuthor('scotty'));
        $this->invocation->persist($obj);

        return $obj->getId();
    }

    /**
     * @depends testEdit
     */
    public function testRestoreEdited(\MongoId $pk)
    {
        $restore = $this->invocation->findByPk((string) $pk);
        $this->assertEquals(4, $restore->getFanCount());
    }

}