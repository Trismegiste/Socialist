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
     * How many AuthorInterfaces like this ?
     * 
     * @return int
     */
    public function getFanCount();

    /**
     * Is an AuthorInterface in the list of fan ?
     */
    public function hasFan(AuthorInterface $auth);

    /**
     * Delete an AuthorInterface from the list of fan
     */
    public function removeFan(AuthorInterface $auth);

    /**
     * Add an AuthorInterface to the list
     */
    public function addFan(AuthorInterface $auth);
}