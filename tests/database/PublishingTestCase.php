<?php

/*
 * Socialist
 */

namespace tests\database;

use MongoDB\BSON\ObjectIdInterface;
use Trismegiste\Socialist\Author;
use Trismegiste\Socialist\Commentary;
use Trismegiste\Socialist\Publishing;

/**
 * PublishingTestCass is a persistence test case for all subclasses
 * of Publishing with all embeded entities
 */
abstract class PublishingTestCase extends MongoDbTestCase
{

    private $sut;

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

    protected function setUp(): void
    {
        parent::setUp();
        $this->sut = $this->createDocument();
    }

    public function testCreate()
    {
        $this->resetCollection();
        $this->repo->save($this->sut);
        $pk = $this->sut->getPk();
        $this->assertInstanceOf(ObjectIdInterface::class, $pk);

        return $pk;
    }

    protected function assertChildren(Publishing $restore)
    {
        $this->assertCount(3, $restore->getCommentaryIterator());
        $this->assertEquals(3, $restore->getFanCount());

        $comm = iterator_to_array($restore->getCommentaryIterator());
        // checking commentary and sort
        $this->assertMatchesRegularExpression('#scotty#', $comm[0]->getMessage());
        $this->assertMatchesRegularExpression('#kirk#', $comm[1]->getMessage());
        $this->assertMatchesRegularExpression('#spock#', $comm[2]->getMessage());
    }

    /**
     * @depends testCreate
     */
    public function testRestore(ObjectIdInterface $pk)
    {
        $restore = $this->repo->load((string) $pk);

        $this->assertChildren($restore);
        $this->assertRootEquals($restore);

        return $restore;
    }

    /**
     * @depends testRestore
     */
    public function testUpdate(Publishing $restore)
    {
        $this->repo->save($restore);

        $this->assertChildren($restore);
        $this->assertRootEquals($restore);

        return $restore->getPk();
    }

    /**
     * @depends testUpdate
     */
    public function testRestoreAfterUpdate(ObjectIdInterface $pk)
    {
        $restore = $this->repo->load((string) $pk);

        $this->assertChildren($restore);
        $this->assertRootEquals($restore);
    }

}
