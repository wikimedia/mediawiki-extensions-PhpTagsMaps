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
		$this->headerItem .= '<link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.5/leaflet.css" />' . "\n" .
				'<!--[if lte IE 8]><link rel="stylesheet" href="http://cdn.leafletjs.com/leaflet-0.5/leaflet.ie.css" /><![endif]-->' . "\n" .
				'<script src="http://cdn.leafletjs.com/leaflet-0.5/leaflet.js"></script>' . "\n";
		$this->resourceModules[] = 'ext.MultiMaps.Leaflet';
	}
}
