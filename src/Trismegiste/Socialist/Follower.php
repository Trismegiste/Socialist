<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

/**
 * Follower is a contract for a follower who follows other followers
 * In other words : it's a contract for a digraph of followers
 */
interface Follower
{

    /**
     * Returns a unique id for this follower
     * 
     * @return scalar
     */
    public function getUniqueId();

    /**
     * Follows one guy (idempotent)
     * 
     * @param \Trismegiste\Socialist\Follower $f
     */
    public function follow(Follower $f);

    /**
     * Unfollows one guy
     * 
     * @param \Trismegiste\Socialist\Follower $f
     */
    public function unfollow(Follower $f);

    /**
     * Is this guy following anoher guy
     * 
     * @param \Trismegiste\Socialist\Follower $f
     * 
     * @return boolean
     */
    public function isFollowing(Follower $f);

    /**
     * How many other guys this guy is following ?
     * 
     * @return int
     */
    public function getFollowingCount();

    /**
     * How many followers for this guy ?
     * 
     * @return int
     */
    public function getFollowerCount();

    /**
     * Returns the minimal informations for a follower (optim)
     * 
     * return object
     */
    public function getMinimalInfo();

    /**
     * Get an iterator on follower's list
     * 
     * @return \ArrayIterator
     */
    public function getFollowerIterator();

    /**
     * Get an iterator on following's list
     * 
     * @return \ArrayIterator
     */
    public function getFollowingIterator();
}