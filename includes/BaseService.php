<?php
namespace MultiMaps;

/**
 * Base class for collection of services
 *
 * @file BaseService.php
 * @ingroup MultiMaps
 * @author Pavel Astakhov <pastakhov@yandex.ru>
 * @licence GNU General Public Licence 2.0 or later
 *
 * @property array $markers Markers on the map
 * @property float $zoom Map scale
 * @property float $minzoom Minimum scale map
 * @property float $maxzoom Maximum scale map
 * @property string $center Center of the map
 * @property string $bounds The visible bounds of the map
 */
abstract class BaseService {

    /**
     * class name for tag div of map
     * @var string
     */
    protected $classname = '';
    protected $resourceModules = array('ext.MultiMaps');
    protected $width;
    protected $height;
    protected $errormessages = array();

    /**
     * The boundaries of the map elements
     * @var \MultiMaps\Bounds
     */
    protected $elementsBounds;

    /**
     * TODO desc
     * @var array
     */
    private $mapdata = array();

    protected $availableProperties = array(
        'width',
        'height',
        'zoom',
        'minzoom',
        'maxzoom',
        'center',
        'bounds',
        'marker',
        'markers',
    );

    protected $ignoreProperties = array(
        'service',
    );

    /**
     * Constructor
     */
    public function __construct() {
        $this->elementsBounds = new \MultiMaps\Bounds();
        $this->width = $GLOBALS['egMultiMaps_Width'];
        $this->height = $GLOBALS['egMultiMaps_Height'];
    }

    /**
     *
     * @global OutputPage $wgOut
     * @param array $param
     * @return string
     */
    public function render($param) {
        global $wgOut;

        foreach ($this->resourceModules as $resmod) {
            $wgOut->addModules( $resmod );
        }

        static $mapid = 0;

        $this->parse($param);

        return \Html::rawElement(
                'div',
                array(
                    'id' => 'multimaps_map' . $mapid++,
                    'style' => 'width:'.htmlspecialchars($this->width).'; height:'.htmlspecialchars($this->height).';',
                    'class' => 'multimaps-map' . ($this->classname != '' ? " multimaps-map-$this->classname" : ''),
                    ),
                \wfMessage( 'multimaps-loading-map' )->escaped() .
                \Html::element(
                        'div',
                        array( 'class' => 'multimaps-mapdata' ),
                        \FormatJson::encode( $this->getMapData() )
                        )
                );
    }

    /**
     * TODO desc
     * @param array $param Optional, if sets - parse param before returns data of map
     * @return
     */
    public function getMapData( array $param = array() ) {
        if( count($param) != 0 ) {
            $this->parse ($param);
        }

        if( is_null($this->bounds) ) {
            if( is_null($this->center) ) {
                $bounds = $this->elementsBounds;
                if ( $bounds->ne == $bounds->sw ) {
                    if( is_null($this->zoom) ) {
                        $this->mapdata['zoom'] = $GLOBALS['egMultiMaps_DefaultZoom'];
                    }
                    $this->mapdata['center'] = $bounds->getCenter();
                } elseif ( $bounds->isValid() ) {
                    if( is_null($this->zoom) ) {
                        $this->mapdata['bounds'] = $bounds;
                    } else {
                        $this->mapdata['center'] = $bounds->getCenter();
                    }
                }
            } else {
                //TODO
            }
        }
        return $this->mapdata; //TODO
    }


    public function parse(array $param) {
        $this->mapdata = array();

        $matches = array();
        foreach ($param as $value) {
            if( preg_match('/^\s*(\w+)\s*=(.+)$/', $value, &$matches) ) {
                if( array_search(strtolower($matches[1]), $this->availableProperties) !== false ) {
                    $propertyname = $matches[1];
                    $this->$propertyname = $matches[2];
                } else {
                    if( array_search(strtolower($matches[1]), $this->ignoreProperties ) !== false ) {
                        $this->errormessages[] = \wfMessage( 'multimaps-unknown-parameter', $matches[1] )->escaped();
                    }
                }
                continue;
            } else {
                $this->markers = $value;
            }
        }
    }

    public function __set($name, $value) {
        switch ($name) {
            case 'marker':
            case 'markers':
                // The card may not contain markers,
                // but because the first parameter is required,
                // this can be an empty string, it is normal
                if( trim($value == '' ) ) {
                    break;
                }
                $stringsmarker = explode($GLOBALS['egMultiMaps_SeparatorItems'], $value);
                foreach ($stringsmarker as $markervalue) {
                    if (trim($markervalue) == '' ) {
                        continue;
                    }
                    $marker = new \MultiMaps\Marker( $markervalue );
                    if( $marker->isValid() ) {
                        $this->mapdata['markers'][] = $marker;
                        $this->elementsBounds->extend( $marker->pos );
                    } else {
                        $this->errormessages = array_merge( $this->errormessages, $marker->getErrorMessages() );
                    }
                }
                break;
            case 'center':
                $center = \MultiMaps\GeoCoordinate::getLatLonFromString($value);
                if ( $center ) {
                    $this->mapdata['center'] = $center;
                } else {
                    $this->errormessages[] = \wfMessage( 'multimaps-unable-parse-parameter', $name, $value )->escaped();
                }
                break;
            case 'bounds':
                //TODO
                break;

            default:
                $this->mapdata[$name] = $value;
        }

    }

    public function __get($name) {
        return isset($this->mapdata[$name]) ? $this->mapdata[$name] : null;
    }

    /**
     * Retun array of all extra defined modules that can later be loaded during the output
     * @link http://www.mediawiki.org/wiki/Manual:$wgResourceModules $wgResourceModules
     * @return array
     */
    public abstract function getResourceModules();

}