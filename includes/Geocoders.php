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
			case 'yandex':
				return self::getCoordinatesUseYandex($address);
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
								$b = new Bounds( array($bounds_ne, $bounds_sw) );
								$return['bounds'] = $b;
							}
						}
					}
				}
			}
		}
		return $return;
	}

	private static function getCoordinatesUseYandex($address) {
		$return = false;

		$urlArgs = array(
			'format' => 'json',
			'results' => '1',
			'geocode' => $address,
			);
		$response = self::performRequest( 'https://geocode-maps.yandex.ru/1.x/?', $urlArgs);

		if( $response !== false ) {
			$data = \FormatJson::decode( $response );
			if( is_null($data) === false ) {
				$geoObjectCollection = $data->response->GeoObjectCollection;
				if ( $geoObjectCollection->metaDataProperty->GeocoderResponseMetaData->found > 0 ) {
					$geoObject = $geoObjectCollection->featureMember[0]->GeoObject;
					list($lon, $lat) = explode(' ', $geoObject->Point->pos);
					$point = new Point($lat, $lon);
					if( $point->isValid() ) {
						$return = $point->pos;
						$envelope = $geoObject->boundedBy->Envelope;
						if( !is_null($envelope) ) {
							list($lon, $lat) = explode(' ', $envelope->upperCorner);
							$bounds_ne = new Point($lat, $lon);
							list($lon, $lat) = explode(' ', $envelope->lowerCorner);
							$bounds_sw = new Point($lat, $lon);
							if( $bounds_ne->isValid() && $bounds_sw->isValid() ) {
								$b = new Bounds( array($bounds_ne, $bounds_sw) );
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