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
    protected $mockAuthor;

    protected function setUp()
    {
        $this->mockAuthor = $this->getMock("Trismegiste\Socialist\Author");
        $this->mockAuthor->expects($this->any())
                ->method('getNickname')
                ->will($this->returnValue('ncc1701'));
        $this->sut = new User($this->mockAuthor);
    }

    public function testAuthor()
    {
        $this->assertEquals($this->mockAuthor, $this->sut->getAuthor());
    }

    public function testAddRemoveFan()
    {
        $this->sut->addFan($this->mockAuthor);
        $this->assertEquals(1, $this->sut->getFanCount());
        $this->assertTrue($this->sut->hasFan($this->mockAuthor));

        $this->sut->addFan($this->mockAuthor);
        $this->assertEquals(1, $this->sut->getFanCount());

        $this->sut->removeFan($this->mockAuthor);
        $this->assertEquals(0, $this->sut->getFanCount());
    }

}