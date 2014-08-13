<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

/**
 * Content is a content published on the net by an AuthorInterface
 */
abstract class Content implements Famous
{

    use FamousImpl;

    protected $author;
    protected $lastEdited;

    public function __construct(AuthorInterface $auth)
    {
        $this->author = $auth;
        $this->lastEdited = new \DateTime();
    }

    public function getPublisher()
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