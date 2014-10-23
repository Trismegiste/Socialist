<?php

/*
 * Socialist
 */

namespace Trismegiste\Socialist;

/**
 * Status is a status update with geolocation
 */
class Status extends SmallTalk
{

    /** @var float */
    protected $longitude;

    /** @var float */
    protected $latitude;

    /** @var float */
    protected $zoomLevel;

    /**
     * Sets the longitude of this status
     *
     * @param float $lo
     */
    public function setLongitude($lo)
    {
        $this->longitude = (float) $lo;
    }

    /**
     * Sets the latitude of this status
     *
     * @param float $la
     */
    public function setLatitude($la)
    {
        $this->latitude = (float) $la;
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
     * Sets the zoom level of the geo-map
     *
     * @param float $z
     */
    public function setZoom($z)
    {
        $this->zoomLevel = $z;
    }

    /**
     * Gets the zoom level
     *
     * @return float
     */
    public function getZoom()
    {
        return $this->zoomLevel;
    }

}
