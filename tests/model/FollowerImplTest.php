<?php

/*
 * Socialist
 */

namespace tests\model;

/**
 * FollowerImplTest tests if interface and implementation are in sync
 */
class FollowerImplTest extends \PHPUnit\Framework\TestCase
{

    public function testSync()
    {
        $code = <<<CODE
                namespace Trismegiste\Socialist;
                class ConcreteFollower implements Follower {
                    use FollowerImpl;
                    public function getUniqueId() {}
                }
CODE;
        eval($code);
        $concrete = new \Trismegiste\Socialist\ConcreteFollower();

        $this->assertCount(count(get_class_methods('Trismegiste\Socialist\Follower')), get_class_methods($concrete));
    }

}