<?php

/*
 * Socialist
 */

namespace tests\model\Repository;

use Trismegiste\Socialist\Repository\Publishing;

/**
 * User tests the repository decorator for User
 */
class PublishingTest extends TestTemplate
{

    protected $sut;
    protected $mockRepo;
    protected $filter;

    protected function createRepository()
    {
        return new Publishing($this->mockRepo);
    }

    protected function getFilter()
    {
        return ['-class' => ['$in' => ['Trismegiste\Socialist\SimplePost']]];
    }

}