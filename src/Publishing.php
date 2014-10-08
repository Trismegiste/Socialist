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

    /**
     * An unsorted list of Commentary
     * @var array
     */
    protected $commentary = [];

    /**
     * A slug for this content
     *
     * @var string
     */
    protected $slug;

    /**
     * Attach a commentary to this Published content
     *
     * @param \Trismegiste\Socialist\Commentary $comm
     */
    public function attachCommentary(Commentary $comm)
    {
        array_unshift($this->commentary, $comm);
    }

    /**
     * Detach a commentary off this Published content
     *
     * @param \Trismegiste\Socialist\Commentary $comm
     */
    public function detachCommentary(Commentary $comm)
    {
        foreach ($this->commentary as $idx => $current) {
            if ($current === $comm) {
                unset($this->commentary[$idx]);
                break;
            }
        }
    }

    /**
     * Returns the list of commmentaries for this object
     *
     * @return array
     */
    public function getCommentary()
    {
        return $this->commentary;
    }

    /**
     * Returns a outer iterator on commmentaries for this object
     *
     * @return array
     */
    public function getCommentaryIterator()
    {
        return new \ArrayIterator($this->commentary);
    }

    /**
     * Gets a commentary by its Unique Id
     *
     * @param type $uuid
     *
     * @return Commentary|null null if no commentary found
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

    public function removeSubEntities()
    {
        $this->fanList = [];
        $this->commentary = [];
        $this->abusive = [];
    }

}
