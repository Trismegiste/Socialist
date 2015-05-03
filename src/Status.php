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

    const LONGITUD = 0;
    const LATITUD = 1;
    const GEOPROP = 'coordinates';

    /** @var geoJSON */
    protected $location = ['type' => 'Point', self::GEOPROP => [null, null]];

    /** @var float */
    protected $zoomLevel;

    /**
     * Sets the longitude of this status
     *
     * @param float $lo
     */
    public function setLongitude($lo)
    {
        $this->location[self::GEOPROP][self::LONGITUD] = (float) $lo;
    }

    /**
     * Sets the latitude of this status
     *
     * @param float $la
     */
    public function setLatitude($la)
    {
        $this->location[self::GEOPROP][self::LATITUD] = (float) $la;
    }

    /**
     * Returns the latitude of this status
     *
     * @return float
     */
    public function getLatitude()
    {
        return $this->location[self::GEOPROP][self::LATITUD];
    }

    /**
     * Returns the longitude of this status
     *
     * @return float
     */
    public function getLongitude()
    {
        return $this->location[self::GEOPROP][self::LONGITUD];
    }

    /**
     * Sets the zoom level of the geo-map
     *
     * @param float $z
     */
    public function setZoom($z)
    {
        $this->zoomLevel = (float) $z;
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
