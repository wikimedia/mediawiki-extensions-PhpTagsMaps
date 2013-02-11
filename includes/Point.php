<?php
namespace MultiMaps;

/**
 * Determines the point of the map elements
 *
 * @file Bounds.php
 * @ingroup MultiMaps
 * @author Pavel Astakhov <pastakhov@yandex.ru>
 * @licence GNU General Public Licence 2.0 or later
 * @property-read float $lat Latitude coordinate
 * @property-read float $lon Longitude coordinate
 */
class Point {
	/**
	 * Latitude
	 * @var float
	 */
	protected $latitude = false;

	/**
	 * Longitude
	 * @var float
	 */
	protected $longitude = false;

	/**
	 * Constructor
	 * @param float $lat
	 * @param float $lon
	 */
	public function __construct($lat = false, $lon = false) {
		if( is_numeric($lat) && is_numeric($lon)) {
			$this->latitude = $lat;
			$this->longitude = $lon;
		}
	}

	public function __get($name) {
		switch ($name) {
			case 'lat':
				return $this->latitude;
				break;
			case 'lon':
				return $this->longitude;
				break;
		}
		return null;
	}

	public function __set($name, $value) {
		switch ($name) {
			case 'lat':
				if( is_numeric($value) ) {
					$this->latitude = (float) $value;
				} else {
					$this->latitude = false;
				}
				break;
			case 'lon':
				if( is_numeric($value) ) {
					$this->longitude = (float) $value;
				} else {
					$this->longitude = false;
				}
				break;
		}
	}

			/**
	 * Parse geographic coordinates
	 * @param string $string geographic coordinates
	 * @return boolean
	 */
	public function parse($string) {
		$coord = GeoCoordinate::getLatLonFromString($string);
		if( is_array($coord) === false) {
			$this->latitude = false;
			$this->longitude = false;
			return false;
		}
		$this->latitude = $coord['lat'];
		$this->longitude = $coord['lon'];
		return true;
	}

	/**
	 * Move this point at a given distance in meters
	 * @param float $nord To the north (meters)
	 * @param float $east To the East (meters)
	 */
	public function move($nord, $east) {
		GeoCoordinate::moveCoordinatesInMeters($this->latitude, $this->longitude, $nord, $east);
	}

	/**
	 * Checks if the object is valid
	 * @return boolean
	 */
	public function isValid() {
		return ( $this->latitude !== false && $this->longitude !== false );
	}

	/**
	 * Returns an array of data
	 * @return array
	 */
	public function getData() {
		if( $this->isValid() ) {
			return array('lat' => $this->latitude, 'lon' => $this->longitude);
		}
		return null;
	}

}
