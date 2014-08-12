<?php

/*
 * Socialist
 */

namespace tests\model;

use Trismegiste\Socialist\User;

/**
 * UserTest tests User
 */
class UserTest extends FamousTestTemplate
{

    protected $author;

    protected function setUp()
    {
        $this->author = $this->getMock("Trismegiste\Socialist\Author");
        $this->author->expects($this->any())
                ->method('getNickname')
                ->will($this->returnValue('kirk'));

        parent::setUp();
    }

    public function testAuthor()
    {
        $this->assertEquals($this->author, $this->sut->getAuthor());
    }

    protected function createSUT()
    {
        return new User($this->author);
    }

}