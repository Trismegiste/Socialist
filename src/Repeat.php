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

    /**
     * Sets the repeated Publishing content
     *
     * @param \Trismegiste\Socialist\Publishing $pub
     */
    public function setEmbedded(Publishing $pub)
    {
        // we don't retweet a retweet :
        if ($pub instanceof Repeat) {
            $pub = $pub->getEmbedded();
        }
        // an author shouldn't repeat himself :
        if ($pub->getAuthor()->isEqual($this->getAuthor())) {
            throw new \DomainException('You cannot repeat yourself');
        }

        $this->embedded = clone $pub;
        $this->embedded->removeSubEntities();
        $this->repeatedCount = $pub->getRepeatedCount() + 1; // just to fake th real increment
    }

    /**
     * Gets the repeated Publishing content
     *
     * @return Publishing
     */
    public function getEmbedded()
    {
        return $this->embedded;
    }

    /**
     * @inheritdoc
     */
    public function isEditable()
    {
        return false;
    }

    /**
     * {@inheritdoc}
     * Since getId() can return null (= new record), Liskov dictates to return
     * null when no embedded is set (in no way you'd throw an exception).
     */
    public function getSourceId()
    {
        return is_null($this->embedded) ? null : $this->embedded->getPk();
    }

}
