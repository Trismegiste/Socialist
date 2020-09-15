<?php

/*
 * Socialist
 */

namespace tests\model;

/**
 * FamousImplTest tests if interface and implementation are in sync
 */
class FamousImplTest extends \PHPUnit\Framework\TestCase
{

    public function testSync()
    {
        $code = <<<CODE
                namespace Trismegiste\Socialist;
                class ConcreteFamous implements Famous { use FamousImpl; }
CODE;
        eval($code);
        $concrete = new \Trismegiste\Socialist\ConcreteFamous();

        $this->assertCount(count(get_class_methods('Trismegiste\Socialist\Famous')), get_class_methods($concrete));
    }

}