<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist\Repository;

use Trismegiste\Yuurei\Persistence\Decorator;
use Trismegiste\DokudokiBundle\Transform\Mediator\Colleague\MapAlias;

/**
 * Publishing is a repository for Publishing content and its subclasses
 */
class Publishing extends Decorator
{

    protected $subclasses = ['Trismegiste\Socialist\SimplePost'];

    public function find(array $query = array())
    {
        $query[MapAlias::CLASS_KEY] = ['$in' => $this->subclasses];

        return $this->decorated->find($query);
    }

    public function findOne(array $query = array())
    {
        $query[MapAlias::CLASS_KEY] = ['$in' => $this->subclasses];

        return $this->decorated->findOne($query);
    }

    public function getCursor(array $query = array(), array $fields = array())
    {
        $query[MapAlias::CLASS_KEY] = ['$in' => $this->subclasses];

        return $this->decorated->getCursor($query, $fields);
    }

}