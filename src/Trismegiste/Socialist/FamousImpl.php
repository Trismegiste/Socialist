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

    public function addFan(Author $auth)
    {
        $this->fanList[$auth->getNickname()] = $auth;
    }

    public function getFanCount()
    {
        return count($this->fanList);
    }

    public function hasFan(Author $auth)
    {
        return array_key_exists($auth->getNickname(), $this->fanList);
    }

    public function removeFan(Author $auth)
    {
        unset($this->fanList[$auth->getNickname()]);
    }

}