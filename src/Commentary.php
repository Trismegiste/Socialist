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
     * @return mixed
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Sets the unique identifier for this commentary
     *
     * @param mixed $uuid
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
    }

}
