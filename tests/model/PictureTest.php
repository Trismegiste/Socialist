<?php

/*
 * Socialist
 */

namespace tests\model;

use Trismegiste\Socialist\Picture;

/**
 * PictureTest tests PictureTest
 */
class PictureTest extends PublishingTest
{

    protected function createSUT()
    {
        return new Picture($this->mockAuthorInterface);
    }

    public function getFixtures()
    {
        return [['ncc1701.jpg', 'image/jpeg', 'A fine ship']];
    }

    /**
     * @dataProvider getFixtures
     */
    public function testProperties($filename, $mime, $msg)
    {
        $this->sut->setMessage($msg);
        $this->assertEquals($msg, $this->sut->getMessage());
        $this->assertNotEquals('garbage', $this->sut->getMessage());

        $this->sut->setMimeType($mime);
        $this->assertEquals($mime, $this->sut->getMimeType());
        $this->assertNotEquals('adobe/pdf', $this->sut->getMimeType());

        $this->sut->setStorageKey($filename);
        $this->assertEquals($filename, $this->sut->getStorageKey());
        $this->assertNotEquals('x-wing.png', $this->sut->getStorageKey());
    }

    public function testSizeProperty()
    {
        $this->assertEquals(0, $this->sut->getFileSize());
        $this->sut->setFileSize(1000);
        $this->assertEquals(1000, $this->sut->getFileSize());
    }

}
