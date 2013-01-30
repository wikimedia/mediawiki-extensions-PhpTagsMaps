<?php
namespace MultiMaps;

/**
 * Bounds class for determine the boundaries of the map elements
 *
 * @file Bounds.php
 * @ingroup MultiMaps
 * @author Pavel Astakhov <pastakhov@yandex.ru>
 * @licence GNU General Public Licence 2.0 or later
 */
class Bounds {

    /**
     * North East Point
     * @var Point
     */
    public $ne = false;

    /**
     * South West Point
     * @var Point
     */
    public $sw = false;


    /**
     * Extend bounds
     * @param array $coordinates Array of Point objects
     */
    public function extend( $coordinates ) {
        foreach ($coordinates as $value) {
            if( !$this->isValid() ) {
                $this->ne = new Point($value->lat, $value->lon);
                $this->sw = new Point($value->lat, $value->lon);
            } else {
                if( $value->lat < $this->sw->lat ) {
                    $this->sw->lat = $value->lat;
                } elseif ( $value->lat > $this->ne->lat ) {
                    $this->ne->lat = $value->lat;
                }

                if( $value->lon < $this->sw->lon ) {
                    $this->sw->lon = $value->lon;
                } elseif ( $value->lon > $this->ne->lon ) {
                    $this->ne->lon = $value->lon;
                }
            }
        }
    }

    /**
     * Returns center of bounds
     * @return boolean|\MultiMaps\Point
     */
    public function getCenter() {
        if ( !$this->isValid() ) {
            return false;
        }

        return new \MultiMaps\Point(
                ($this->sw->lat + $this->ne->lat) / 2,
                ($this->sw->lon + $this->ne->lon) / 2
        );
    }

    /**
     * Checks if the object is valid
     * @return boolean
     */
    public function isValid() {
        return ($this->ne !== false && $this->sw !== false);
    }

}
