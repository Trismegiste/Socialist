<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

/**
 * AbusiveReport is a contract for reporting and counting if a content
 * is abusive/offensive...
 */
interface AbusiveReport
{

    /**
     * Report a content as abusive content
     *
     * @param \Trismegiste\Socialist\AuthorInterface $author
     * @param string $msg
     */
    public function report(AuthorInterface $author, $msg = '');
}
