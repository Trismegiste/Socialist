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

    protected function setUp()
    {
        $this->embedded = $this->getMockBuilder('Trismegiste\Socialist\Publishing')
                ->disableOriginalConstructor()
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
        $reporter = $this->getMock('Trismegiste\Socialist\AuthorInterface');
        $this->embedded->report($reporter);
        $this->assertAttributeCount(1, 'abusive', $this->embedded);
        $this->embedded->attachCommentary($this->message);
        $this->assertCount(1, $this->embedded->getCommentaryIterator());

        $this->sut->setEmbedded($this->embedded);
        // original does not change :
        $this->assertEquals(1, $this->embedded->getFanCount());
        $this->assertAttributeCount(1, 'abusive', $this->embedded);
        $this->assertCount(1, $this->embedded->getCommentaryIterator());
        // embedded is cleaned :
        $this->assertEquals(0, $this->sut->getEmbedded()->getFanCount());
        $this->assertAttributeCount(0, 'abusive', $this->sut->getEmbedded());
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

}
