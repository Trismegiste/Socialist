<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

use Trismegiste\Yuurei\Persistence\Persistable;
use Trismegiste\Yuurei\Persistence\PersistableImpl;

/**
 * User is a user on the net and stored in MongoDb
 */
class User implements Famous, Persistable
{

    use FamousImpl,
        PersistableImpl;

    protected $author;

    public function __construct(AuthorInterface $author)
    {
        $this->author = $author;
    }

    public function getAuthor()
    {
        return $this->author;
    }

}