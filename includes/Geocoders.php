<?php
namespace MultiMaps;
/**
 *
 *
 * @file Geocoders.php
 * @ingroup MultiMaps
 * @author Pavel Astakhov <pastakhov@yandex.ru>
 * @licence GNU General Public Licence 2.0 or later
 */

class Geocoders {

	public static function getCoordinates($address, $service) {
		switch ($service) {
			case 'google':
				return self::getCoordinatesUseGoogle($address);
				break;
		}
		return false;
	}

	private static function getCoordinatesUseGoogle($address) {
		$return = false;

		$urlArgs = array(
			'sensor' => 'false',
			'address' => $address,
			);
		$response = self::performRequest( 'https://maps.googleapis.com/maps/api/geocode/json?', $urlArgs);

		if( $response !== false ) {
			$data = \FormatJson::decode( $response );
			if( is_null($data) === false ) {
				if ( $data->status == 'OK' ) {
					$geometry = $data->results[0]->geometry;
					$location = $geometry->location;
					$lat = $location->lat;
					$lon = $location->lng;
					if( !is_null($lat) && !is_null($lon) ) {
						$return = array('lat' => $lat, 'lon' => $lon );
						$bounds = $geometry->bounds;
						if( !is_null($bounds) ) {
							$bounds_ne = new Point( $bounds->northeast->lat, $bounds->northeast->lng );
							$bounds_sw = new Point( $bounds->southwest->lat, $bounds->southwest->lng );
							if( $bounds_ne->isValid() && $bounds_sw->isValid() ) {
								$b = new Bounds();
								$b->extend( array($bounds_ne, $bounds_sw) );
								$return['bounds'] = $b;
							}
						}
					}
				}
			}
		}
		return $return;
	}

	private static function performRequest($url, $urlArgs) {
		return \Http::get( $url.wfArrayToCgi($urlArgs) );
	}

}