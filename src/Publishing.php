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
abstract class Publishing extends Content implements Persistable, Repeatable, Commentable
{

    use PersistableImpl;

    /**
     * A list of Commentary : the most recent first
     * @var array
     */
    protected $commentary = [];

    /** @var int */
    protected $repeatedCount = 0;

    /**
     * @inheritdoc
     */
    public function attachCommentary(Commentary $comm)
    {
        $comm->setUuid(new \MongoId());
        array_unshift($this->commentary, $comm);
    }

    /**
     * @inheritdoc
     */
    public function detachCommentary(Commentary $comm)
    {
        foreach ($this->commentary as $idx => $current) {
            if ($current === $comm) {
                array_splice($this->commentary, $idx, 1);
                break;
            }
        }
    }

    /**
     * @inheritdoc
     */
    public function getCommentaryCount()
    {
        return count($this->commentary);
    }

    /**
     * @inheritdoc
     */
    public function getCommentaryIterator()
    {
        return new \ArrayIterator($this->commentary);
    }

    /**
     * @inheritdoc
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
     * @inheritdoc
     */
    public function getSourceId()
    {
        return $this->getId();
    }

    /**
     * @inheritdoc
     */
    public function getRepeatedCount()
    {
        return $this->repeatedCount;
    }

    public function isLastCommenter(AuthorInterface $author)
    {
        if (count($this->commentary)) {
            return $author->isEqual($this->commentary[0]->getAuthor());
        }

        return false;
    }

}
