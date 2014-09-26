<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

use Trismegiste\Yuurei\Persistence\Persistable;
use Trismegiste\Yuurei\Persistence\PersistableImpl;

/**
 * PrivateMessage is a private message from one author to another author
 */
class PrivateMessage implements Persistable
{

    use PersistableImpl;

    protected $message;

    /** @var \Trismegiste\Socialist\AuthorInterface */
    protected $source;

    /** @var \Trismegiste\Socialist\AuthorInterface */
    protected $target;

    public function __construct(AuthorInterface $source, AuthorInterface $target)
    {
        if ($source === $target) {
            throw new \LogicException("One cannot send a message to oneself");
        }
        $this->source = $source;
        $this->target = $target;
    }

    /**
     * Gets the originated sender of this message
     *
     * @return AuthorInterface
     */
    public function getSender()
    {
        return $this->source;
    }

    /**
     * Gets the targeted author
     *
     * @return AuthorInterface
     */
    public function getTarget()
    {
        return $this->target;
    }

    /**
     * Set the message content
     *
     * @param string $str
     */
    public function setMessage($str)
    {
        $this->message = $str;
    }

    /**
     * Gets the message content
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

}
