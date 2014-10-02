<?php

/*
 * Socialist
 */

namespace tests\model;

use Trismegiste\Socialist\Status;

/**
 * StatusTest tests SimplePost
 */
class StatusTest extends PublishingTest
{

    protected function createSUT()
    {
        return new Status($this->mockAuthorInterface);
    }

    public function getFixtures()
    {
        return [[7, 43, 8, 'Some fancy comment']];
    }

    /**
     * @dataProvider getFixtures
     */
    public function testProperties($x, $y, $z, $msg)
    {
        $this->sut->setMessage($msg);
        $this->assertEquals($msg, $this->sut->getMessage());
        $this->assertNotEquals($x, $this->sut->getMessage());

        $this->sut->setLongitude($x);
        $this->assertEquals($x, $this->sut->getLongitude());
        $this->assertNotEquals($y, $this->sut->getLongitude());

        $this->sut->setLatitude($y);
        $this->assertEquals($y, $this->sut->getLatitude());
        $this->assertNotEquals($x, $this->sut->getLatitude());

        $this->sut->setZoom($z);
        $this->assertEquals($z, $this->sut->getZoom());
        $this->assertNotEquals($y, $this->sut->getZoom());
    }

}
