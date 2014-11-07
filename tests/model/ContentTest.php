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
        $this->assertEquals($this->mockAuthorInterface, $this->sut->getAuthor());
    }

    protected function createSUT()
    {
        return $this->getMockBuilder('Trismegiste\Socialist\Content')
                        ->setConstructorArgs([$this->mockAuthorInterface])
                        ->setMethods(NULL)
                        ->getMock();
    }

    public function testTimestamp()
    {
        $this->assertNotNull($this->sut->getLastEdited());
        $newDate = new \DateTime('tomorrow 14:00');
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
        $reporter = $this->getMock('Trismegiste\Socialist\AuthorInterface');
        $this->sut->report($reporter);
        $this->assertAttributeCount(1, 'abusive', $this->sut);
        $this->sut->report($reporter);
        $this->assertAttributeCount(1, 'abusive', $this->sut);

        $this->assertTrue($this->sut->isReportedBy($reporter));

        $this->sut->cancelReport($reporter);
        $this->assertAttributeCount(0, 'abusive', $this->sut);
        $this->assertFalse($this->sut->isReportedBy($reporter));
    }

}
