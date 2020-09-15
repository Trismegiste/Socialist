<?php

/*
 * Socialist
 */

namespace tests\database;

use MongoDB\Driver\Manager;
use PHPUnit\Framework\TestCase;
use Trismegiste\Toolbox\MongoDb\Repository;
use Trismegiste\Toolbox\MongoDb\RepositoryFactory;

/**
 * MongoDbTestCase is a base class for Persistence tests with toolbox
 */
class MongoDbTestCase extends TestCase
{

    /** @var Manager */
    protected $manager;

    /** @var Repository */
    protected $repo;

    protected function setUp(): void
    {
        $this->manager = new Manager('mongodb://localhost:27017');
        $factory = new RepositoryFactory($this->manager, 'trismegiste_socialist_test');
        $this->repo = $factory->create('phpunit');
    }

    public function resetCollection()
    {
        $bulk = new \MongoDB\Driver\BulkWrite();
        $bulk->delete([]);
        $result = $this->manager->executeBulkWrite('trismegiste_socialist_test.phunit', $bulk);
        $this->assertTrue($result->isAcknowledged());
    }

}
