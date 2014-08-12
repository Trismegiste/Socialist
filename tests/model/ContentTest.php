<?php

/*
 * Socialist
 */

namespace tests\model;

use Trismegiste\Socialist\Content;

/**
 * ContentTest tests Content
 */
class ContentTest extends \PHPUnit_Framework_TestCase
{

    protected $sut;
    protected $mockAuthor;

    protected function setUp()
    {
        $this->mockAuthor = $this->getMock('Trismegiste\Socialist\Author');
        $this->mockAuthor->expects($this->any())
                ->method('getNickname')
                ->will($this->returnValue('ncc1701'));

        $this->sut = $this->getMockBuilder('Trismegiste\Socialist\Content')
                ->setConstructorArgs([$this->mockAuthor])
                ->setMethods(NULL)
                ->getMock();
    }

    public function testAuthor()
    {
        $this->assertEquals($this->mockAuthor, $this->sut->getPublisher());
    }

}