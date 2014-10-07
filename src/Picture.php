<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

/**
 * Picture is a published picture with a text
 */
class Picture extends SmallTalk
{

    /**
     * @var string the object's key in the storage system (no assumption)
     */
    protected $storageKey;

    /**
     * @var string the mime-type of this picture
     */
    protected $mimeType = 'image/*';

    /**
     * set the storage key of this picture
     * For optimizing perf, this key must start with randomness
     * like md5($nickname . time()) . '-' . $filename
     *
     * @param string $key
     */
    public function setStorageKey($key)
    {
        $this->storageKey = $key;
    }

    /**
     * get the storage key of this picture
     *
     * @return string $key
     */
    public function getStorageKey()
    {
        return $this->storageKey;
    }

    /**
     * set the mime-type of this picture
     *
     * @param string $str A string like "image/jpeg" or "image/png"
     */
    public function setMimeType($str)
    {
        $this->mimeType = $str;
    }

    /**
     * Get the mime-type
     *
     * @return string
     */
    public function getMimeType()
    {
        return $this->mimeType;
    }

}
