<?php
namespace MultiMaps;

/**
 * Circle class for collection of map elements
 *
 * @file Circle.php
 * @ingroup Circle
 * @author Pavel Astakhov <pastakhov@yandex.ru>
 * @licence GNU General Public Licence 2.0 or later
 */
class Circle extends BaseMapElement {

	/**
	 * Array radius of circles
	 * @var array
	 */
	public $radius = array();

	protected function getElementName() {
		return 'Circle'; //TODO i18n?
	}

	protected function parseCoordinates($coordinates) {
		global $egMultiMaps_CoordinatesSeparator;

		$array = explode( $egMultiMaps_CoordinatesSeparator, $coordinates);

		if( count($array) == 2 )
		{
			$point = new Point();
			if( $point->parse($array[0]) ) {
				if(is_numeric($array[1]) ) {
					$this->pos[] = $point;
					$this->radius[] = (float)$array[1];
				} else {
					$this->errormessages[] = \wfMessage( 'multimaps-unable-parse-radius', $array[1])->escaped();
					return false;
				}
			} else {
				$this->errormessages[] = \wfMessage( 'multimaps-unable-parse-coordinates', $array[0])->escaped();
				return false;
			}
		} elseif (count($array) == 1) {
			$this->errormessages[] = \wfMessage( 'multimaps-circle-radius-not-defined', count($array) )->escaped();
			return false;
		} else {
			$this->errormessages[] = \wfMessage( 'multimaps-circle-wrong-number-parameters', count($array) )->escaped();
		}
		return true;
	}

	public function reset() {
		parent::reset();
		$this->radius = array();
	}

}