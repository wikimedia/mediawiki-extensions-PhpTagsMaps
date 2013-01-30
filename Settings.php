<?php
/**
 * File defining the settings for the MultiMaps extension.
 * More info can be found at https://www.mediawiki.org/wiki/Extension:MultiMaps/Configuration
 *
 *                          NOTICE:
 * Changing one of these settings can be done by copieng or cutting it,
 * and placing it in LocalSettings.php, AFTER the inclusion of MultiMaps.
 *
 * @file Settings.php
 * @ingroup MultiMaps
 * @author Pavel Astakhov <pastakhov@yandex.ru>
 */

// Check to see if we are being called as an extension or directly
if ( !defined( 'MEDIAWIKI' ) ) {
    die( 'This file is an extension to MediaWiki and thus not a valid entry point.' );
}

// Default settings
$egMultiMapsServices_showmap = array(
        "Leaflet" => "leaflet",
        //'googlemaps',
        //'yandexmaps',
);

// String or array of string. The default mapping service for each feature,
// which will be used when no valid service is provided by the user.
// Each service needs to be enabled, if not, the first one from the available
// services will be taken.
$egMultiMapsDefaultService_showmap = array('leaflet');

// Integer. The default zoom of a map. This value will only be used when the
// user does not provide one.
$egMultiMaps_DefaultZoom = 14;

// TODO description
$egMultiMaps_SeparatorItems = ';';
$egMultiMaps_DelimiterParam = '~';
$egMultiMaps_OptionsSeparator = ',';
$egMultiMaps_CoordinatesSeparator = ':';

// Integer or string. The default width and height of a map. These values will
// only be used when the user does not provide them.
$egMultiMaps_Width = 'auto';
$egMultiMaps_Height = '350px';