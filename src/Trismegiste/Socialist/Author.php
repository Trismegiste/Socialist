<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

/**
 * Author is an implementation of AuthorInterface
 */
class Author implements AuthorInterface
{

    protected $nickname; // unique
    protected $avatar;

    public function __construct($name)
    {
        $this->nickname = $name;
    }

    public function setAvatar($str)
    {
        $this->avatar = $str;
    }

    public function getAvatar()
    {
        return $this->avatar;
    }

    public function getNickname()
    {
        return $this->nickname;
    }

}