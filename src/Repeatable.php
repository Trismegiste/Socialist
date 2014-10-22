<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

/**
 * Repeatable is a contract for a content that could be repeated
 */
interface Repeatable
{

    /**
     * Gets the id of the original Publishing source (except when the Publishing is a
     * Repeat, this id is generally equal to getId().
     *
     * @return \MongoId
     */
    public function getSourceId();

    /**
     * Gets the count how many the source content has been repeated (map-reduced)
     *
     * @return int
     */
    public function getRepeatedCount();
}
