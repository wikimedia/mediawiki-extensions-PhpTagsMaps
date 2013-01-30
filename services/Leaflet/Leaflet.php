<?php
namespace MultiMaps;
/**
 * This groupe contains all Leaflet related files of the MultiMaps extension.
 *
 * @defgroup Leaflet
 * @ingroup MultiMaps
 */

/**
 *
 *
 * @file Leaflet.php
 * @ingroup Leaflet
 *
 * @licence GNU GPL v2+
 * @author Pavel Astakhov < pastakhov@yandex.ru >
 */
class Leaflet extends BaseService {

    function __construct() {
        parent::__construct();
        $this->classname="leaflet";
        $this->resourceModules[] = 'ext.MultiMaps.Leaflet';
    }

    /**
     * Retun array of all extra defined modules that can later be loaded during the output
     * @codeCoverageIgnore
     * @link http://www.mediawiki.org/wiki/Manual:$wgResourceModules $wgResourceModules
     * @return array
     */
    public function getResourceModules() {
        return array(
            'ext.MultiMaps.Leaflet' => array(
                'styles' => array( 'leaflet/leaflet.css', 'leaflet/leaflet.ie.css' ),
                'scripts' => array( 'leaflet/leaflet.js', 'ext.leaflet.js' ),
                'localBasePath' => __DIR__,
                'remoteExtPath' => 'MultiMaps/services/Leaflet',
                'group' => 'ext.MultiMaps',
                ),
            );
    }

}
