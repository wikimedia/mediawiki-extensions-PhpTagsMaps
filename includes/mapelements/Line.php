<?php
namespace MultiMaps;

/**
 * Line class for collection of map elements
 *
 * @file Line.php
 * @ingroup MultiMaps
 * @author Pavel Astakhov <pastakhov@yandex.ru>
 * @licence GNU General Public Licence 2.0 or later
 * @property string $color Color line
 * @property string $weight Weight line
 * @property string $opacity Opacity line
 */
class Line extends BaseMapElement {

	/**
	 * Constructor
	 */
	function __construct() {
		parent::__construct();

		$this->availableProperties = array_merge(
				$this->availableProperties,
				array( 'color', 'weight', 'opacity' )
				);
	}

	/**
	 * Returns element name
	 * return string Element name
	 */
	public function getElementName() {
		return 'Line'; //TODO i18n?
	}

}
