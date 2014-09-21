<?php

/*
 * Socialist
 */

namespace tests\database;

use Trismegiste\Socialist\Status;
use Trismegiste\Socialist\Author;

/**
 * StatusTest tests Status persistence with all embeded entities
 */
class StatusTest extends PublishingTestCase
{

    static protected function createRootEntity(Author $author)
    {
        $sut = new Status($author);
        $sut->setMessage("Hello there !");
        $sut->setLatitude(43.00001);
        $sut->setLongitude(7.00001);

        return $sut;
    }

    public function testPrecision()
    {
        $restore = $this->repo->findOne([]);

        $this->assertEquals(43.00001, $restore->getLatitude());
    }

}
