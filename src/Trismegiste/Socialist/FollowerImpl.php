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

}