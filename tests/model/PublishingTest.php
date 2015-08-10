<?php

/*
 * Socialist
 */

namespace tests\model;

/**
 * PublishingTest tests Publishing
 */
class PublishingTest extends ContentTest
{

    protected $message;

    protected function setUp()
    {
        $this->message = $this->createCommentary();

        parent::setUp();
    }

    protected function createSUT()
    {
        return $this->getMockBuilder('Trismegiste\Socialist\Publishing')
                        ->setConstructorArgs([$this->mockAuthorInterface])
                        ->setMethods(NULL)
                        ->getMock();
    }

    protected function createCommentary()
    {
        return $this->getMockBuilder('Trismegiste\Socialist\Commentary')
                        ->disableOriginalConstructor()
                        ->setMethods(['setUuid', 'getUuid'])
                        ->getMock();
    }

    public function testAttachCommentary()
    {
        $this->assertEquals(0, $this->sut->getCommentaryCount());
        $this->sut->attachCommentary($this->message);
        $this->assertEquals(1, $this->sut->getCommentaryCount());
    }

    public function testDetachCommentary()
    {
        $this->assertEquals(0, $this->sut->getCommentaryCount());
        $this->sut->attachCommentary($this->message);
        $this->assertEquals(1, $this->sut->getCommentaryCount());
        $this->sut->detachCommentary($this->message);
        $this->assertEquals(0, $this->sut->getCommentaryCount());
        $this->sut->detachCommentary($this->message);
    }

    public function testCommentarySorting()
    {
        $this->sut->attachCommentary($this->message);
        $this->assertEquals(1, $this->sut->getCommentaryCount());

        $recentMessage = $this->createCommentary();
        $this->sut->attachCommentary($recentMessage);
        $this->assertEquals(2, $this->sut->getCommentaryCount());

        $comments = iterator_to_array($this->sut->getCommentaryIterator());
        $this->assertEquals($recentMessage, $comments[0]);
        $this->assertEquals($this->message, $comments[1]);
    }

    public function testGetByUuid()
    {
        $this->message->expects($this->once())
                ->method('setUuid')
                ->with($this->isInstanceOf('MongoId'));
        $uuid = new \MongoId();
        $this->message->expects($this->once())
                ->method('getUuid')
                ->will($this->returnValue($uuid));

        $this->sut->attachCommentary($this->message);
        $found = $this->sut->getCommentaryByUuid((string) $uuid);

        $this->assertEquals($this->message, $found);
    }

    public function testGetByUuidNotFound()
    {
        $this->message->expects($this->once())
                ->method('getUuid')
                ->will($this->returnValue(new \MongoId()));

        $this->sut->attachCommentary($this->message);

        $this->assertNull($this->sut->getCommentaryByUuid((string) (new \MongoId())));
    }

    public function testRemoveSubEntities()
    {
        $this->sut->addFan($this->fan);
        $this->sut->attachCommentary($this->message);
        $this->sut->report($this->fan);

        $this->assertAttributeCount(1, 'abusive', $this->sut);
        $this->assertEquals(1, $this->sut->getCommentaryCount());
        $this->assertEquals(1, $this->sut->getFanCount());

        $this->sut->removeSubEntities();

        $this->assertAttributeCount(0, 'abusive', $this->sut);
        $this->assertEquals(0, $this->sut->getCommentaryCount());
        $this->assertEquals(0, $this->sut->getFanCount());
    }

    public function testEditable()
    {
        $this->assertTrue($this->sut->isEditable());
    }

    public function testGetSourceId()
    {
        $pk = new \MongoId();
        $this->sut->setId($pk);
        $this->assertEquals($pk, $this->sut->getSourceId());
    }

    public function testRepeatedCount()
    {
        $this->assertEquals(0, $this->sut->getRepeatedCount());
    }

    public function testIsLastCommenterEmpty()
    {
        $this->assertEquals(0, $this->sut->getCommentaryCount());
        $this->assertFalse($this->sut->isLastCommenter($this->getMock('Trismegiste\Socialist\AuthorInterface')));
    }

