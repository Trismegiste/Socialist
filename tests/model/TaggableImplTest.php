<?php

/*
 * Socialist
 */

namespace tests\model;

/**
 * TaggableImplTest tests the trait TaggableImpl
 */
class TaggableImplTest extends \PHPUnit_Framework_TestCase
{

    use \Trismegiste\Socialist\TaggableImpl;

    public function testNoTag()
    {
        $this->assertEquals([], $this->parseTag('pon pon waiwaiwai pon pon wai pon wai pon pon'));
    }

    public function testOneTag()
    {
        $this->assertEquals(['pon'], $this->parseTag('#pon pon waiwaiwai pon pon wai pon wai pon pon'));
    }

    public function testTwoTag()
    {
        $this->assertEquals(['pon', 'wai'], $this->parseTag('#pon pon waiwaiwai pon pon #wai pon wai pon pon'));
    }

    public function testOneDuplicateTag()
    {
        $this->assertEquals(['pon'], $this->parseTag('#pon pon waiwaiwai #pon pon wai pon wai pon pon'));
    }

    public function testTagAtEnd()
    {
        $this->assertEquals(['pon'], $this->parseTag('pon pon waiwaiwai pon pon wai pon wai pon #pon'));
    }

    public function testTagConcat()
    {
        $this->assertEquals(['pon', 'wai'], $this->parseTag('pon pon waiwaiwai pon pon wai #pon#wai pon pon'));
    }

    public function testFull()
    {
        $parsed = $this->parseTag('#pon#pon#waiwaiwai#pon#pon#wai#pon#wai#pon#pon');
        $this->assertCount(3, $parsed);
        $this->assertContains('pon', $parsed);
        $this->assertContains('wai', $parsed);
        $this->assertContains('waiwaiwai', $parsed);
    }

    public function testSpecialChar()
    {
        $parsed = $this->parseTag('#déjà-vu #とうきょう');
        $this->assertEquals(['déjà-vu', 'とうきょう'], $parsed);
    }

    public function testSpecialCombo()
    {
        $parsed = $this->parseTag("#un ##dièze augmente #d'un #demi-ton");
        $this->assertEquals(['dièze', 'demi-ton'], $parsed);
    }

}
