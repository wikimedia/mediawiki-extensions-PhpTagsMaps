<?php
namespace MultiMaps;

/**
 * Bounds class for determine the boundaries of the map elements
 *
 * @file Bounds.php
 * @ingroup MultiMaps
 * @author Pavel Astakhov <pastakhov@yandex.ru>
 * @licence GNU General Public Licence 2.0 or later
 * @property-read Point $ne North East point
 * @property-read Point $sw South West point
 * @property-read Point $center center point of bounds
 */
class Bounds {

	/**
	 * North East Point
	 * @var Point
	 */
	protected $northEast = false;

	/**
	 * South West Point
	 * @var Point
	 */
	protected $southWest = false;


	/**
	 * Extend bounds
	 * @param array $coordinates Array of Point objects
	 */
	public function extend( $coordinates ) {
		foreach ($coordinates as $value) {
			if( !$this->isValid() ) {
				$this->northEast = new Point($value->lat, $value->lon);
				$this->southWest = new Point($value->lat, $value->lon);
			} else {
				if( $value->lat < $this->southWest->lat ) {
					$this->southWest->lat = $value->lat;
				} elseif ( $value->lat > $this->northEast->lat ) {
					$this->northEast->lat = $value->lat;
				}

				if( $value->lon < $this->southWest->lon ) {
					$this->southWest->lon = $value->lon;
				} elseif ( $value->lon > $this->northEast->lon ) {
					$this->northEast->lon = $value->lon;
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
				($this->southWest->lat + $this->northEast->lat) / 2,
				($this->southWest->lon + $this->northEast->lon) / 2
		);
	}

	/**
	 * Checks if the object is valid
	 * @return boolean
	 */
	public function isValid() {
		return ($this->northEast !== false && $this->southWest !== false);
	}

	/**
	 * Returns an array of data
	 * @return array
	 */
	public function getData() {
		if( $this->isValid() ) {
			return array(
				'ne' => $this->northEast->getData(),
				'sw' => $this->southWest->getData(),
				);
		}
	}

	public function __get($name) {
		$name = strtolower($name);
		switch ($name) {
			case 'ne':
				return $this->northEast;
				break;
			case 'sw':
				return $this->southWest;
				break;
			case 'center':
				return $this->getCenter();
				break;
		}
		return null;
	}

}
