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

    const RELATION_STRANGER = 0;
    const RELATION_FOLLOWER = 1;
    const RELATION_FOLOWING = 2;
    const RELATION_FRIEND = 3;

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
     * Is this guy followed by another guy ?
     *
     * @param \Trismegiste\Socialist\Follower $f
     *
     * @return boolean
     */
    public function isFollowedBy(Follower $f);

    /**
     * Search if an unique id is registered in the following list
     *
     * @param mixed $uid
     *
     * @return bool
     */
    public function followingExists($uid);

    /**
     * Search if an unique id is registered in the follower list
     *
     * @param mixed $uid
     *
     * @return bool
     */
    public function followerExists($uid);

    /**
     * Returns the type of relation between this object and a unique id
     *
     * @param mixed $uid
     *
     * @return int one of those RELATION_* const
     */
    public function findRelationType($uid);

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

    /**
     * Get an iterator on friend's list
     *
     * @return \ArrayIterator
     */
    public function getFriendIterator();
}
