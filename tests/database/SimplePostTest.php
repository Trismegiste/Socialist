<?php

/*
 * Socialist
 */

namespace tests\database;

use Trismegiste\Socialist\SimplePost;
use Trismegiste\Socialist\Author;
use Trismegiste\Socialist\Commentary;

/**
 * SimplePostTest tests SimplePost persistence with all embeded entities
 */
class SimplePostTest extends MongoDbTestCase
{

    static protected $frozenSut;

    public static function setupBeforeClass()
    {
        $author = [
            new Author('spock'),
            new Author('kirk'),
            new Author('scotty')
        ];
        $sut = new SimplePost($author[0]);
        $sut->setTitle("A title");
        $sut->setBody("main message");

        // adding 'like' to the post
        foreach ($author as $a) {
            $sut->addFan($a);
        }

        // adding comments to the post
        foreach ($author as $a) {
            $comm = new Commentary($a);
            $comm->setMessage("a comment from " . $a->getNickname());
            // adding 'like' to each comment
            foreach ($author as $c) {
                $comm->addFan($c);
            }
            $sut->attachCommentary($comm);
        }

        self::$frozenSut = $sut;
    }

    protected function setUp()
    {
        parent::setUp();
        $this->sut = self::$frozenSut;
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