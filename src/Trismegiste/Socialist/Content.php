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

    /**
     * Ctor
     * 
     * @param \Trismegiste\Socialist\AuthorInterface $auth the author of this content
     */
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

    /**
     * Set the timestamp for the last edit of this object
     * 
     * @param \DateTime $d
     */
    public function setLastEdited(\DateTime $d)
    {
        $this->lastEdited = $d;
    }

    /**
     * Returns last edit date
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