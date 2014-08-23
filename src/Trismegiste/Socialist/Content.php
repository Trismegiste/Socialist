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
    protected $createdAt;

    // array of Author for abusive content goes here

    public function __construct(AuthorInterface $auth)
    {
        $this->author = $auth;
        $this->createdAt = new \DateTime();
        $this->lastEdited = new \DateTime();
    }

    /**
     * Returns the author of this object
     * 
     * @return AuthorInterface
     */
    public function getAuthor()
    {
        return $this->author;
    }

    public function setLastEdited(\DateTime $d)
    {
        $this->lastEdited = $d;
    }

    /**
     * returns last edit date
     * 
     * @return \DateTime
     */
    public function getLastEdited()
    {
        return $this->lastEdited;
    }

    /**
     * returns date of creation for this entity
     * 
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }

}