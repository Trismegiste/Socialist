<?php

/*
 * Socialist
 */

namespace tests\model;

use Trismegiste\Socialist\Content;

/**
 * ContentTest tests Content
 */
class ContentTest extends FamousTestTemplate
{

    protected $mockAuthor;

    protected function setUp()
    {
        $this->mockAuthor = $this->getMock('Trismegiste\Socialist\Author');
        $this->mockAuthor->expects($this->any())
                ->method('getNickname')
                ->will($this->returnValue('ncc1701'));

        parent::setUp();
    }

    public function testAuthor()
    {
        $this->assertEquals($this->mockAuthor, $this->sut->getPublisher());
    }

    protected function createSUT()
    {
        return $this->getMockBuilder('Trismegiste\Socialist\Content')
                        ->setConstructorArgs([$this->mockAuthor])
                        ->setMethods(NULL)
                        ->getMock();
    }

}