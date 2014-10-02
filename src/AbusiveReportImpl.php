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

}
