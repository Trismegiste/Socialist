<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

/**
 * Commentable is a contract for an object which aggregrates Commentary
 */
interface Commentable
{

    /**
     * Attach a commentary to this Published content
     *
     * @param \Trismegiste\Socialist\Commentary $comm
     */
    public function attachCommentary(Commentary $comm);

    /**
     * Detach a commentary off this Published content
     *
     * @param \Trismegiste\Socialist\Commentary $comm
     */
    public function detachCommentary(Commentary $comm);

    /**
     * Returns the counter for commmentaries embedded in this object
     *
     * @return int
     */
    public function getCommentaryCount();

    /**
     * Returns a outer iterator on commmentaries for this object
     *
     * @return \ArrayIterator
     */
    public function getCommentaryIterator();

    /**
     * Gets a commentary by its Unique Id
     *
     * @param string $uuid
     *
     * @return Commentary|null null if no commentary found
     */
    public function getCommentaryByUuid($uuid);
}
