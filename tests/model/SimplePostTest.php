<?php

/*
 * Socialist
 */

namespace tests\model;

use Trismegiste\Socialist\SimplePost;

/**
 * SimplePostTest tests SimplePost
 */
class SimplePostTest extends PublishingTest
{

    protected function createSUT()
    {
        return new SimplePost($this->mockAuthorInterface);
    }

    public function getFixtures()
    {
        return [['Amok time', 'Some summary']];
    }

    /**
     * @dataProvider getFixtures
     */
    public function testProperties($title, $body)
    {
        $this->sut->setTitle($title);
        $this->assertEquals($title, $this->sut->getTitle());
        $this->assertNotEquals($body, $this->sut->getTitle());

        $this->sut->setBody($body);
        $this->assertEquals($body, $this->sut->getBody());
        $this->assertNotEquals($title, $this->sut->getBody());
    }

}