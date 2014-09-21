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

    protected function createRootEntity(Author $author)
    {
        $sut = new SimplePost($author);
        $sut->setTitle("A title");
        $sut->setBody("main message");

        return $sut;
    }

    protected function assertRootEquals(\Trismegiste\Socialist\Publishing $doc)
    {
        $this->assertEquals('A title', $doc->getTitle());
        $this->assertEquals('main message', $doc->getBody());
    }

}
