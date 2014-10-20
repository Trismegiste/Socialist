<?php

/*
 * Socialist
 */

namespace tests\model;

use Trismegiste\Socialist\Author;

/**
 * AuthorTest tests Author
 */
class AuthorTest extends \PHPUnit_Framework_TestCase
{

    protected $sut;

    protected function setUp()
    {
        $this->sut = new Author('spock');
    }

    public function getAvatar()
    {
        return [['/img/spock.png']];
    }

    /**
     * @dataProvider getAvatar
     */
    public function testAvatar($url)
    {
        $this->sut->setAvatar($url);
        $this->assertEquals($url, $this->sut->getAvatar());
        $this->assertNotEquals('ffdsxwcc', $this->sut->getAvatar());
    }

    public function testNickname()
    {
        $this->assertEquals('spock', $this->sut->getNickname());
    }

    public function testIsEqual()
    {
        $this->assertTrue($this->sut->isEqual($this->sut));
    }

}
