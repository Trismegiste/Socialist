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
     * How many Authors like this ?
     * 
     * @return int
     */
    public function getFanCount();

    /**
     * Is an Author in the list of fan ?
     */
    public function hasFan(Author $auth);

    /**
     * Delete an Author from the list of fan
     */
    public function removeFan(Author $auth);

    /**
     * Add an Author to the list
     */
    public function addFan(Author $auth);
}