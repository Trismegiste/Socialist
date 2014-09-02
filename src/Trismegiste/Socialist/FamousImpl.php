<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

/**
 * FamousImpl is an implementation for interface Famous
 */
trait FamousImpl
{

    protected $fanList = [];

    /**
     * Add an author to the list
     * 
     * @param \Trismegiste\Socialist\AuthorInterface $auth
     */
    public function addFan(AuthorInterface $auth)
    {
        // @todo Perhaps using the same technique in FollowerImpl ?
        $this->fanList[$auth->getNickname()] = $auth;
    }

    /**
     * How many author like this ?
     * 
     * @return int
     */
    public function getFanCount()
    {
        return count($this->fanList);
    }

    /**
     * Is an author in the list of fan ?
     *
     * @param \Trismegiste\Socialist\AuthorInterface $auth
     * 
     * @return boolean if the fan is in the list
     */
    public function hasFan(AuthorInterface $auth)
    {
        return array_key_exists($auth->getNickname(), $this->fanList);
    }

    /**
     * Delete an author from the list of fan
     *
     * @param \Trismegiste\Socialist\AuthorInterface $auth
     */
    public function removeFan(AuthorInterface $auth)
    {
        unset($this->fanList[$auth->getNickname()]);
    }

    /**
     * Returns an iterator on fans
     * 
     * @return \ArrayIterator
     */
    public function getFanIterator()
    {
        return new \ArrayIterator($this->fanList);
    }

}