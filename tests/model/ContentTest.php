<?php

/*
 * Socialist
 */

namespace tests\model;

use DateTime;
use Trismegiste\Socialist\AuthorInterface;
use Trismegiste\Socialist\Content;

/**
 * ContentTest tests Content
 */
class ContentTest extends FamousTestTemplate
{

    protected $mockAuthorInterface;

    protected function setUp(): void
    {
        $this->mockAuthorInterface = $this->createMock(AuthorInterface::class);
        $this->mockAuthorInterface->expects($this->any())
            ->method('getNickname')
            ->will($this->returnValue('ncc1701'));

        parent::setUp();
    }

    public function testAuthorInterface()
    {
        $this->assertEquals($this->mockAuthorInterface, $this->sut->getAuthor());
    }

    protected function createSUT()
    {
        return $this->getMockBuilder(Content::class)
                ->setConstructorArgs([$this->mockAuthorInterface])
                ->setMethods(NULL)
                ->getMock();
    }

    public function testTimestamp()
    {
        $this->assertNotNull($this->sut->getLastEdited());
        $newDate = new DateTime('tomorrow 14:00');
        $this->sut->setLastEdited($newDate);
        $this->assertEquals($newDate, $this->sut->getLastEdited());
    }

    public function testCreationDate()
    {
        $this->assertNotNull($this->sut->getCreatedAt());
        $this->assertGreaterThanOrEqual($this->sut->getCreatedAt()->getTimestamp(), time());
    }

    public function testReportAbusive()
    {
        $reporter = $this->createMock(AuthorInterface::class);
        $this->sut->report($reporter);
        $this->assertEquals(1, $this->sut->getReportedCount());
        $this->sut->report($reporter);
        $this->assertEquals(1, $this->sut->getReportedCount());

        $this->assertTrue($this->sut->isReportedBy($reporter));

        $this->sut->cancelReport($reporter);
        $this->assertEquals(0, $this->sut->getReportedCount());
        $this->assertFalse($this->sut->isReportedBy($reporter));
    }

}
