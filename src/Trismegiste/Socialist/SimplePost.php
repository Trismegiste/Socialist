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

    /**
     * Sets the title of this content
     * 
     * @param string $str
     */
    public function setTitle($str)
    {
        $this->title = $str;
    }

    /**
     * Gets the title of this content
     * 
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Sets the body of this content
     * 
     * @param string $str
     */
    public function setBody($str)
    {
        $this->body = $str;
    }

    /**
     * Gets the body of this content
     * 
     * @return string
     */
    public function getBody()
    {
        return $this->body;
    }

}