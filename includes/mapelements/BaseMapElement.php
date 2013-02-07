<?php
namespace MultiMaps;

/**
 * Base class for collection of map elements
 *
 * @file BaseService.php
 * @ingroup MultiMaps
 * @author Pavel Astakhov <pastakhov@yandex.ru>
 * @licence GNU General Public Licence 2.0 or later
 * @property-read float $pos Geographic coordinates
 */
abstract class BaseMapElement {

	/**
	 * Geographic coordinates
	 * @var array
	 */
	protected $coordinates = array();

	/**
	 * @todo Description
	 * @var boolean
	 */
	protected $isValid = false;

	/**
	 * An array that is used to accumulate the error messages
	 * @var array
	 */
	protected $errormessages = array();

	/**
	 * Returns element name
	 * return string Element name
	 */
	protected abstract function getElementName();

	/**
	 * Constructor
	 * @param string $string Parse this string if sets
	 */
	function __construct( $string = null ) {
		if( is_string($string) ) {
			$this->parse( $string );
		}
	}

	public function __get($name) {
		switch ($name) {
			case 'pos':
				return $this->coordinates;
				break;
			default:
				break;
		}
	}

		/**
	 * Filling properties of the object according to the obtained data
	 * @global string $egMultiMaps_DelimiterParam
	 * @param string $param
	 * @return boolean
	 */
	public function parse( $param ) {
		global $egMultiMaps_DelimiterParam;
		$this->reset();

		$arrayparam = explode( $egMultiMaps_DelimiterParam, $param );

		//The first parameter should always be coordinates
		$coordinates = array_shift($arrayparam);
		if( $this->parseCoordinates($coordinates) === false ) {
			$this->errormessages[] = \wfMessage( 'multimaps-unable-create-element', $this->getElementName() )->escaped();
			return false;
		}

		$this->isValid = true;
	}

	/**
	 * Filling property 'coordinates'
	 * @global string $egMultiMaps_CoordinatesSeparator
	 * @param string $coordinates
	 * @return boolean
	 */
	protected function parseCoordinates( $coordinates ) {
		global $egMultiMaps_CoordinatesSeparator;

		$array = explode( $egMultiMaps_CoordinatesSeparator, $coordinates);
		foreach ($array as $value) {
			$point = new Point();
			if( $point->parse($value) ) {
				$this->coordinates[] = $point;
			} else {
				$this->errormessages[] = \wfMessage( 'multimaps-unable-parse-coordinates', $value)->escaped();
				return false;
			}
		}
		return true;
	}

	/**
	 * Checks if the object is valid
	 * @return boolean
	 */
	public function isValid() {
		return $this->isValid;
	}

	/**
	 * Initializes the object again, and makes it invalid
	 */
	public function reset() {
		$this->isValid = false;
		$this->coordinates = array();
		$this->errormessages = array();
	}

	/**
	 * Returns an error messages
	 * @return array
	 */
	public function getErrorMessages() {
		return $this->errormessages;
	}

	/**
	 * Returns an array of data
	 * @return array
	 */
	public function getData() {
		if( $this->isValid() ) {
			$ret = array();
			foreach ($this->coordinates as $pos) {
				$ret['pos'][] = $pos->getData();
			}
			return $ret;
		}
	}
}
