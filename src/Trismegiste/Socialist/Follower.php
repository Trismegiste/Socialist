<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

/**
 * Follower is a contract for a follower who follows other followers
 */
interface Follower
{

    /**
     * @todo Perhaps using the same technique in Famous interface ?
     */
    public function getUniqueId();

    public function follow(Follower $f);

    public function unfollow(Follower $f);

    public function isFollowing(Follower $f);
}