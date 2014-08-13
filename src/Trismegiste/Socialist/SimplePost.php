<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

/**
 * SimplePost is a simple article with title and body
 */
class SimplePost extends Publishing
{

    protected $title;
    protected $body;

    public function setTitle($str)
    {
        $this->title = $str;
    }

    public function getTitle()
    {
        return $this->title;
    }

    public function setBody($str)
    {
        $this->body = $str;
    }

    public function getBody()
    {
        return $this->body;
    }

}