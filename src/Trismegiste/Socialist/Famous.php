<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

/**
 * Famous is a contract for something published on the net
 * which is famous ("like" for example)
 */
interface Famous
{

    /**
     * How many author like this ?
     * 
     * @return int
     */
    public function getFanCount();

    /**
     * Is an author in the list of fan ?
     *
     * @param \Trismegiste\Socialist\AuthorInterface $auth
     * 
     * @return boolean if the fan is in the list
     */
    public function hasFan(AuthorInterface $auth);

    /**
     * Delete an author from the list of fan
     *
     * @param \Trismegiste\Socialist\AuthorInterface $auth
     */
    public function removeFan(AuthorInterface $auth);

    /**
     * Add an author to the list
     * 
     * @param \Trismegiste\Socialist\AuthorInterface $auth
     */
    public function addFan(AuthorInterface $auth);

    /**
     * Returns an iterator on fans
     * 
     * @return \ArrayIterator
     */
    public function getFanIterator();
}