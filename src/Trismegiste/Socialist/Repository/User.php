<?php

/*
 * Iinano
 */

namespace Trismegiste\Socialist\Repository;

use Trismegiste\Yuurei\Persistence\RepositoryInterface;
use Trismegiste\DokudokiBundle\Persistence\OneClassDecorator;
use Trismegiste\DokudokiBundle\Transform\Mediator\Colleague\MapAlias;

/**
 * User a repository for User
 */
class User extends OneClassDecorator
{

    public function __construct(RepositoryInterface $wrapped)
    {
        parent::__construct($wrapped, MapAlias::CLASS_KEY, 'Trismegiste\Socialist\User');
    }

}