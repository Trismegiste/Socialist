<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

/**
 * Taggable is a contract for an entity with hash-tag
 */
interface Taggable
{

    /**
     * Gets the tag list
     *
     * @return array an array of string
     */
    public function getTagList();
}
