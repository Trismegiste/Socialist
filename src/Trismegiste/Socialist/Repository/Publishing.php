<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist\Repository;

use Trismegiste\Yuurei\Persistence\RepositoryInterface;
use Trismegiste\DokudokiBundle\Persistence\MultipleClassDecorator;
use Trismegiste\DokudokiBundle\Transform\Mediator\Colleague\MapAlias;

/**
 * Publishing is a repository for Publishing content and its subclasses
 */
class Publishing extends MultipleClassDecorator
{

    public function __construct(RepositoryInterface $wrapped)
    {
        parent::__construct($wrapped, MapAlias::CLASS_KEY, ['Trismegiste\Socialist\SimplePost']);
    }

}