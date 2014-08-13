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

    protected $followed = [];
    protected $followerCount = 0; // cached property, computed with map-reduce

    public function follow(Follower $f)
    {
        $this->followed[$f->getUniqueId()] = $f;
    }

    public function unfollow(Follower $f)
    {
        unset($this->followed[$f->getUniqueId()]);
    }

    public function isFollowing(Follower $f)
    {
        return array_key_exists($f->getUniqueId(), $this->followed);
    }

    public function getFollowedCount()
    {
        return count($this->followed);
    }

    public function getFollowerCount()
    {
        return $this->followerCount;
    }

}