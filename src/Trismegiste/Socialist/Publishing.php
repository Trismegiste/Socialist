<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

use Trismegiste\Yuurei\Persistence\Persistable;
use Trismegiste\Yuurei\Persistence\PersistableImpl;

/**
 * Publishing is a Content with Commentary and Persistance in mongoDb
 * 
 * Like User entity, this is a vertex in the social digraph.
 * It's a rich document in MongoDb
 * It's designated as a "root-entity" in Yuurei persistence layer
 * 
 */
abstract class Publishing extends Content implements Persistable
{

    use PersistableImpl;

    protected $commentary = [];
    protected $slug;

    public function attachCommentary(Commentary $comm)
    {
        $this->commentary[] = $comm;
    }

    public function detachCommentary(Commentary $comm)
    {
        foreach ($this->commentary as $idx => $current) {
            if ($current === $comm) {
                unset($this->commentary[$idx]);
                break;
            }
        }
    }

    public function getCommentary()
    {
        return $this->commentary;
    }

    /**
     * Gets a commentary by its Uuid
     * 
     * @param type $uuid
     * 
     * @return Commentary|null
     */
    public function getCommentaryByUuid($uuid)
    {
        foreach ($this->commentary as $comm) {
            if ($comm->getUuid() === $uuid) {
                return $comm;
            }
        }

        return null;
    }

}