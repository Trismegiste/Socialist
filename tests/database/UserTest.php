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
    }

    public function testSave()
    {
        $this->invocation->persist($this->sut);
    }

}