<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

/**
 * Status is a status update with geolocation
 */
class Status extends Publishing
{

    /** @var float */
    protected $longitude;

    /** @var float */
    protected $latitude;

    /** @var string */
    protected $message;

    /**
     * Sets the longitude of this status
     *
     * @param float $lo
     */
    public function setLongitude($lo)
    {
        $this->longitude = $lo;
    }

    /**
     * Sets the latitude of this status
     *
     * @param float $la
     */
    public function setLatitude($la)
    {
        $this->latitude = $la;
    }

    /**
     * Returns the latitude of this status
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->latitude;
    }

    /**
     * Returns the longitude of this status
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->longitude;
    }

    /**
     * Gets the message associated to this status
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Sets the message associated to this status
     * 
     * @param string $txt
     */
    public function setMessage($txt)
    {
        $this->message = $txt;
    }

}
