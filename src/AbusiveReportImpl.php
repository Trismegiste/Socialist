<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

/**
 * AbusiveReportImpl is an implementation for AbusiveReport contract
 */
trait AbusiveReportImpl
{

    protected $abusive = [];

    public function report(AuthorInterface $author, $msg = '')
    {
        $this->abusive[$author->getNickname()] = $msg;
    }

    public function isReportedBy(AuthorInterface $author)
    {
        return array_key_exists($author->getNickname(), $this->abusive);
    }

    public function cancelReport(AuthorInterface $author)
    {
        unset($this->abusive[$author->getNickname()]);
    }

}
