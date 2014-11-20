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

    public function testIsEqualTwoInstance()
    {
        $auth1 = new Author('murasaki');
        $auth2 = new Author('murasaki');
        $auth1->setAvatar('45465');
        $auth2->setAvatar('dsfdsdsf');

        $this->assertTrue($auth1->isEqual($auth2));
    }

    public function testIsEqualDifferent()
    {
        $auth1 = new Author('issei');
        $auth2 = new Author('murasaki');
        $auth1->setAvatar('dsfdsdsf');
        $auth2->setAvatar('dsfdsdsf');

        $this->assertFalse($auth1->isEqual($auth2));
    }

}
