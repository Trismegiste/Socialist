<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

/**
 * FollowerImpl is an implementation of Follower
 */
trait FollowerImpl
{

    /**
     * List of following
     * @var array
     */
    protected $following = [];

    /**
     * List of followers
     * @var array
     */
    protected $follower = [];

    /**
     * Follows one guy
     *
     * @param \Trismegiste\Socialist\Follower $f
     */
    public function follow(Follower $f)
    {
        if ($f !== $this) {
            $this->following[$f->getUniqueId()] = $f->getMinimalInfo();
            $f->follower[$this->getUniqueId()] = $this->getMinimalInfo();
        }
    }

    /**
     * Unfollows one guy (idempotent)
     *
     * @param \Trismegiste\Socialist\Follower $f
     */
    public function unfollow(Follower $f)
    {
        unset($this->following[$f->getUniqueId()]);
        unset($f->follower[$this->getUniqueId()]);
    }

    /**
     * Is this guy following another guy ?
     *
     * @param \Trismegiste\Socialist\Follower $f
     *
     * @return boolean
     */
    public function isFollowing(Follower $f)
    {
        return $this->followingExists($f->getUniqueId());
    }

    /**
     * Is this guy followed by another guy ?
     *
     * @param \Trismegiste\Socialist\Follower $f
     *
     * @return boolean
     */
    public function isFollowedBy(Follower $f)
    {
        return $this->followerExists($f->getUniqueId());
    }

    /**
     * Search if an unique id is registered in the following list
     *
     * @param mixed $uid
     *
     * @return bool
     */
    public function followingExists($uid)
    {
        return array_key_exists($uid, $this->following);
    }

    /**
     * Search if an unique id is registered in the follower list
     *
     * @param mixed $uid
     *
     * @return bool
     */
    public function followerExists($uid)
    {
        return array_key_exists($uid, $this->follower);
    }

    /**
     * Returns the type of relation between this object and a unique id
     *
     * @param mixed $uid
     *
     * @return int one of those RELATION_* const
     */
    public function findRelationType($uid)
    {
        //default :
        $type = Follower::RELATION_STRANGER;
        // find if follower ?
        if ($this->followerExists($uid)) {
            $type = Follower::RELATION_FOLLOWER;
        }
        if ($this->followingExists($uid)) {
            $type |= Follower::RELATION_FOLOWING;
        }

        return $type;
    }

    /**
     * How many other guys this guy is following ?
     *
     * @return int
     */
    public function getFollowingCount()
    {
        return count($this->following);
    }

    /**
     * How many followers for this guy ?
     *
     * @return int
     */
    public function getFollowerCount()
    {
        return count($this->follower);
    }

    /**
     * Get an iterator on follower's list
     *
     * @return \ArrayIterator
     */
    public function getFollowerIterator()
    {
        return new \ArrayIterator($this->follower);
    }

    /**
     * Get an iterator on following's list
     *
     * @return \ArrayIterator
     */
    public function getFollowingIterator()
    {
        return new \ArrayIterator($this->following);
    }

    /**
     * Get an iterator on friend's list
     * WARNING: Not optimized.
     * Could be cached but must be updated for each follow()/unfollow() (for both vertices)
     *
     * @return \ArrayIterator
     */
    public function getFriendIterator()
    {
        $tmp = array_intersect_key($this->follower, $this->following);

        return new \ArrayIterator($tmp);
    }

}
