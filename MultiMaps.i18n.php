<?php
/**
 * Internationalization file for the messages of the MultiMaps extension.
 *
 * @file MultiMaps.i18n.php
 * @ingroup MultiMaps
 * @author Pavel Astakhov <pastakhov@yandex.ru>
 */

$messages = array();

/** English
 * @author pastakhov
 */
$messages['en'] = array(
    'multimaps-desc' => 'Allows users to display maps and coordinate data using multiple mapping services',
    'multimaps-loading-map' => 'Loading map...',
    'multimaps-unable-create-element' => 'Map element "$1" can not be created',
    'multimaps-unable-parse-coordinates' => 'unable to parse the geographic coordinates "$1"',
    'multimaps-unable-parse-parameter' => 'unable to parse parameter "$1" value is "$2"',
    'multimaps-unknown-showmap-service' => 'Could not find available service to display the map',
    'multimaps-unknown-class-for-service' => 'For the service defined is unknown class: "$1"',
    'multimaps-unknown-parameter' => 'Unknown parameter: "$1"',
    'multimaps-error-incorrect-class-for-service' => 'For the service defined is incorrect class: "$1"',
    'multimaps-method-error-unknown-action' => '$1: Unknown action',
    'multimaps-method-error-unexpected-result' => '$1: An unexpected result of a function',
);

/** Message documentation (Message documentation)
 * @author pastakhov
 */
$messages['qqq'] = array(
    'multimaps-desc' => '{{desc|name=MultiMaps|url=http://www.mediawiki.org/wiki/Extension:MultiMaps}}',
    'multimaps-loading-map' => 'The text is displayed instead of the map, and informs that the data needed to display the maps are not loaded yet',
    'multimaps-unable-create-element' => 'An error occurred while creating the map element. $1 - the name of the element, such as a "marker", "line", "polygon", etc.',
    'multimaps-unable-parse-coordinates' => 'Error message, $1 - geographic coordinates that cannot be parsed',
    'multimaps-unable-parse-parameter' => 'An error message is displayed when the given parameter can not be processed. 1 $ - name of the parameter, $ 2 - its value',
    'multimaps-unknown-showmap-service' => 'Error message when lack of available services for the map display (For example there are no values in the $egMultiMapsDefaultService_showmap)',
    'multimaps-unknown-class-for-service' => 'An error that occurs when the key in array $egMultiMapsServices_showmap is name of unknown class, 1$ - class name',
    'multimaps-error-incorrect-class-for-service' => 'An error that occurs when the key in array $egMultiMapsServices_showmap is name of class, which can not be used to display the map, 1$ - class name',
    'multimaps-method-error-unknown-action' => 'Error message when passed to function value that it does not expect, 1$ - function name and value',
    'multimaps-method-error-unexpected-result' => 'An error message informs you that the function does not perform the expected actions, 1$ - function name and values',
);