<?php
namespace MultiMaps;

/**
 * Marker class for collection of map elements
 *
 * @file BaseService.php
 * @ingroup MultiMaps
 * @author Pavel Astakhov <pastakhov@yandex.ru>
 * @licence GNU General Public Licence 2.0 or later
 */
class Marker extends BaseMapElement {

    protected function getElementName() {
        return 'Marker'; //TODO i18n?
    }

}
