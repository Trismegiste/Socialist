<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

/**
 * Author is an implementation of AuthorInterface
 */
class Author implements AuthorInterface, \MongoDB\BSON\Persistable
{

    use \Trismegiste\Toolbox\MongoDb\PersistableImpl;

    protected $nickname; // unique
    protected $avatar;

    /**
     * Ctor
     *
     * @param string $name the uniique name for this author
     */
    public function __construct($name)
    {
        $this->nickname = $name;
    }

    /**
     * {@inheritDoc}
     */
    public function setAvatar($str)
    {
        $this->avatar = $str;
    }

    /**
     * {@inheritDoc}
     */
    public function getAvatar()
    {
        return $this->avatar;
    }

    /**
     * {@inheritDoc}
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * {@inheritDoc}
     */
    public function isEqual(AuthorInterface $other)
    {
        return $this->nickname === $other->getNickname();
    }

}
