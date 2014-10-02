<?php

/*
 * Socialist
 */

namespace tests\model;

use Trismegiste\Socialist\SmallTalk;

/**
 * SmallTalkTest tests SmallTalk
 */
class SmallTalkTest extends PublishingTest
{

    protected function createSUT()
    {
        return new SmallTalk($this->mockAuthorInterface);
    }

    public function getFixtures()
    {
        return [['Elephant talk']];
    }

    /**
     * @dataProvider getFixtures
     */
    public function testProperties($msg)
    {
        $this->sut->setMessage($msg);
        $this->assertEquals($msg, $this->sut->getMessage());
        $this->assertNotEquals('yop', $this->sut->getMessage());
    }

}
