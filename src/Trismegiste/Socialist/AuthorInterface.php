<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

/**
 * AuthorInterface is a contract for an author of something published on the net
 */
interface AuthorInterface
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

    /**
     * Sets the avatar. Could be anything from a file name to a unique id in mongodb
     * 
     * @param string $str an unique identifier for this avatar
     */
    public function setAvatar($str);
}