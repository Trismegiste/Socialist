<?php

/*
 * Socialist
 */

namespace tests\database;

use Trismegiste\Socialist\Status;
use Trismegiste\Socialist\Author;
use Trismegiste\Socialist\Publishing;

/**
 * StatusTest tests Status persistence with all embeded entities
 */
class StatusTest extends PublishingTestCase
{

    protected function createRootEntity(Author $author)
    {
        $sut = new Status($author);
        $sut->setMessage("Hello there !");
        $sut->setLatitude(43.000001);
        $sut->setLongitude(7.000001);

        return $sut;
    }

    protected function assertRootEquals(Publishing $doc)
    {
        $this->assertEquals("Hello there !", $doc->getMessage());
        $this->assertEquals(43.000001, $doc->getLatitude());
        $this->assertEquals(7.000001, $doc->getLongitude());
    }

    public function testGeoIndexingPossible()
    {
        $cursor = $this->manager->executeCommand(self::dbName,
            new \MongoDB\Driver\Command([
                'createIndexes' => self::collName,
                'indexes' => [
                    [
                        'key' => ['location' => "2dsphere"],
                        'name' => 'whocares',
                        'sparse' => true
                    ]
                ]
                ])
        );
        $response = $cursor->toArray()[0];
        $this->assertEquals(1, $response->ok, "MongoDB server is not ready");
        $this->assertEquals($response->numIndexesAfter, 1 + $response->numIndexesBefore);
    }

}
