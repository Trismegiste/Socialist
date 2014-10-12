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
        $this->message = $this->createCommentary();

        parent::setUp();
    }

    protected function createSUT()
    {
        return $this->getMockBuilder('Trismegiste\Socialist\Publishing')
                        ->setConstructorArgs([$this->mockAuthorInterface])
                        ->setMethods(NULL)
                        ->getMock();
    }

    protected function createCommentary()
    {
        return $this->getMockBuilder('Trismegiste\Socialist\Commentary')
                        ->disableOriginalConstructor()
                        ->setMethods(['setUuid', 'getUuid'])
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

    public function testCommentarySorting()
    {
        $this->sut->attachCommentary($this->message);
        $this->assertCount(1, $this->sut->getCommentary());

        $recentMessage = $this->createCommentary();
        $this->sut->attachCommentary($recentMessage);
        $this->assertCount(2, $this->sut->getCommentary());

        $comments = $this->sut->getCommentary();
        $this->assertEquals($recentMessage, $comments[0]);
        $this->assertEquals($this->message, $comments[1]);
    }

    public function testGetByUuid()
    {
        $this->message->expects($this->once())
                ->method('setUuid')
                ->with($this->isInstanceOf('MongoId'));
        $uuid = new \MongoId();
        $this->message->expects($this->once())
                ->method('getUuid')
                ->will($this->returnValue($uuid));

        $this->sut->attachCommentary($this->message);
        $found = $this->sut->getCommentaryByUuid((string) $uuid);

        $this->assertEquals($this->message, $found);
    }

    public function testGetByUuidNotFound()
    {
        $this->message->expects($this->once())
                ->method('getUuid')
                ->will($this->returnValue(new \MongoId()));

        $this->sut->attachCommentary($this->message);

        $this->assertNull($this->sut->getCommentaryByUuid((string) (new \MongoId())));
    }

    public function testRemoveSubEntities()
    {
        $this->sut->addFan($this->fan);
        $this->sut->attachCommentary($this->message);
        $this->sut->report($this->fan);

        $this->assertAttributeCount(1, 'abusive', $this->sut);
        $this->assertCount(1, $this->sut->getCommentary());
        $this->assertEquals(1, $this->sut->getFanCount());

        $this->sut->removeSubEntities();

        $this->assertAttributeCount(0, 'abusive', $this->sut);
        $this->assertCount(0, $this->sut->getCommentary());
        $this->assertEquals(0, $this->sut->getFanCount());
    }

}
