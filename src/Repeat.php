<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

/**
 * Repeat is a retweet of a Publishing
 */
class Repeat extends Publishing
{

    /** @var Trismegiste\Socialist\Publishing */
    protected $embedded;

    public function setEmbedded(Publishing $pub)
    {
        if ($pub instanceof Repeat) {
            // we don't retweet a retweet
            $pub = $pub->getEmbedded();
            // @todo at this point, incrementing a retweet counter could be cool
        }

        $this->embedded = clone $pub;
        $this->embedded->removeSubEntities();
    }

    public function getEmbedded()
    {
        return $this->embedded;
    }

}
