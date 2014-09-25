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
            //  $u->setId(new \MongoId()); // for unique identification
            $lst[] = $u;
        }

        return $lst;
    }

    public function testFollower()
    {
        $users = $this->getListUser();
        $oneGuy = $users[0];

        $this->assertEquals(0, $this->sut->getFollowingCount());

        $this->sut->follow($oneGuy);
        $this->assertEquals(1, $this->sut->getFollowingCount());
        $this->assertTrue($this->sut->isFollowing($oneGuy));

        $this->sut->follow($oneGuy);
        $this->assertEquals(1, $this->sut->getFollowingCount());

        $this->sut->follow($users[1]);
        $this->assertEquals(2, $this->sut->getFollowingCount());

        $this->sut->unfollow($users[0]);
        $this->assertEquals(1, $this->sut->getFollowingCount());
        $this->assertFalse($this->sut->isFollowing($oneGuy));

        $this->sut->unfollow($users[1]);
        $this->assertEquals(0, $this->sut->getFollowingCount());
    }

    public function testFollowingDigraph()
    {
        $users = $this->getListUser();
        $oneGuy = $users[0];

        $this->sut->follow($oneGuy);
        $this->assertEquals(1, $this->sut->getFollowingCount());
        $this->assertEquals(1, $oneGuy->getFollowerCount());

        $this->sut->unfollow($oneGuy);
        $this->assertEquals(0, $this->sut->getFollowingCount());
        $this->assertEquals(0, $oneGuy->getFollowerCount());
    }

    public function testFollowerDigraph()
    {
        foreach ($this->getListUser() as $v) {
            $v->follow($this->sut);
        }
        $this->assertEquals(3, $this->sut->getFollowerCount());
        // just checking
        $this->assertEquals(0, $this->sut->getFollowingCount());
    }

    public function testFollowerIterator()
    {
        foreach ($this->getListUser() as $v) {
            $v->follow($this->sut);
        }
        $this->assertCount(3, $this->sut->getFollowerIterator());
        // just checking
        $this->assertCount(0, $this->sut->getFollowingIterator());
    }

    public function testFriend()
    {
        $user = $this->getListUser();
        foreach ($user as $v) {
            $v->follow($this->sut);
        }
        $this->assertCount(3, $this->sut->getFollowerIterator());
        $this->assertCount(0, $this->sut->getFriendIterator());

        $this->sut->follow($user[0]);
        $this->assertCount(1, $this->sut->getFriendIterator());
        $this->sut->unfollow($user[0]);
        $this->assertCount(0, $this->sut->getFriendIterator());
    }

    public function testClique()
    {
        $user = $this->getListUser();
        $user[] = $this->sut;

        foreach ($user as $s) {
            foreach ($user as $t) {
                $s->follow($t);
            }
        }

        foreach ($user as $v) {
            $this->assertCount(3, $v->getFriendIterator());
        }
    }

    public function testNotFollowHimself()
    {
        $this->sut->follow($this->sut);
        $this->assertEquals(0, $this->sut->getFollowingCount());
        $this->assertEquals(0, $this->sut->getFollowerCount());
    }

    public function testBidirectionalRelation()
    {
        $user = $this->getListUser();
        foreach ($user as $v) {
            $v->follow($this->sut);
        }
        foreach ($user as $v) {
            $this->assertTrue($this->sut->isFollowedBy($v));
            $this->assertTrue($v->isFollowing($this->sut));
            $this->assertTrue($this->sut->followerExists($v->getUniqueId()));
            $this->assertTrue($v->followingExists($this->sut->getUniqueId()));
            $this->assertCount(1, $v->getFollowingIterator());
        }
        $this->assertCount(count($user), $this->sut->getFollowerIterator());
    }

}
