<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

use Trismegiste\Yuurei\Persistence\Persistable;
use Trismegiste\Yuurei\Persistence\PersistableImpl;

/**
 * User is a user on the net and stored in MongoDb
 * 
 * Like Publishing entity, this is a vertex in the social digraph.
 * It's a rich document in MongoDb
 * It's designated as a "root-entity" in Yuurei persistence layer

 */
class User implements Famous, Persistable, Follower
{

    use FamousImpl,
        PersistableImpl,
        FollowerImpl;

    protected $author;

    public function __construct(AuthorInterface $author)
    {
        $this->author = $author;
    }

    public function getAuthor()
    {
        return $this->author;
    }

    public function getUniqueId()
    {
        return (string) $this->getId();
    }

}