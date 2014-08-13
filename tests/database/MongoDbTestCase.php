<?php

/*
 * Socialist
 */

namespace tests\database;

use Trismegiste\Yuurei\Transform\Delegation\Stage\Invocation;
use Trismegiste\Yuurei\Facade\Provider;

/**
 * MongoDb_TestCase is a temmplate for Persistence with Yuurei
 */
class MongoDbTestCase extends \PHPUnit_Framework_TestCase
{

    protected $repo;
    protected $collection;

    private function createStage()
    {
        return new Invocation();
    }

    protected function setUp()
    {
        $connector = new \tests\Yuurei\Persistence\ConnectorTest();
        $this->collection = $connector->testCollection();
        $facade = new Provider($this->collection);
        $this->repo = $facade->createRepository($this->createStage());
    }

}