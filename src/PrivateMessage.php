<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

use Trismegiste\Toolbox\MongoDb\Root;
use Trismegiste\Toolbox\MongoDb\RootImpl;

/**
 * PrivateMessage is a private message from one author to another author
 */
class PrivateMessage implements Root
{

    use RootImpl;

    protected $pmBody;
    protected $read = false;

    /** @var \DateTime */
    protected $sentAt;

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
        $this->sentAt = new \DateTime();
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
        $this->pmBody = $str;
    }

    /**
     * Gets the message content
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->pmBody;
    }

    /**
     * Is this message already been read ?
     *
     * @return bool
     */
    public function isRead()
    {
        return $this->read;
    }

    /**
     * Sets this message as "read"
     */
    public function markAsRead()
    {
        $this->read = true;
    }

    /**
     * Returns the date when this message was sent
     *
     * @return \DateTime
     */
    public function getSentAt()
    {
        return $this->sentAt;
    }

}
