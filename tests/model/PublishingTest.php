<?php

/*
 * Socialist
 */

namespace tests\model;

/**
 * PublishingTest tests Publishing
 */
class PublishingTest extends ContentTest
{

    protected $message;

    protected function setUp()
    {
        $this->message = $this->getMockBuilder('Trismegiste\Socialist\Commentary')
                ->disableOriginalConstructor()
                ->getMock();

        parent::setUp();
    }

    protected function createSUT()
    {
        return $this->getMockBuilder('Trismegiste\Socialist\Publishing')
                        ->setConstructorArgs([$this->mockAuthorInterface])
                        ->setMethods(NULL)
                        ->getMock();
    }

    public function testAttachCommentary()
    {
        $this->assertCount(0, $this->sut->getCommentary());
        $this->sut->attachCommentary($this->message);
        $this->assertCount(1, $this->sut->getCommentary());
    }

    public function testDetachCommentary()
    {
        $this->assertCount(0, $this->sut->getCommentary());
        $this->sut->attachCommentary($this->message);
        $this->assertCount(1, $this->sut->getCommentary());
        $this->sut->detachCommentary($this->message);
        $this->assertCount(0, $this->sut->getCommentary());
        $this->sut->detachCommentary($this->message);
    }

}