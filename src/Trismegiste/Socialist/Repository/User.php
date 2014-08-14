<?php

/*
 * Iinano
 */

namespace Trismegiste\Socialist\Repository;

use Trismegiste\Yuurei\Persistence\Decorator;
use Trismegiste\DokudokiBundle\Transform\Mediator\Colleague\MapAlias;

/**
 * User a repository for User
 */
class User extends Decorator
{

    const FQCN = 'Trismegiste\Socialist\User';

    public function find(array $query = array())
    {
        $query[MapAlias::CLASS_KEY] = self::FQCN;

        return $this->decorated->find($query);
    }

    public function findOne(array $query = array())
    {
        $query[MapAlias::CLASS_KEY] = self::FQCN;

        return $this->decorated->findOne($query);
    }

    public function getCursor(array $query = array(), array $fields = array())
    {
        $query[MapAlias::CLASS_KEY] = self::FQCN;

        return $this->decorated->getCursor($query, $fields);
    }

}