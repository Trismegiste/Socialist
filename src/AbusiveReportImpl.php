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
    protected $abusiveCount = 0;

    public function report(AuthorInterface $author)
    {
        $this->abusive[$author->getNickname()] = true;
        $this->abusiveCount = count($this->abusive);
    }

    public function isReportedBy(AuthorInterface $author)
    {
        return array_key_exists($author->getNickname(), $this->abusive);
    }

    public function cancelReport(AuthorInterface $author)
    {
        unset($this->abusive[$author->getNickname()]);
        $this->abusiveCount = count($this->abusive);
    }

    public function getReportedCount(): int
    {
        return count($this->abusive);
    }

}
