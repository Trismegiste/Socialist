<?php

/*
 * Socialist
 */

namespace tests\model;

use Trismegiste\Socialist\User;

/**
 * UserTest tests User
 */
class UserTest extends FamousTestTemplate
{

    protected $author;

    private function createMockAuthor($nick)
    {
        $mock = $this->getMock("Trismegiste\Socialist\AuthorInterface");
        $mock->expects($this->any())
                ->method('getNickname')
                ->will($this->returnValue($nick));

        return $mock;
    }

    protected function setUp()
    {
        $this->author = $this->createMockAuthor('kirk');
        parent::setUp();
    }

    public function testAuthor()
    {
        $this->assertEquals($this->author, $this->sut->getAuthor());
    }

    protected function createSUT()
    {
        return new User($this->author);
    }

    public function getListUser()
    {
        $lst = [];
        foreach (['spock', 'scotty', 'mccoy'] as $nick) {
            $u = new User($this->createMockAuthor($nick));
            $u->setId(new \MongoId()); // for unique identification
            $lst[] = $u;
        }

        return $lst;
    }

    public function testFollower()
    {
        $users = $this->getListUser();
        $oneGuy = $users[0];

        $this->assertEquals(0, $this->sut->getFollowedCount());

        $this->sut->follow($oneGuy);
        $this->assertEquals(1, $this->sut->getFollowedCount());
        $this->assertTrue($this->sut->isFollowing($oneGuy));

        $this->sut->follow($oneGuy);
        $this->assertEquals(1, $this->sut->getFollowedCount());

        $this->sut->follow($users[1]);
        $this->assertEquals(2, $this->sut->getFollowedCount());

        $this->sut->unfollow($users[0]);
        $this->assertEquals(1, $this->sut->getFollowedCount());
        $this->assertFalse($this->sut->isFollowing($oneGuy));

        $this->sut->unfollow($users[1]);
        $this->assertEquals(0, $this->sut->getFollowedCount());
    }

}