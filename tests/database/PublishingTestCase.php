<?php

/*
 * Socialist
 */

namespace tests\database;

use Trismegiste\Socialist\Author;
use Trismegiste\Socialist\Commentary;
use Trismegiste\Socialist\Publishing;

/**
 * PublishingTestCass is a persistence test case for all subclasses
 * of Publishing with all embeded entities
 */
abstract class PublishingTestCase extends MongoDbTestCase
{

    protected $sut;

    abstract protected function createRootEntity(Author $author);

    abstract protected function assertRootEquals(Publishing $doc);

    final protected function createDocument()
    {
        $author = [
            new Author('spock'),
            new Author('kirk'),
            new Author('scotty')
        ];
        $sut = $this->createRootEntity($author[0]);

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

        return $sut;
    }

    protected function setUp()
    {
        parent::setUp();
        $this->sut = $this->createDocument();
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
        $this->assertCount(3, $restore->getCommentaryIterator());
        $comm = iterator_to_array($restore->getCommentaryIterator());
        // checking commentary
        $this->assertRegexp('#scotty#', $comm[0]->getMessage());
        $this->assertRegexp('#kirk#', $comm[1]->getMessage());
        $this->assertRegexp('#spock#', $comm[2]->getMessage());

        $this->assertRootEquals($restore);

        return $restore;
    }

}
