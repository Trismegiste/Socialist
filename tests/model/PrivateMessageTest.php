<?php

/*
 * Socialist
 */

namespace tests\model;

use Trismegiste\Socialist\PrivateMessage;

/**
 * PrivateMessageTest tests PrivateMessage
 */
class PrivateMessageTest extends \PHPUnit\Framework\TestCase
{

    /** @var \Trismegiste\Socialist\PrivateMessage */
    protected $sut;

    /** @var \Trismegiste\Socialist\AuthorInterface */
    protected $sender;

    /** @var \Trismegiste\Socialist\AuthorInterface */
    protected $target;

    protected function setUp(): void
    {
        $this->sender = $this->createMock('Trismegiste\Socialist\AuthorInterface');
        $this->target = $this->createMock('Trismegiste\Socialist\AuthorInterface');
        $this->sut = new PrivateMessage($this->sender, $this->target);
    }

    public function testVertices()
    {
        $this->assertEquals($this->sender, $this->sut->getSender());
        $this->assertEquals($this->target, $this->sut->getTarget());
    }

    public function testIsRead()
    {
        $this->assertFalse($this->sut->isRead());
        $this->sut->markAsRead();
        $this->assertTrue($this->sut->isRead());
    }

    public function testContent()
    {
        $this->sut->setMessage('Engage !');
        $this->assertEquals('Engage !', $this->sut->getMessage());
    }

    public function testNoLoopEdge()
    {
        $this->expectException(\LogicException::class);
        $loop = $this->createMock('Trismegiste\Socialist\AuthorInterface');
        new PrivateMessage($loop, $loop);
    }

    public function testTimestamp()
    {
        $this->assertInstanceOf('DateTime', $this->sut->getSentAt());
    }

}
