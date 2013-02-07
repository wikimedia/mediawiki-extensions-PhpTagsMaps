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
 * @property string $title Title of element
 * @property string $text Popup text of element
 */
abstract class BaseMapElement {

	/**
	 * Geographic coordinates
	 * @var array
	 */
	protected $coordinates;

	/**
	 * @todo Description
	 * @var boolean
	 */
	protected $isValid;

	/**
	 * An array that is used to accumulate the error messages
	 * @var array
	 */
	protected $errormessages;

	/**
	 * Array of properties available for this element
	 * @var array
	 */
	protected $availableProperties;

	/**
	 * Array of element properties
	 * @var array
	 */
	protected $properties;

	/**
	 * Returns element name
	 * return string Element name
	 */
	protected abstract function getElementName();

	/**
	 * Constructor
	 * @param string $string Parse this string if sets
	 */
	function __construct( ) {
		$this->availableProperties = array(
			'title',
			'text',
		);

		$this->reset();
	}

	public function __set($name, $value) {
		$name = strtolower($name);

		$this->properties[$name] = $value;
	}

	public function __get($name) {
		$name = strtolower($name);

		switch ($name) {
			case 'pos':
				return $this->coordinates;
				break;
			default:
				if ( isset($this->properties[$name]) ) {
					return $this->properties[$name];
				}
				break;
		}
	}

	/**
	 * Filling properties of the object according to the obtained data
	 * @global string $egMultiMaps_DelimiterParam
	 * @param string $param
	 * @return boolean returns false if there were errors during parsing, it does not mean that the item was not added. Check with isValid()
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

		//These parameters are optional
		$this->isValid = true;
		return $this->parseProperties($arrayparam);
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

	protected function parseProperties(array $param) {
		// filling properties with the names
		$matches = array();
		$properties = implode('|', $this->availableProperties );
		foreach ($param as $value) {
			if( preg_match("/^\s*($properties)\s*=(.+)$/si", $value, &$matches) ) {
				$propertyName = $matches[1];
				$this->$propertyName = $matches[2];
			}
		}
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
		$this->properties = array();
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
			return array_merge($ret, $this->properties);
		}
	}
}
