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
 * @property float $zoom Map scale
 * @property float $minzoom Minimum scale map
 * @property float $maxzoom Maximum scale map
 * @property string $center Center of the map
 * @property string $bounds The visible bounds of the map
 */
abstract class BaseService {

	/**
	 * class name for tag "<div>" of map
	 * @var string
	 */
	protected $classname = '';

	/**
	 * Array of the defined modules that be loaded during the output
	 * @var array
	 */
	protected $resourceModules;

	/**
	 * Text for adding to the "<head>" during the output
	 * @var string
	 */
	protected $headerItem;

	/**
	 * Map property "width" used for tag "<div>"
	 * @var string
	 */
	protected $width;

	/**
	 * Map property "height" used for tag "<div>"
	 * @var string
	 */
	protected $height;

	/**
	 * An array that is used to accumulate the error messages
	 * @var array
	 */
	protected $errormessages;

	/**
	 * Array of elements map marker
	 * @var array
	 */
	protected $markers;

	/**
	 * Array of elements map line
	 * @var array
	 */
	protected $lines;

	/**
	 * Array of elements map polygon
	 * @var array
	 */
	protected $polygons;

	/**
	 * Array of elements map rectangle
	 * @var array
	 */
	protected $rectangles;

	/**
	 * Array of elements map circle
	 * @var array
	 */
	protected $circles;

	/**
	 * The boundaries of the map elements
	 * @var Bounds
	 */
	protected $elementsBounds;

	/**
	 * Array of map properties
	 * @var array
	 */
	protected $properties;

	/**
	 * Array of map elements availables for adding
	 * @var array
	 */
	protected $availableMapElements = array(
		'marker',
		'markers',
		'line',
		'lines',
		'polygon',
		'polygons',
		'rectangle',
		'rectangles',
		'circle',
		'circles',
	);

	/**
	 * Array of map properties available for definition
	 * @var array
	 */
	protected $availableMapProperties = array(
		'width',
		'height',
		'zoom',
		'minzoom',
		'maxzoom',
		'center',
		'bounds',
	);

	/**
	 * Array of map properties definition of which should not cause an error
	 * @var array
	 */
	protected $ignoreProperties = array(
		'service',
	);

	/**
	 * Constructor
	 */
	public function __construct() {
		$this->resourceModules = array(	'ext.MultiMaps' );
		$this->headerItem = '';

		$this->reset();
	}

