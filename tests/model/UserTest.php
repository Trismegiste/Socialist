<?php

/*
 * Socialist
 */

namespace tests\model;

use Trismegiste\Socialist\User;

/**
 * UserTest tests User
 */
class UserTest extends \PHPUnit_Framework_TestCase
{

    protected $sut;
    protected $fan;
    protected $author;

    protected function setUp()
    {
        $this->author = $this->getMock("Trismegiste\Socialist\Author");
        $this->author->expects($this->any())
                ->method('getNickname')
                ->will($this->returnValue('kirk'));

        $this->fan = $this->getMock("Trismegiste\Socialist\Author");
        $this->fan->expects($this->any())
                ->method('getNickname')
                ->will($this->returnValue('janice'));

        $this->sut = new User($this->author);
    }

    public function testAuthor()
    {
        $this->assertEquals($this->author, $this->sut->getAuthor());
    }

    public function testAddRemoveFan()
    {
        $this->sut->addFan($this->fan);
        $this->assertEquals(1, $this->sut->getFanCount());
        $this->assertTrue($this->sut->hasFan($this->fan));

        $this->sut->addFan($this->fan);
        $this->assertEquals(1, $this->sut->getFanCount());

        $this->sut->removeFan($this->fan);
        $this->assertEquals(0, $this->sut->getFanCount());
    }

}