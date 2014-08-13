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
        $this->author = $this->getMock("Trismegiste\Socialist\AuthorInterface");
        $this->author->expects($this->any())
                ->method('getNickname')
                ->will($this->returnValue('kirk'));

        parent::setUp();
    }

    public function testAuthorInterface()
    {
        $this->assertEquals($this->author, $this->sut->getAuthorInterface());
    }

    protected function createSUT()
    {
        return new User($this->author);
    }

}