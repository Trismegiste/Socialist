<?php

/*
 * Socialist
 */

namespace tests\database;

use Trismegiste\Socialist\SimplePost;
use Trismegiste\Socialist\Author;

/**
 * SimplePostTest tests SimplePost persistence with all embeded entities
 */
class SimplePostTest extends PublishingTestCase
{

    static protected function createRootEntity(Author $author)
    {
        $sut = new SimplePost($author);
        $sut->setTitle("A title");
        $sut->setBody("main message");

        return $sut;
    }

    public function testCreate()
    {
        $this->collection->drop();
        $this->repo->persist($this->sut);
        $pk = $this->sut->getId();
        $this->assertInstanceOf('MongoId', $pk);

        return $pk;
    }

    /**
     * @depends testCreate
     */
    public function testRestore(\MongoId $pk)
    {
        $restore = $this->repo->findByPk((string) $pk);
        $this->assertEquals($this->sut, $restore);

        return $restore;
    }

}
