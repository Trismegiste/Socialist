<?php

/*
 * Socialist
 */

namespace tests\model;

use Trismegiste\Socialist\Repeat;

/**
 * RepeatTest tests Repeat
 */
class RepeatTest extends PublishingTest
{

    protected $embedded;
    protected $otherAuthor;

    protected function setUp(): void
    {
        $this->otherAuthor = $this->createMock('Trismegiste\Socialist\AuthorInterface');

        $this->embedded = $this->getMockBuilder('Trismegiste\Socialist\Publishing')
            ->setConstructorArgs([$this->otherAuthor])
            ->setMethods(null)
            ->getMock();
        parent::setUp();
    }

    protected function createSUT()
    {
        return new Repeat($this->mockAuthorInterface);
    }

    public function testSetter()
    {
        $this->sut->setEmbedded($this->embedded);
        $this->assertEquals($this->embedded, $this->sut->getEmbedded());
    }

    public function testCleanEmbedded()
    {
        $this->embedded->addFan($this->fan);
        $this->assertEquals(1, $this->embedded->getFanCount());
        $reporter = $this->createMock('Trismegiste\Socialist\AuthorInterface');
        $this->embedded->report($reporter);
        $this->assertEquals(1, $this->embedded->getReportedCount());
        $this->embedded->attachCommentary($this->message);
        $this->assertCount(1, $this->embedded->getCommentaryIterator());

        $this->sut->setEmbedded($this->embedded);
        // original does not change :
        $this->assertEquals(1, $this->embedded->getFanCount());
        $this->assertEquals(1, $this->embedded->getReportedCount());
        $this->assertCount(1, $this->embedded->getCommentaryIterator());
        // embedded is cleaned :
        $this->assertEquals(0, $this->sut->getEmbedded()->getFanCount());
        $this->assertEquals(0, $this->sut->getEmbedded()->getReportedCount());
        $this->assertCount(0, $this->sut->getEmbedded()->getCommentaryIterator());
    }

    public function testNoRecursion()
    {
        // Yo dawg, I heard U like retweet so I put....
        $retweet = new Repeat($this->mockAuthorInterface);
        $retweet->setEmbedded($this->embedded);

        $this->sut->setEmbedded($retweet);
        $this->assertEquals($this->embedded, $this->sut->getEmbedded());
    }

    public function testEditable()
    {
        $this->assertFalse($this->sut->isEditable());
    }

    public function testAuthorCannotRepeatHimself()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('repeat yourself');
        $this->otherAuthor->expects($this->any())
            ->method('isEqual')
            ->with($this->isInstanceOf('Trismegiste\Socialist\AuthorInterface'))
            ->will($this->returnValue(true));

        $this->sut->setEmbedded($this->embedded);
    }

    public function testAuthorCannotRepeatARepeatFromOtherOfHimself()
    {
        $this->expectException(\DomainException::class);
        $this->expectExceptionMessage('repeat yourself');
        // I'm equal to myself :
        $this->mockAuthorInterface->expects($this->any())
            ->method('isEqual')
            ->with($this->equalTo($this->mockAuthorInterface))
            ->will($this->returnValue(true));

        // a content from me...
        $fromMe = $this->getMockBuilder('Trismegiste\Socialist\Publishing')
            ->setConstructorArgs([$this->mockAuthorInterface])
            ->setMethods(null)
            ->getMock();

        // ... is retweeted by other...
        $retweetOfMe = new Repeat($this->otherAuthor);
        $retweetOfMe->setEmbedded($fromMe);

        // ... but it throws an exception anyway if I try to repeat the retweet
        $this->sut->setEmbedded($retweetOfMe);
    }

    public function testGetSourceIdWhenNoEmbedded()
    {
        $this->assertEquals(null, $this->sut->getSourceId());
    }

    public function testGetSourceId()
    {
        $pk = new \MongoDB\BSON\ObjectId();
        $pkEmbed = new \MongoDB\BSON\ObjectId();
        $this->embedded->setPk($pkEmbed);
        $this->sut->setPk($pk);
        $this->sut->setEmbedded($this->embedded);
        $this->assertEquals($pkEmbed, $this->sut->getSourceId());
        $this->assertNotEquals($pk, $this->sut->getSourceId());
    }

    public function testFakeIncrement()
    {
        $this->sut->setEmbedded($this->embedded);
        $this->assertEquals(1, $this->sut->getRepeatedCount());
    }

}
