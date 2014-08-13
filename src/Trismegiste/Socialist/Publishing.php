<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

use Trismegiste\Yuurei\Persistence\Persistable;
use Trismegiste\Yuurei\Persistence\PersistableImpl;

/**
 * Publishing is a Content with Commentary and Persistance in mongoDb
 */
abstract class Publishing extends Content implements Persistable
{

    use PersistableImpl;

    protected $commentary = [];

    public function attachCommentary(Commentary $comm)
    {
        $this->commentary[] = $comm;
    }

    public function detachCommentary(Commentary $comm)
    {
        foreach ($this->commentary as $idx => $current) {
            if ($current === $comm) {
                unset($this->commentary[$idx]);
                break;
            }
        }
    }

}