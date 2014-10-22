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
        $this->assertEquals(0, $this->sut->getCommentaryCount());
        $this->sut->attachCommentary($this->message);
        $this->assertEquals(1, $this->sut->getCommentaryCount());
    }

    public function testDetachCommentary()
    {
        $this->assertEquals(0, $this->sut->getCommentaryCount());
        $this->sut->attachCommentary($this->message);
        $this->assertEquals(1, $this->sut->getCommentaryCount());
        $this->sut->detachCommentary($this->message);
        $this->assertEquals(0, $this->sut->getCommentaryCount());
        $this->sut->detachCommentary($this->message);
    }

    public function testCommentarySorting()
    {
        $this->sut->attachCommentary($this->message);
        $this->assertEquals(1, $this->sut->getCommentaryCount());

        $recentMessage = $this->createCommentary();
        $this->sut->attachCommentary($recentMessage);
        $this->assertEquals(2, $this->sut->getCommentaryCount());

        $comments = iterator_to_array($this->sut->getCommentaryIterator());
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
        $this->assertEquals(1, $this->sut->getCommentaryCount());
        $this->assertEquals(1, $this->sut->getFanCount());

        $this->sut->removeSubEntities();

        $this->assertAttributeCount(0, 'abusive', $this->sut);
        $this->assertEquals(0, $this->sut->getCommentaryCount());
        $this->assertEquals(0, $this->sut->getFanCount());
    }

    public function testEditable()
    {
        $this->assertTrue($this->sut->isEditable());
    }

    public function testGetSourceId()
    {
        $pk = new \MongoId();
        $this->sut->setId($pk);
        $this->assertEquals($pk, $this->sut->getSourceId());
    }

    public function testRepeatedCount()
    {
        $this->assertEquals(0, $this->sut->getRepeatedCount());
    }

}
