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
     */
    public function report(AuthorInterface $author);

    /**
     * Cancel a report
     *
     * @param \Trismegiste\Socialist\AuthorInterface $author
     */
    public function cancelReport(AuthorInterface $author);

    /**
     * Is an author has reported this content as abuse/spam ?
     *
     * @param \Trismegiste\Socialist\AuthorInterface $author
     *
     * @return boolean
     */
    public function isReportedBy(AuthorInterface $author);

    /**
     * Get the abuse reports count
     * 
     * @return int
     */
    public function getReportedCount(): int;
}
