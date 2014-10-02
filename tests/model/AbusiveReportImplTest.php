<?php

/*
 * Socialist
 */

namespace tests\model;

/**
 * AbusiveReportImplTest tests if interface and implementation are in sync
 */
class AbusiveReportImplTest extends \PHPUnit_Framework_TestCase
{

    public function testSync()
    {
        $code = <<<CODE
                namespace Trismegiste\Socialist;
                class ConcreteAbusive implements AbusiveReport { use AbusiveReportImpl; }
CODE;
        eval($code);
        $concrete = new \Trismegiste\Socialist\ConcreteAbusive();

        $this->assertCount(count(get_class_methods('Trismegiste\Socialist\AbusiveReport')), get_class_methods($concrete));
    }

}
