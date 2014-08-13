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

    static protected $frozenTime;
    protected $sut;

    public static function setupBeforeClass()
    {
        self::$frozenTime = new \DateTime();
    }

    protected function setUp()
    {
        parent::setUp();

        $author = [
            new Author('spock'),
            new Author('kirk'),
            new Author('scotty')
        ];
        $this->sut = new SimplePost($author[0]);
        $this->sut->setLastEdited(self::$frozenTime);
        $this->sut->setTitle("A title");
        $this->sut->setBody("main message");

        // adding 'like' to the post
        foreach ($author as $a) {
            $this->sut->addFan($a);
        }

        // adding comments to the post
        foreach ($author as $a) {
            $comm = new Commentary($a);
            $comm->setMessage("a comment from " . $a->getNickname());
            // adding 'like' to each comment
            foreach ($author as $c) {
                $comm->addFan($c);
            }
            $this->sut->attachCommentary($comm);
        }
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
        $this->sut->setId($pk);
        $this->assertEquals($this->sut, $restore);

        return $restore;
    }

}