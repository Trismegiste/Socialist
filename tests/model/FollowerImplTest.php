<?php

/*
 * Socialist
 */

namespace tests\model;

/**
 * FollowerImplTest tests if interface and implementation are in sync
 */
class FollowerImplTest extends \PHPUnit_Framework_TestCase
{

    public function testSync()
    {
        $code = <<<CODE
                namespace Trismegiste\Socialist;
                class ConcreteFollower implements Follower { 
                    use FollowerImpl; 
                    public function getUniqueId() {}
                    public function getMinimalInfo() {}
                }
CODE;
        eval($code);
        $concrete = new \Trismegiste\Socialist\ConcreteFollower();
    }

}