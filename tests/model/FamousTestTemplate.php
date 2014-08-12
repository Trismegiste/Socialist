<?php

/*
 * Socialist
 */

namespace tests\model;

/**
 * FamousTestTemplate is a test template for any implementation of Famous
 */
abstract class FamousTestTemplate extends \PHPUnit_Framework_TestCase
{

    protected $sut;
    protected $fan;

    abstract protected function createSUT();

    protected function setUp()
    {

        $this->fan = $this->getMock("Trismegiste\Socialist\Author");
        $this->fan->expects($this->any())
                ->method('getNickname')
                ->will($this->returnValue('janice'));

        $this->sut = $this->createSUT();
    }

    public function testAddRemoveFan()
    {
        $this->sut->addFan($this->fan);
        $this->assertEquals(1, $this->sut->getFanCount());
        $this->assertTrue($this->sut->hasFan($this->fan));

        $this->sut->addFan($this->fan);
        $this->assertEquals(1, $this->sut->getFanCount());

        $this->sut->removeFan($this->fan);
        $this->assertEquals(0, $this->sut->getFanCount());
    }

}