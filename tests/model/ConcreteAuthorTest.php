<?php

/*
 * Socialist
 */

namespace tests\model;

use Trismegiste\Socialist\ConcreteAuthor;

/**
 * ConcreteAuthorTest tests ConcreteAuthor
 */
class ConcreteAuthorTest extends \PHPUnit_Framework_TestCase
{

    protected $sut;

    protected function setUp()
    {
        $this->sut = new ConcreteAuthor('spock');
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

}