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

    public function __construct(AuthorInterface $auth)
    {
        parent::__construct($auth);
        $this->uuid = sha1($auth->getNickname() . microtime(true));
    }

    public function getMessage()
    {
        return $this->message;
    }

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