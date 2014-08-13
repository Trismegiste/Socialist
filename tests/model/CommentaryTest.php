<?php

/*
 * Socialist
 */

namespace tests\model;

use Trismegiste\Socialist\Commentary;

/**
 * CommentaryTest tests Commentary entity
 */
class CommentaryTest extends ContentTest
{

    protected function createSUT()
    {
        return new Commentary($this->mockAuthorInterface);
    }

    public function getMessage()
    {
        return [['warp fator 1']];
    }

    /**
     * @dataProvider getMessage
     */
    public function testMessage($str)
    {
        $this->sut->setMessage($str);
        $this->assertEquals($str, $this->sut->getMessage());
        $this->assertNotEquals('sghsjgcsg', $this->sut->getMessage());
    }

}