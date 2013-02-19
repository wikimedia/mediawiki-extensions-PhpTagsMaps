<?php
/**
 * This class allows you to work with a collection of defined services
 *
 * @file Services.php
 * @ingroup MultiMaps
 * @author Pavel Astakhov <pastakhov@yandex.ru>
 * @licence GNU General Public Licence 2.0 or later
 */

class MultiMapsServices {

	/**
	 * Returns the instance of a service class.
	 * If the service is not specified or is not available, the service returns the specified default
	 * On error returns error message
	 * @global array $egMultiMapsServices_showmap
	 * @param string $action
	 * @param string $servicename
	 * @return MultiMaps\BaseService return class extends \MultiMaps\BaseService or string of error message
	 */
	public static function getServiceInstance( $action, $servicename ) {
		global $egMultiMapsServices_showmap;

		//default error message
		$returnservice =  wfMessage( 'multimaps-method-error-unexpected-result', __METHOD__ . " ( $action, $servicename ) " )->escaped();

		switch ($action) {
			case 'showmap':
				if( is_array($egMultiMapsServices_showmap) === false || count($egMultiMapsServices_showmap) == 0 ) {
					throw new MWException('$egMultiMapsServices_showmap must not be an empty array');
				}
				$errormessage = '';
				$classkey = array_search(strtolower($servicename),array_map('strtolower',$egMultiMapsServices_showmap));
				if( $classkey === false ) { // a user-specified service can not be found
					$classname = $egMultiMapsServices_showmap[0];
					$errormessage = \wfMessage( 'multimaps-passed-unavailable-service', $servicename, implode(', ', $egMultiMapsServices_showmap), $classname )->escaped();
				} else {
					$classname = $egMultiMapsServices_showmap[$classkey];
				}

				$newclassname="MultiMaps\\$classname";
				if( !class_exists($newclassname) ) {
					if ( $errormessage != '' ) {
						$errormessage .= '<br />';
					}
					return $errormessage . wfMessage( 'multimaps-unknown-class-for-service', $newclassname )->escaped();
				}

				$returnservice = new $newclassname();
				if( !($returnservice instanceof \MultiMaps\BaseService) ) {
					return wfMessage( 'multimaps-error-incorrect-class-for-service', $newclassname )->escaped();
				}

				if ( $errormessage != '' ) {
					$returnservice->pushErrorMessage( $errormessage );
				}
				break;

			default:
				return wfMessage( 'multimaps-method-error-unknown-action', __METHOD__ . " ( $action )" )->escaped();
		}

		return $returnservice;
	}

}