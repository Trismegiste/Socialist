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
    protected $uuid;

    /**
     * Builds the Commentary with the author
     * 
     * @param \Trismegiste\Socialist\AuthorInterface $auth
     */
    public function __construct(AuthorInterface $auth)
    {
        parent::__construct($auth);
        $this->uuid = sha1($auth->getNickname() . microtime(true));
    }

    /**
     * Gets the texte of this message
     * 
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Sets the content of this message
     * 
     * @param string $str
     */
    public function setMessage($str)
    {
        $this->message = $str;
    }

    /**
     * returns unique identifier for this commentary
     * 
     * @return string
     */
    public function getUuid()
    {
        return $this->uuid;
    }

}