<?php

/*
 * Socialist
 */

namespace tests\model;

use Trismegiste\Socialist\Video;

/**
 * VideoTest tests Video
 */
class VideoTest extends PublishingTest
{

    protected function createSUT()
    {
        return new Video($this->mockAuthorInterface);
    }

    public function getFixtures()
    {
        return [['http://youtu.be/v/123456', 'youtube']];
    }

    /**
     * @dataProvider getFixtures
     */
    public function testProperties($url, $template)
    {
        $this->sut->setUrl($url);
        $this->assertEquals($url, $this->sut->getUrl());
        $this->assertNotEquals('yop', $this->sut->getUrl());

        $this->assertEquals($template, $this->sut->getTemplateName());
    }

}
