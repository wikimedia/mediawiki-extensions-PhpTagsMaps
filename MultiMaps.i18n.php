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
 * @author Shirayuki
 * @author pastakhov
 */
$messages['qqq'] = array(
	'multimaps-desc' => '{{desc|name=MultiMaps|url=http://www.mediawiki.org/wiki/Extension:MultiMaps}}',
	'multimaps-loading-map' => 'The text is displayed instead of the map, and informs that the data needed to display the maps are not loaded yet',
	'multimaps-unable-create-element' => 'An error occurred while creating the map element. $1 - the name of the element, such as a "marker", "line", "polygon", etc.',
	'multimaps-unable-parse-coordinates' => 'Error message, $1 - geographic coordinates that cannot be parsed',
	'multimaps-unable-parse-parameter' => 'An error message is displayed when the given parameter can not be processed. Parameters:
* $1 - name of the parameter
* $2 - its value',
	'multimaps-unknown-showmap-service' => 'Error message when lack of available services for the map display (For example there are no values in the $egMultiMapsDefaultService_showmap)',
	'multimaps-unknown-class-for-service' => 'An error that occurs when the key in array $egMultiMapsServices_showmap is name of unknown class. Parameters:
* $1 - class name',
	'multimaps-error-incorrect-class-for-service' => 'An error that occurs when the key in array $egMultiMapsServices_showmap is name of class, which can not be used to display the map. Parameters:
* $1 - class name',
	'multimaps-method-error-unknown-action' => 'Error message when passed to function value that it does not expect. Parameters:
* $1 - function name and value',
	'multimaps-method-error-unexpected-result' => 'An error message informs you that the function does not perform the expected actions. Parameters:
* $1 - function name and values',
);

/** German (Deutsch)
 * @author Kghbln
 * @author Metalhead64
 */
$messages['de'] = array(
	'multimaps-desc' => 'Ermöglicht es Benutzern, Karten und Koordinatendaten mithilfe mehrerer Kartierungsdienste anzuzeigen',
	'multimaps-loading-map' => 'Lade Karte …',
	'multimaps-unable-create-element' => 'Das Kartenelement „$1“ kann nicht erstellt werden',
	'multimaps-unable-parse-coordinates' => 'Die geografischen Koordinaten „$1“ konnten nicht geparst werden',
	'multimaps-unable-parse-parameter' => 'Der Parameter „$1“ mit dem Wert „$2“ konnte nicht geparst werden',
	'multimaps-unknown-showmap-service' => 'Es konnte kein Service zum Anzeigen der Karte gefunden werden',
	'multimaps-unknown-class-for-service' => 'Die angegebene Klasse „$1“ ist für den Service unbekannt',
	'multimaps-unknown-parameter' => 'Unbekannter Parameter: „$1“',
	'multimaps-error-incorrect-class-for-service' => 'Die angegebene Klasse „$1“ ist für den Service ungültig',
	'multimaps-method-error-unknown-action' => '$1: Unbekannte Aktion',
	'multimaps-method-error-unexpected-result' => '$1: Ein unerwartetes Ergebnis einer Funktion',
);

/** French (français)
 * @author Gomoko
 */
$messages['fr'] = array(
	'multimaps-desc' => 'Permet aux utilisateurs d’afficher des cartes et des données localisées en utilisant divers services cartographiques',
	'multimaps-loading-map' => 'Chargement de la carte…',
	'multimaps-unable-create-element' => 'L’élément de carte "$1" ne peut pas être créé.',
	'multimaps-unable-parse-coordinates' => 'impossible d’analyser les coordonnées géographiques "$1"',
	'multimaps-unable-parse-parameter' => 'impossible d’analyser le paramètre "$1" dont la valeur est "$2"',
	'multimaps-unknown-showmap-service' => 'Impossible de trouver un service disponible pour afficher la carte',
	'multimaps-unknown-class-for-service' => 'Une classe est inconnue pour le service défini: "$1"',
	'multimaps-unknown-parameter' => 'Paramètre inconnu: "$1"',
	'multimaps-error-incorrect-class-for-service' => 'Une classe est incorrecte pour le service défini: "$1"',
	'multimaps-method-error-unknown-action' => '$1: Action inconnue',
	'multimaps-method-error-unexpected-result' => '$1: Un résultat inattendu d’une fonction',
);

/** Galician (galego)
 * @author Toliño
 */
$messages['gl'] = array(
	'multimaps-desc' => 'Permite aos usuarios mostrar mapas e coordenadas mediante varios servizos cartográficos',
	'multimaps-loading-map' => 'Cargando o mapa...',
	'multimaps-unable-create-element' => 'Non se pode crear o elemento de mapa "$1"',
	'multimaps-unable-parse-coordinates' => 'non se poden analizar as coordenadas xeográficas "$1"',
	'multimaps-unable-parse-parameter' => 'non se pode analizar o parámetro "$1" cuxo valor é "$2"',
	'multimaps-unknown-showmap-service' => 'Non se pode atopar ningún servizo dispoñible para mostrar o mapa',
	'multimaps-unknown-class-for-service' => 'Coñécese unha clase para o servizo definido: "$1"',
	'multimaps-unknown-parameter' => 'Parámetro descoñecido: "$1"',
	'multimaps-error-incorrect-class-for-service' => 'A seguinte clase é incorrecta para o servizo definido: "$1"',
	'multimaps-method-error-unknown-action' => '$1: Acción descoñecida',
	'multimaps-method-error-unexpected-result' => '$1: Resultado inesperado dunha función',
);

/** Japanese (日本語)
 * @author Shirayuki
 */
$messages['ja'] = array(
	'multimaps-desc' => '利用者が複数の地図サービスを使用して地図や緯度経度を表示できるようにする',
	'multimaps-loading-map' => '地図を読み込み中...',
	'multimaps-unable-create-element' => '地図要素「$1」を作成できません',
	'multimaps-unable-parse-coordinates' => '緯度経度「$1」を構文解析できません',
	'multimaps-unknown-showmap-service' => '地図の表示に利用できるサービスが見つかりませんでした',
	'multimaps-unknown-parameter' => '不明なパラメーター:「$1」',
	'multimaps-method-error-unknown-action' => '$1: 不明な操作です',
	'multimaps-method-error-unexpected-result' => '$1: 関数が予期しない結果を返しました',
);