    public function testIsLastCommenterFalse()
    {
        $author = $this->getMock('Trismegiste\Socialist\AuthorInterface');
        $author->expects($this->once())
                ->method('isEqual')
                ->will($this->returnValue(false));

        $comment = $this->getMockBuilder('Trismegiste\Socialist\Commentary')
                ->disableOriginalConstructor()
                ->setMethods(['getAuthor'])
                ->getMock();
        $comment->expects($this->once())
                ->method('getAuthor')
                ->will($this->returnValue($this->mockAuthorInterface));

        $this->sut->attachCommentary($comment);
        $this->assertFalse($this->sut->isLastCommenter($author));
    }

    public function testIsLastCommenterTrue()
    {
        $author = $this->getMock('Trismegiste\Socialist\AuthorInterface');
        $author->expects($this->once())
                ->method('isEqual')
                ->will($this->returnValue(true));

        $comment = $this->getMockBuilder('Trismegiste\Socialist\Commentary')
                ->disableOriginalConstructor()
                ->setMethods(['getAuthor'])
                ->getMock();
        $comment->expects($this->once())
                ->method('getAuthor')
                ->will($this->returnValue($this->mockAuthorInterface));

        $this->sut->attachCommentary($comment);
        $this->assertTrue($this->sut->isLastCommenter($author));
    }

    public function testCappedCollectionOfCommentaries()
    {
        $limit = rand(4, 13);  // defensive testing against immortal mutant
        $this->sut->setCommentaryLimit($limit);

        for ($k = 0; $k < $limit; $k++) {
            $comment = new \Trismegiste\Socialist\Commentary($this->mockAuthorInterface);
            $comment->setMessage("msg$k");
            $this->assertEquals($k, $this->sut->getCommentaryCount());
            $this->sut->attachCommentary($comment);
            $this->assertEquals($k + 1, $this->sut->getCommentaryCount());
        }

        $newComment = new \Trismegiste\Socialist\Commentary($this->mockAuthorInterface);
        $newComment->setMessage("last");

        $this->assertEquals($limit, $this->sut->getCommentaryCount());
        $this->sut->attachCommentary($newComment);
        $this->assertEquals($limit, $this->sut->getCommentaryCount());

        /* @var $it \Iterator */
        $it = $this->sut->getCommentaryIterator();
        $first = $it->current();
        $this->assertEquals($newComment, $first);
        $it->next();
        $nextOne = $it->current();
        $this->assertEquals('msg' . ($limit - 1), $nextOne->getMessage());
    }

    public function testCappedCollectionAlreadyExisting()
    {
        $limit = rand(14, 27);  // defensive testing against immortal mutant
        for ($k = 0; $k < $limit; $k++) {
            $comment = new \Trismegiste\Socialist\Commentary($this->mockAuthorInterface);
            $comment->setMessage("msg$k");
            $this->sut->attachCommentary($comment);
        }
        $this->assertEquals($limit, $this->sut->getCommentaryCount());

        $this->sut->setCommentaryLimit(3);
        $this->assertEquals($limit, $this->sut->getCommentaryCount());
        $newComment = new \Trismegiste\Socialist\Commentary($this->mockAuthorInterface);
        $newComment->setMessage("last");
        $this->sut->attachCommentary($newComment);
        $this->assertEquals(3, $this->sut->getCommentaryCount());
        $this->assertEquals('last', $this->sut
                        ->getCommentaryIterator()
                        ->current()
                        ->getMessage());
    }

    public function testDisableCommentaries()
    {
        $this->sut->setCommentaryLimit(0);
        $this->sut->attachCommentary($this->createCommentary());
        $this->assertEquals(0, $this->sut->getCommentaryCount());
        // these tests below are fixing the behavior of capped collection
        $this->sut->setCommentaryLimit(1);
        $this->sut->attachCommentary($this->createCommentary());
        $this->assertEquals(1, $this->sut->getCommentaryCount());
        $this->sut->setCommentaryLimit(0);
        $this->assertEquals(1, $this->sut->getCommentaryCount()); // this is not bug, it's a feature (c)(tm)(r)
        $this->sut->attachCommentary($this->createCommentary());
        $this->assertEquals(0, $this->sut->getCommentaryCount());
    }

}
