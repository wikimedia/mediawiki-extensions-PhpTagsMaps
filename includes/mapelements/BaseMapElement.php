<?php
namespace MultiMaps;

/**
 * Base class for collection of map elements
 *
 * @file BaseService.php
 * @ingroup MultiMaps
 * @author Pavel Astakhov <pastakhov@yandex.ru>
 * @licence GNU General Public Licence 2.0 or later
 */
abstract class BaseMapElement {

    /**
     * Geographic coordinates
     * @var array
     */
    public $pos = array();

    protected $isValid = false;
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
        if( $this->parseCoordinates($arrayparam[0]) === false ) {
            $this->errormessages[] = \wfMessage( 'multimaps-unable-create-element', $this->getElementName() )->escaped();
            return false;
        }

        $this->isValid = true;
    }

    /**
     * Filling property 'pos'
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
                $this->pos[] = $point;
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
        $this->pos = array();
        $this->errormessages = array();
    }

    /**
     * Returns an error messages
     * @return array
     */
    public function getErrorMessages() {
        return $this->errormessages;
    }
}
