<?php
namespace MultiMaps;

/**
 * Polygon class for collection of map elements
 *
 * @file Polygon.php
 * @ingroup MultiMaps
 * @author Pavel Astakhov <pastakhov@yandex.ru>
 * @licence GNU General Public Licence 2.0 or later
 */
class Polygon extends BaseMapElement {

	protected function getElementName() {
		return 'Polygon'; //TODO i18n?
	}

}
