<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

/**
 * Author is a contract for an author of something published on the net
 */
interface Author
{

    /**
     * What is your name ?
     * 
     * @return string
     */
    public function getNickname();

    /**
     * What is your look ?
     * 
     * @return string
     */
    public function getAvatar();
}