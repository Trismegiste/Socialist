<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

/**
 * SmallTalk is a small message (like a tweet)
 */
class SmallTalk extends Publishing
{

    /** @var string */
    protected $message;

    /**
     * Gets the message associated to this status
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Sets the message associated to this status
     *
     * @param string $txt
     */
    public function setMessage($txt)
    {
        $this->message = $txt;
    }

}
