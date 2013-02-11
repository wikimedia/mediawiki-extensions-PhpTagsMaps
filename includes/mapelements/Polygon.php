<?php
namespace MultiMaps;

/**
 * Polygon class for collection of map elements
 *
 * @file Polygon.php
 * @ingroup MultiMaps
 * @author Pavel Astakhov <pastakhov@yandex.ru>
 * @licence GNU General Public Licence 2.0 or later
 * @property boolean $fill
 * @property string $fillcolor
 * @property string $fillopacity
 */
class Polygon extends Line {

	/**
	 * Constructor
	 */
	function __construct() {
		parent::__construct();

		$this->availableProperties = array_merge(
				$this->availableProperties,
				array( 'fillcolor', 'fillopacity', 'fill' )
				);
	}

	/**
	 * Returns element name
	 * return string Element name
	 */
	public function getElementName() {
		return 'Polygon'; //TODO i18n?
	}

	public function setProperty($name, $value) {
		$name = strtolower($name);
		$value = trim($value);

		switch ($name) {
			case 'fillcolor':
			case 'fillopacity':
				$this->fill = true;
			default:
				return parent::setProperty($name, $value);
				break;
		}
	}

}