	/**
	 * Returns html data for rendering map
	 * @return string
	 */
	public function render() {
		static $mapid = 0;

		foreach ($this->errormessages as $message) {
			\MWDebug::log($message);
		}

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
	 * Returns array of map data
	 * @param array $param Optional, if sets - parse param before returns data of map
	 * @return array
	 */
	public function getMapData( array $param = array() ) {
		if( count($param) != 0 ) {
			$this->parse ($param);
		}

		$calculatedProperties = array();

		if( is_null($this->bounds) ) {
			if( is_null($this->center) ) {
				$bounds = $this->elementsBounds;
				if ( $bounds->ne == $bounds->sw ) {
					if( is_null($this->zoom) ) {
						$calculatedProperties['zoom'] = $GLOBALS['egMultiMaps_DefaultZoom'];
					}
					$calculatedProperties['center'] = $bounds->getCenter()->getData();
				} elseif ( $bounds->isValid() ) {
					if( is_null($this->zoom) ) {
						$calculatedProperties['bounds'] = $bounds->getData();
					} else {
						$calculatedProperties['center'] = $bounds->getCenter()->getData();
					}
				}
			} else {
				// TODO
			}
		}

		$return = array();

		foreach ($this->markers as $marker) {
			$return['markers'][] = $marker->getData();
		}
		foreach ($this->lines as $line) {
			$return['lines'][] = $line->getData();
		}
		foreach ($this->polygons as $polygon) {
			$return['polygons'][] = $polygon->getData();
		}
		foreach ($this->rectangles as $rectangle) {
			$return['rectangles'][] = $rectangle->getData();
		}
		foreach ($this->circles as $circle) {
			$return['circles'][] = $circle->getData();
		}

		return array_merge($return, $calculatedProperties, $this->properties);
	}

	/**
	 * Parse params and fill map data
	 * @param array $param
	 */
	public function parse(array $param) {
		$this->reset();

		$matches = array();
		foreach ($param as $value) {
			if( preg_match('/^\s*(\w+)\s*=(.+)$/s', $value, &$matches) ) {
				if( array_search(strtolower($matches[1]), $this->availableMapElements) !== false ) {
					$this->addMapElement($matches[1], $matches[2]);
				} else {
					if( array_search(strtolower($matches[1]), $this->ignoreProperties ) !== false ) {
						$this->errormessages[] = \wfMessage( 'multimaps-unknown-parameter', $matches[1] )->escaped();
					}
				}
				continue;
			} else {
				$this->addElementMarker( $value );
			}
		}
	}

	/**
	 * Add new map element to map
	 * @param string $name
	 * @param string $value
	 * @return boolean
	 */
	public function addMapElement( $name, $value ) {
		if( trim($value == '' ) ) {
			return;
		}
		$name = strtolower( $name );

		switch ($name) {
			case 'marker':
			case 'markers':
				return $this->addElementMarker($value);
				break;
			case 'line':
			case 'lines':
				return $this->addElementLine($value);
				break;
			case 'polygon':
			case 'polygons':
				return $this->addElementPolygon($value);
				break;
			case 'rectangle':
			case 'rectangles':
				return $this->addElementRectangle($value);
				break;
			case 'circle':
			case 'circles':
				return $this->addElementCircle($value);
			default:
				break;
		}
	}

	/**
	 * Add marker to map
	 * @param string $value
	 * @return boolean
	 */
	public function addElementMarker($value) {
		$stringsmarker = explode($GLOBALS['egMultiMaps_SeparatorItems'], $value);
		foreach ($stringsmarker as $markervalue) {
			if (trim($markervalue) == '' ) {
				continue;
			}
			$marker = new \MultiMaps\Marker( $markervalue );
			if( $marker->isValid() ) {
				$this->markers[] = $marker;
				$this->elementsBounds->extend( $marker->pos );
			} else {
				$this->errormessages = array_merge( $this->errormessages, $marker->getErrorMessages() );
				return false;
			}
		}
		return true;
	}

	/**
	 * Add line to map
	 * @param string $value
	 * @return boolean
	 */
	public function addElementLine($value) {
		$stringsline = explode($GLOBALS['egMultiMaps_SeparatorItems'], $value);
		foreach ($stringsline as $linevalue) {
			if (trim($linevalue) == '' ) {
				continue;
			}
			$line = new \MultiMaps\Line( $linevalue );
			if( $line->isValid() ) {
				$this->lines[] = $line;
				$this->elementsBounds->extend( $line->pos );
			} else {
				$this->errormessages = array_merge( $this->errormessages, $line->getErrorMessages() );
				return false;
			}
		}
		return true;
	}

	/**
	 * Add polygon to map
	 * @param string $value
	 * @return boolean
	 */
	public function addElementPolygon($value) {
		$stringspolygon = explode($GLOBALS['egMultiMaps_SeparatorItems'], $value);
		foreach ($stringspolygon as $polygonvalue) {
			if (trim($polygonvalue) == '' ) {
				continue;
			}
			$polygon = new \MultiMaps\Polygon( $polygonvalue );
			if( $polygon->isValid() ) {
				$this->polygons[] = $polygon;
				$this->elementsBounds->extend( $polygon->pos );
			} else {
				$this->errormessages = array_merge( $this->errormessages, $polygon->getErrorMessages() );
				return false;
			}
		}
		return true;
	}

	/**
	 * Add rectangle to map
	 * @param string $value
	 * @return boolean
	 */
	public function addElementRectangle($value) {
		$stringsrectangle = explode($GLOBALS['egMultiMaps_SeparatorItems'], $value);
		foreach ($stringsrectangle as $rectanglevalue) {
			if (trim($rectanglevalue) == '' ) {
				continue;
			}
			$rectangle = new \MultiMaps\Rectangle( $rectanglevalue );
			if( $rectangle->isValid() ) {
				$this->rectangles[] = $rectangle;
				$this->elementsBounds->extend( $rectangle->pos );
			} else {
				$this->errormessages = array_merge( $this->errormessages, $rectangle->getErrorMessages() );
				return false;
			}
		}
		return true;
	}

	/**
	 * Add circle to map
	 * @param string $value
	 * @return boolean
	 */
	public function addElementCircle($value) {
		$stringscircle = explode($GLOBALS['egMultiMaps_SeparatorItems'], $value);
		foreach ($stringscircle as $circlevalue) {
			if (trim($circlevalue) == '' ) {
				continue;
			}
			$circle = new \MultiMaps\Circle( $circlevalue );
			if( $circle->isValid() ) {
				$this->circles[] = $circle;
				$circlescount = count($circle->pos);
				for ($index = 0; $index < $circlescount; $index++) {
					$ne = new Point($circle->pos[$index]->lat, $circle->pos[$index]->lon);
					$sw = new Point($circle->pos[$index]->lat, $circle->pos[$index]->lon);
					$ne->move($circle->radiuses[$index], $circle->radiuses[$index]);
					$sw->move(-$circle->radiuses[$index], -$circle->radiuses[$index]);
					$this->elementsBounds->extend( array($ne, $sw) );
				}
			} else {
				$this->errormessages = array_merge( $this->errormessages, $circle->getErrorMessages() );
				return false;
			}
		}
		return true;
	}

	public function __set($name, $value) {
		$name = strtolower($name);

		switch ($name) {
			case 'center':
				$center = \MultiMaps\GeoCoordinate::getLatLonFromString($value);
				if ( $center ) {
					$this->properties['center'] = $center;
				} else {
					$this->errormessages[] = \wfMessage( 'multimaps-unable-parse-parameter', $name, $value )->escaped();
				}
				break;
			case 'bounds':
				//TODO
				break;

			default:
				$this->properties[$name] = $value;
		}

	}

	public function __get($name) {
		return isset($this->properties[$name]) ? $this->properties[$name] : null;
	}

	/**
	 * Add dependencies (resourceModules, headerItem) to Parser output
	 * @param \Parser $parser
	 */
	public function addDependencies(\Parser &$parser) {
		$output = $parser->getOutput();
		foreach ($this->resourceModules as $modules) {
			$output->addModules($modules);
		}

		if($this->headerItem != '') {
			$output->addHeadItem($this->headerItem, "multimaps_{$this->classname}");
		}
	}

	/**
	 * Initializes the object again
	 */
	public function reset() {
		$this->elementsBounds = new Bounds();
		$this->width = $GLOBALS['egMultiMaps_Width'];
		$this->height = $GLOBALS['egMultiMaps_Height'];
		$this->properties = array();

		$this->markers = array();
		$this->lines = array();
		$this->polygons = array();
		$this->rectangles = array();
		$this->circles = array();

		$this->errormessages = array();
	}

}