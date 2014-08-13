<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

/**
 * Content is a content published on the net by an AuthorInterface
 */
abstract class Content implements Famous
{

    use FamousImpl;

    protected $author;

    public function __construct(AuthorInterface $auth)
    {
        $this->author = $auth;
    }

    public function getPublisher()
    {
        return $this->author;
    }

}