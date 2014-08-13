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

    protected $mockAuthorInterface;

    protected function setUp()
    {
        $this->mockAuthorInterface = $this->getMock('Trismegiste\Socialist\AuthorInterface');
        $this->mockAuthorInterface->expects($this->any())
                ->method('getNickname')
                ->will($this->returnValue('ncc1701'));

        parent::setUp();
    }

    public function testAuthorInterface()
    {
        $this->assertEquals($this->mockAuthorInterface, $this->sut->getPublisher());
    }

    protected function createSUT()
    {
        return $this->getMockBuilder('Trismegiste\Socialist\Content')
                        ->setConstructorArgs([$this->mockAuthorInterface])
                        ->setMethods(NULL)
                        ->getMock();
    }

}