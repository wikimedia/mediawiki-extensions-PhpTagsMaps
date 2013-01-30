<?php
namespace MultiMaps;

/**
 * Determines the point of the map elements
 *
 * @file Bounds.php
 * @ingroup MultiMaps
 * @author Pavel Astakhov <pastakhov@yandex.ru>
 * @licence GNU General Public Licence 2.0 or later
 */
class Point {
    /**
     * Latitude
     * @todo read only
     * @var float
     */
    public $lat;

    /**
     * Longitude
     * @todo read only
     * @var float
     */
    public $lon;

    /**
     * Constructor
     * @param float $lat
     * @param float $lon
     */
    public function __construct($lat = false, $lon = false) {
        $this->lat = $lat;
        $this->lon = $lon;
    }

    /**
     * Parse geographic coordinates
     * @param string $string geographic coordinates
     * @return boolean
     */
    public function parse($string) {
        $coord = GeoCoordinate::getLatLonFromString($string);
        if( is_array($coord) === false) {
            $this->lat = false;
            $this->lon = false;
            return false;
        }
        $this->lat = $coord['lat'];
        $this->lon = $coord['lon'];
        return true;
    }

}
