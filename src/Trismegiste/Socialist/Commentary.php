<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

/**
 * Commentary is a comment on one Publishing
 */
class Commentary extends Content
{

    protected $message;

    public function getMessage()
    {
        return $this->message;
    }

    public function setMessage($str)
    {
        $this->message = $str;
    }

}