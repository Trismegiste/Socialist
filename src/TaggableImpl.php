<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

/**
 * TaggableImpl is an implementation of
 */
trait TaggableImpl
{

    /**
     * Parse a string and returns all tags
     *
     * @param string $str
     *
     * @return array
     */
    protected function parseTag($str)
    {
        $match = [];
        preg_match_all('/#([^\s^"^\'^#]+)/', $str, $match, PREG_PATTERN_ORDER);

        return array_unique($match[1]);
    }

}
