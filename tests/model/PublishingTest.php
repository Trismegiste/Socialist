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
                        ->setConstructorArgs([$this->mockAuthor])
                        ->setMethods(NULL)
                        ->getMock();
    }

    public function testAttachCommentary()
    {
        $this->sut->attachCommentary($this->message);
    }

    public function testDetachCommentary()
    {
        $this->sut->detachCommentary($this->message);
    }

}