<?php

/*
 * Socialist
 */

namespace test\database;

use Trismegiste\Yuurei\Transform\Delegation\Stage\Invocation;
use Trismegiste\Yuurei\Facade\Provider;

/**
 * MongoDb_TestCase is a temmplate for Persistence with Yuurei
 */
class MongoDb_TestCase extends \PHPUnit_Framework_TestCase
{

    protected $invocation;
    protected $collection;

    protected function setUp()
    {
        $connector = new \tests\Yuurei\Persistence\ConnectorTest();
        $this->collection = $connector->testCollection();
        $facade = new Provider($this->collection);
        $this->invocation = $facade->createRepository(new Invocation());
    }

    public function testPersistence()
    {
        // simple object
        $doc = ["aaa" => 123];
        // persisting
        $this->collection->save($doc);
    }

}