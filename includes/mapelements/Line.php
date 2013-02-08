<?php
namespace MultiMaps;

/**
 * Line class for collection of map elements
 *
 * @file Line.php
 * @ingroup MultiMaps
 * @author Pavel Astakhov <pastakhov@yandex.ru>
 * @licence GNU General Public Licence 2.0 or later
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
	protected function getElementName() {
		return 'Line'; //TODO i18n?
	}

}
