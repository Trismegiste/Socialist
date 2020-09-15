<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

use MongoDB\BSON\ObjectId;
use Trismegiste\Toolbox\MongoDb\Root;
use Trismegiste\Toolbox\MongoDb\RootImpl;

/**
 * Publishing is a Content with Commentary and Persistance in mongoDb
 *
 * Like User entity, this is a vertex in the social digraph.
 * It's a rich document in MongoDb
 * It's designated as a "root-entity" in toolbox persistence layer
 *
 */
abstract class Publishing extends Content implements Root, Repeatable, Commentable
{

    use RootImpl;

    /**
     * A list of Commentary : the most recent first
     * @var array
     */
    protected $commentary = [];

    /**
     * A limit for commentaries
     * @var int|null number for the capped list or null if no limit
     */
    protected $cappComm = null;

    /** @var int */
    protected $repeatedCount = 0;

    /**
     * @inheritdoc
     */
    public function attachCommentary(Commentary $comm)
    {
        $comm->setUuid(new ObjectId());
        array_unshift($this->commentary, $comm);

        // manage capped collection of commentaries :
        if (!is_null($this->cappComm) && (count($this->commentary) > $this->cappComm)) {
            array_splice($this->commentary, $this->cappComm - count($this->commentary));
        }
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
        return $this->getPk();
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

    public function setCommentaryLimit($n)
    {
        $this->cappComm = $n;
    }

}
