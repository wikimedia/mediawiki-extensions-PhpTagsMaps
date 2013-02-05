<?php
/**
 * Main classes of MultiMaps extension.
 *
 * @file MultiMaps.body.php
 * @ingroup MultiMaps
 * @author Pavel Astakhov <pastakhov@yandex.ru>
 * @licence GNU General Public Licence 2.0 or later
 */

class MultiMaps {

	/**
	 * Render map on wikipage using appropriate service class
	 *
	 * @param Parser $parser
	 * @return string
	 */
	public static function renderParserFunction_showmap(Parser &$parser) {
		$params = func_get_args();
		array_shift( $params );

		$service = MultiMapsServices::getServiceInstance(
				'showmap',
				isset($params['service']) ? $params['service'] : null
			);

		if( !($service instanceof \MultiMaps\BaseService) ) {
			if( is_string($service) ) {
				return "<span class=\"error\">" . $service . "</span>";
			} else {
				throw new MWException( 'MultiMapsServices::getServiceInstance() must return an object "\MultiMaps\BaseService" or a string describing the error.' );
			}
		}
		$service->parse($params);
		$service->addDependencies($parser);
		return $service->render();
	}

	/**
	 * Recursive search needle in array
	 * @param string $needle
	 * @param array $haystack
	 * @return mixed array key or false
	 */
	public static function recursive_array_search($needle, $haystack) {
		foreach($haystack as $key=>$value) {
			$current_key=$key;
			if($needle===$value OR (is_array($value) && self::recursive_array_search($needle,$value) !== false)) {
				return $current_key;
			}
		}
		return false;
	}

}