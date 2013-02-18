<?php
namespace MultiMaps;
/**
 * This groupe contains all Google related files of the MultiMaps extension.
 *
 * @defgroup Google
 * @ingroup MultiMaps
 */

/**
 *
 *
 * @file Google.php
 * @ingroup Google
 *
 * @licence GNU GPL v2+
 * @author Pavel Astakhov < pastakhov@yandex.ru >
 */
class Google extends BaseService {

	function __construct() {
		parent::__construct();
		$this->classname="google";
		$this->resourceModules[] = 'ext.MultiMaps.Google';

		$urlArgs = array();
		$urlArgs['sensor'] = 'false';
		$this->headerItem .= \Html::linkedScript( 'http://maps.googleapis.com/maps/api/js?'.wfArrayToCgi($urlArgs) ) . "\n";
	}

}