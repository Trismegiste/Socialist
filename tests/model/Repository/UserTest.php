<?php

/*
 * Socialist
 */

namespace tests\model\Repository;

use Trismegiste\Socialist\Repository\User;

/**
 * User tests the repository decorator for User
 */
class UserTest extends TestTemplate
{

    protected $sut;
    protected $mockRepo;
    protected $filter;

    protected function createRepository()
    {
        return new User($this->mockRepo);
    }

    protected function getFilter()
    {
        return ['-class' => 'Trismegiste\Socialist\User'];
    }

}