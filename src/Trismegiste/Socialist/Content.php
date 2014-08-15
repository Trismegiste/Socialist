<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

/**
 * Content is a content posted on the net by an AuthorInterface
 */
abstract class Content implements Famous, AbusiveReport
{

    use FamousImpl;

    protected $author;
    protected $lastEdited;

    // array of Author for abusive content goes here

    public function __construct(AuthorInterface $auth)
    {
        $this->author = $auth;
        $this->lastEdited = new \DateTime();
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function setLastEdited(\DateTime $d)
    {
        $this->lastEdited = $d;
    }

    public function getLastEdited()
    {
        return $this->lastEdited;
    }

}