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
     * List of follower
     * 
     * @var array
     */
    protected $followed = [];

    /**
     * Cached property, computed with map-reduce
     * @var int 
     */
    protected $followerCount = 0;

    /**
     * Follows one guy (idempotent)
     * 
     * @param \Trismegiste\Socialist\Follower $f
     */
    public function follow(Follower $f)
    {
        $this->followed[$f->getUniqueId()] = $f->getMinimalInfo();
    }

    /**
     * Unfollows one guy
     * 
     * @param \Trismegiste\Socialist\Follower $f
     */
    public function unfollow(Follower $f)
    {
        unset($this->followed[$f->getUniqueId()]);
    }

    /**
     * Is this guy following anoher guy
     * 
     * @param \Trismegiste\Socialist\Follower $f
     * 
     * @return boolean
     */
    public function isFollowing(Follower $f)
    {
        return array_key_exists($f->getUniqueId(), $this->followed);
    }

    /**
     * How many other guys this guy is following ?
     * 
     * @return int
     */
    public function getFollowedCount()
    {
        return count($this->followed);
    }

    /**
     * How many followers for this guy ?
     * (Cached with map-reduce)
     * 
     * @return int
     */
    public function getFollowerCount()
    {
        return $this->followerCount;
    }

}