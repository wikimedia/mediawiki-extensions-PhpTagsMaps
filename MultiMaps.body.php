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

        return $service->render($params);
    }

    public static function getResourceModules() {
        global $egMultiMapsServices_showmap;

        $resource = array(
            'ext.MultiMaps' => array(
                'styles' => array('resources/multimaps.css'),
                'localBasePath' => __DIR__,
                'remoteExtPath' => 'MultiMaps',
                'group' => 'ext.MultiMaps',
                ),
            );

        foreach ($egMultiMapsServices_showmap as $key => $value) {
            $service = "\\MultiMaps\\$key";
            $serviceReflection = new ReflectionClass( $service );
            if( $serviceReflection->isSubclassOf('\MultiMaps\BaseService') ) {
                $resource = array_merge( $resource, (array)$service::getResourceModules() );
            } else {
                throw new MWException( "\$egMultiMapsServices_showmap must contains only \MultiMaps\BaseService classes, but '$service' is not such");
            }
        }

        return $resource;
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