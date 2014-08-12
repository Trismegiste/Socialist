<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

/**
 * Content is a content published on the net by an Author
 */
abstract class Content implements Famous
{

    use FamousImpl;

    protected $author;

    public function __construct(Author $auth)
    {
        $this->author = $auth;
    }

}