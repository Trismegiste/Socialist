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

    const dbName = 'trismegiste_socialist_test';
    const collName = 'phpunit';

    /** @var Manager */
    protected $manager;

    /** @var Repository */
    protected $repo;

    protected function setUp(): void
    {
        $this->manager = new Manager('mongodb://localhost:27017');
        $factory = new RepositoryFactory($this->manager, self::dbName);
        $this->repo = $factory->create(self::collName);
    }

    public function resetCollection()
    {
        $this->manager->executeCommand(self::dbName, new \MongoDB\Driver\Command(['drop' => self::collName]));
    }

}
