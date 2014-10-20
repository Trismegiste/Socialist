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
     * A list of Commentary : the most recent first
     * @var array
     */
    protected $commentary = [];

    /**
     * Attach a commentary to this Published content
     *
     * @param \Trismegiste\Socialist\Commentary $comm
     */
    public function attachCommentary(Commentary $comm)
    {
        $comm->setUuid(new \MongoId());
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
     * Returns the counter for commmentaries embedded in this object
     *
     * @return int
     */
    public function getCommentaryCount()
    {
        return count($this->commentary);
    }

    /**
     * Returns a outer iterator on commmentaries for this object
     *
     * @return \ArrayIterator
     */
    public function getCommentaryIterator()
    {
        return new \ArrayIterator($this->commentary);
    }

    /**
     * Gets a commentary by its Unique Id
     *
     * @param string $uuid
     *
     * @return Commentary|null null if no commentary found
     */
    public function getCommentaryByUuid($uuid)
    {
        foreach ($this->commentary as $comm) {
            if ((string) $comm->getUuid() === $uuid) {
                return $comm;
            }
        }

        return null;
    }

    /**
     * Clean this object by removing all embedded sub-entities :
     * - fanList (like)
     * - commentaries
     * - abuse reports
     *
     * Of course, we keep the mandatory Author...
     */
    public function removeSubEntities()
    {
        $this->fanList = [];
        $this->commentary = [];
        $this->abusive = [];
    }

    /**
     * Is this published content editable after its creation ?
     *
     * @return boolean
     */
    public function isEditable()
    {
        return true;
    }

    /**
     * Gets the id of the original Publishing source (except when the Publishing is a
     * Repeat, this id is generally equal to getId().
     *
     * @return \MongoId
     */
    public function getSourceId()
    {
        return $this->getId();
    }

}
