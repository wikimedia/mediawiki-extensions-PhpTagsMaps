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
	'multimaps-mapservices-must-not-empty-array' => 'Variable "$1" must not be an empty array',
	'multimaps-had-following-errors' => 'When parsing the passed parameters had the following errors:',
	'multimaps-element-illegal-value' => 'for the parameter "$1" was specified illegal value "$2". Valid values are: $3',
	'multimaps-element-more-parameters' => 'For this map element "$1" passed more parameters than expected:',
	'multimaps-element-parameters-not-processed' => 'the following parameters were not processed: $1',
	'multimaps-circle-radius-not-defined' => 'for the circle must be defined radius',
	'multimaps-circle-wrong-number-parameters' => 'for the circle should be defined only two parameters, the coordinates of the center and the radius. But specified {{PLURAL:$1|one parameter|$1 parameters}}',
	'multimaps-marker-incorrect-icon' => 'For the icon marker provided an incorrect file name "$1"',
	'multimaps-passed-unavailable-service' => 'Service name "$1" not found in the list of available services ($2). Used default service "$3"',
	'multimaps-square-wrong-number-points' => 'coordinates of the square should contain only two points, but specified {{PLURAL:$1|one point|$1 points}}',
	'multimaps-unable-create-element' => 'Map element "$1" can not be created',
	'multimaps-unable-parse-coordinates' => 'unable to parse the geographic coordinates "$1"',
	'multimaps-unable-parse-parameter' => 'unable to parse parameter "$1" value is "$2"',
	'multimaps-unable-parse-radius' => 'radius of the circle must be a numeric value, but specified "$1"',
	'multimaps-unknown-class-for-service' => 'The class "$1" that is defined for the service cannot be found.',
	'multimaps-unknown-parameter' => 'Unknown parameter: "$1"',
	'multimaps-error-incorrect-class-for-service' => 'The class "$1" that is defined for the service cannot be used.',
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
	'multimaps-mapservices-must-not-empty-array' => 'Error message, Parameters:
* $1 - variable name',
	'multimaps-had-following-errors' => 'This message goes before list of error messages',
	'multimaps-element-illegal-value' => 'Error message, Parameters:
* $1 - name of the parameter
* $2 - user-specified value
* $3 - comma separated list of valid values',
	'multimaps-element-more-parameters' => 'Error message, Parameters:
* $1 - name of map element',
	'multimaps-element-parameters-not-processed' => 'This message goes after "multimaps-element-more-parameters", Parameters:
* $1 - comma separated list of user-specified values',
	'multimaps-circle-radius-not-defined' => 'Error message, when for circle (map element) not defined radius',
	'multimaps-circle-wrong-number-parameters' => 'Error message, when for circle defined too many parameters. Parameters:
* $1 - number of passed parameters (always more than two)',
	'multimaps-marker-incorrect-icon' => 'Error message, Parameters:
* $1 - user-specified value',
	'multimaps-passed-unavailable-service' => 'Informational message warns that the specified service is not available and service is used by default. Parameters:
* $1 - user-specified service
* $2 - comma separated list of available services
* $3 - name of default service, which is currently in use',
	'multimaps-square-wrong-number-points' => 'Error message, when for square (map element) specified more or less than two parameters. Parameters:
* $1 - the number of user-specified coordinates for the square',
	'multimaps-unable-create-element' => 'An error occurred while creating the map element. $1 - the name of the element, such as a "marker", "line", "polygon", etc.',
	'multimaps-unable-parse-coordinates' => 'Error message, $1 - geographic coordinates that cannot be parsed',
	'multimaps-unable-parse-parameter' => 'An error message is displayed when the given parameter can not be processed. Parameters:
* $1 - name of the parameter
* $2 - its value',
	'multimaps-unable-parse-radius' => 'Error message, Parameters:
* $1 - user-specified value',
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
	'multimaps-had-following-errors' => 'Beim Parsen hatten die übergebenen Parameter folgende Fehler:',
	'multimaps-element-illegal-value' => 'Für den Parameter „$1“ wurde der ungültige Wert „$2“ angegeben. Gültige Werte sind: $3',
	'multimaps-element-more-parameters' => 'Für das Kartenelement „$1“ wurden mehr Parameter übergeben als erwartet:',
	'multimaps-element-parameters-not-processed' => 'Die folgenden Parameter wurden nicht verarbeitet: $1',
	'multimaps-circle-radius-not-defined' => 'Für den Kreis muss ein Radius angegeben werden.',
	'multimaps-circle-wrong-number-parameters' => 'Für den Kreis sollten nur zwei Parameter angegeben werden: Die Koordinaten des Mittelpunkts und der Radius. Du hast jedoch {{PLURAL:$1|nur einen|$1}} Parameter angegeben.',
	'multimaps-marker-incorrect-icon' => 'Für die Markierung wurde ein falscher Dateiname „$1“ angegeben',
	'multimaps-passed-unavailable-service' => 'Der Dienstname „$1“ wurde nicht in der Liste der verfügbaren Dienste gefunden ($2). Es wird der Standarddienst „$3“ verwendet.',
	'multimaps-square-wrong-number-points' => 'Die Koordinaten des Platzes sollten nur zwei Punkte enthalten. Du hast jedoch {{PLURAL:$1|einen Punkt|$1 Punkte}} angegeben.',
	'multimaps-unable-create-element' => 'Das Kartenelement „$1“ kann nicht erstellt werden',
	'multimaps-unable-parse-coordinates' => 'Die geografischen Koordinaten „$1“ konnten nicht geparst werden',
	'multimaps-unable-parse-parameter' => 'Der Parameter „$1“ mit dem Wert „$2“ konnte nicht geparst werden',
	'multimaps-unable-parse-radius' => 'Der Radius des Kreises muss ein numerischer Wert sein. Du hast jedoch „$1“ angegeben.',
	'multimaps-unknown-class-for-service' => 'Die für den Dienst angegebene Klasse „$1“ kann nicht gefunden werden.',
	'multimaps-unknown-parameter' => 'Unbekannter Parameter: „$1“',
	'multimaps-error-incorrect-class-for-service' => 'Die für den Dienst angegebene Klasse „$1“ kann nicht verwendet werden.',
	'multimaps-method-error-unknown-action' => '$1: Unbekannte Aktion',
	'multimaps-method-error-unexpected-result' => '$1: Ein unerwartetes Ergebnis einer Funktion',
);

/** French (français)
 * @author Gomoko
 */
$messages['fr'] = array(
	'multimaps-desc' => 'Permet aux utilisateurs d’afficher des cartes et des données localisées en utilisant divers services cartographiques',
	'multimaps-loading-map' => 'Chargement de la carte…',
	'multimaps-had-following-errors' => 'Les erreurs suivantes ont été détectées lors de l’analyse des paramètres passés:',
	'multimaps-element-illegal-value' => 'une valeur illégale $2" a été spécifiée pour le paramètre "$1". Les valeurs valides sont: $3',
	'multimaps-element-more-parameters' => 'Davantage de paramètres qu’attendu ont été passés pour cet élément de carte "$1":',
	'multimaps-element-parameters-not-processed' => 'les paramètres suivants n’ont pas été traités: $1',
	'multimaps-circle-radius-not-defined' => 'pour le cercle, le rayon doit être défini',
	'multimaps-circle-wrong-number-parameters' => 'pour le cercle, seuls deux paramètres devraient être définis, les coordonnées du centre et le rayon. Mais {{PLURAL:$1|un seul paramètre a été spécifié|$1 paramètres ont été spécifiés}}',
	'multimaps-marker-incorrect-icon' => 'Un nom de fichier "$1" incorrect a été fourni pour l’icône du marqueur',
	'multimaps-passed-unavailable-service' => 'Nom de service "$1" non trouvé dans la liste des services disponibles ($2). Service par défaut "$3" utilisé',
	'multimaps-square-wrong-number-points' => 'les coordonnées de la zone ne devraient contenir que deux points, mais {{PLURAL:$1|un point a été spécifié|$1 points ont été spécifiés}}',
	'multimaps-unable-create-element' => 'L’élément de carte "$1" ne peut pas être créé.',
	'multimaps-unable-parse-coordinates' => 'impossible d’analyser les coordonnées géographiques "$1"',
	'multimaps-unable-parse-parameter' => 'impossible d’analyser le paramètre "$1" dont la valeur est "$2"',
	'multimaps-unable-parse-radius' => 'le rayon du cercle doit être une valeur numérique, mais "$1" a été spécifié',
	'multimaps-unknown-class-for-service' => 'La classe "$1" définie pour le service est introuvable.',
	'multimaps-unknown-parameter' => 'Paramètre inconnu: "$1"',
	'multimaps-error-incorrect-class-for-service' => 'La classe "$1" définie pour le service ne peut pas être utilisée.',
	'multimaps-method-error-unknown-action' => '$1: Action inconnue',
	'multimaps-method-error-unexpected-result' => '$1: Un résultat inattendu d’une fonction',
);

/** Galician (galego)
 * @author Toliño
 */
$messages['gl'] = array(
	'multimaps-desc' => 'Permite aos usuarios mostrar mapas e coordenadas mediante varios servizos cartográficos',
	'multimaps-loading-map' => 'Cargando o mapa...',
	'multimaps-had-following-errors' => 'Durante o proceso de análise, os elementos analizados produciron os seguintes erros:',
	'multimaps-element-illegal-value' => 'especificouse o valor ilegal "$2" para o parámetro "$1". Os valores válidos son: $3',
	'multimaps-element-more-parameters' => 'O elemento de mapa "$1" pasou máis parámetros dos esperados:',
	'multimaps-element-parameters-not-processed' => 'non se procesaron os seguintes parámetros: $1',
	'multimaps-circle-radius-not-defined' => 'cómpre definir o radio da circunferencia',
	'multimaps-circle-wrong-number-parameters' => 'cómpre definir unicamente dous parámetros para a circunferencia, as coordenadas do centro e o radio. Pero {{PLURAL:$1|especificouse un parámetro|especificáronse $1 parámetros}}',
	'multimaps-marker-incorrect-icon' => 'Proporcionouse o nome de ficheiro incorrecto "$1" para a icona de marcador',
	'multimaps-square-wrong-number-points' => 'as coordenadas da zona deben conter unicamente dous puntos, pero {{PLURAL:$1|especificouse un punto|especificáronse $1 puntos}}',
	'multimaps-unable-create-element' => 'Non se pode crear o elemento de mapa "$1"',
	'multimaps-unable-parse-coordinates' => 'non se poden analizar as coordenadas xeográficas "$1"',
	'multimaps-unable-parse-parameter' => 'non se pode analizar o parámetro "$1" cuxo valor é "$2"',
	'multimaps-unable-parse-radius' => 'o radio da circunferencia debe ser un valor numérico, pero especificouse "$1"',
	'multimaps-unknown-class-for-service' => 'Non se pode atopar a clase "$1" definida para o servizo.',
	'multimaps-unknown-parameter' => 'Parámetro descoñecido: "$1"',
	'multimaps-error-incorrect-class-for-service' => 'Non se pode utilizar a clase "$1" definida para o servizo.',
	'multimaps-method-error-unknown-action' => '$1: Acción descoñecida',
	'multimaps-method-error-unexpected-result' => '$1: Resultado inesperado dunha función',
);

/** Japanese (日本語)
 * @author Shirayuki
 */
$messages['ja'] = array(
	'multimaps-desc' => '利用者が複数の地図サービスを使用して地図や緯度経度を表示できるようにする',
	'multimaps-loading-map' => '地図を読み込み中...',
	'multimaps-had-following-errors' => '指定したパラメーターを処理する際に以下のエラーが発生しました:',
	'multimaps-element-illegal-value' => 'パラメーター「$1」に無効な値「$2」を指定しました。有効な値: $3',
	'multimaps-element-more-parameters' => 'この地図要素「$1」に指定したパラメーターが多すぎます:', # Fuzzy
	'multimaps-element-parameters-not-processed' => '以下のパラメーターを処理できませんでした: $1',
	'multimaps-circle-radius-not-defined' => '円の半径を指定する必要があります',
	'multimaps-circle-wrong-number-parameters' => '円には、中心の緯度経度と半径の 2 個のパラメーターのみを指定できますが、{{PLURAL:$1|$1 個のパラメーター}}を指定しました。',
	'multimaps-marker-incorrect-icon' => 'アイコンマーカーとして無効なファイル名「$1」を指定しました',
	'multimaps-passed-unavailable-service' => 'サービス名「$1」は、利用できるサービス ($2) 内にありません。既定のサービス「$3」を使用します',
	'multimaps-square-wrong-number-points' => '四角形の緯度経度として 2 地点を指定すべきですが、{{PLURAL:$1|$1 地点}}を指定しました',
	'multimaps-unable-create-element' => '地図要素「$1」を作成できません',
	'multimaps-unable-parse-coordinates' => '緯度経度「$1」を構文解析できません',
	'multimaps-unable-parse-radius' => '円の半径には数値を指定する必要がありますが、「$1」を指定しました',
	'multimaps-unknown-class-for-service' => 'サービスとして定義されたクラス「$1」が見つかりません。',
	'multimaps-unknown-parameter' => '不明なパラメーター:「$1」',
	'multimaps-error-incorrect-class-for-service' => 'サービスとして定義されたクラス「$1」は使用できません。',
	'multimaps-method-error-unknown-action' => '$1: 不明な操作です',
	'multimaps-method-error-unexpected-result' => '$1: 関数が予期しない結果を返しました',
);

/** Macedonian (македонски)
 * @author Bjankuloski06
 */
$messages['mk'] = array(
	'multimaps-desc' => 'Овозможува корисниците да прикажуваат карти и координатни податоци користејќи повеќе картографски служби',
	'multimaps-loading-map' => 'Ја вчитувам картата...',
	'multimaps-had-following-errors' => 'При парсирањето, дадените параметри ги имаа следниве грешки:',
	'multimaps-element-illegal-value' => 'на параметарот „$1“ му е зададена недопуштената вредност „$2“. Допуштени се: $3',
	'multimaps-element-more-parameters' => 'За овој картографски елемент „$1“ даде повеќе параметри од очекуваното:',
	'multimaps-element-parameters-not-processed' => 'не беа обработени следниве параметри: $1',
	'multimaps-circle-radius-not-defined' => 'на кружницата мора да ѝ зададе радиус',
	'multimaps-circle-wrong-number-parameters' => 'на кружницата мора да ѝ зададат барем два параметра - координатите на центарот и радиусот. Меѓутоа, зададени се {{PLURAL:$1|зададен е $1 параметар|зададени се $1 параметри}}',
	'multimaps-marker-incorrect-icon' => 'Зададено е погрешно податотечно име „$1“ на иконата за обележување',
	'multimaps-square-wrong-number-points' => 'координатите на полето треба да содржат само две точки, но {{PLURAL:$1|укажана е само една|укажани се $1}}',
	'multimaps-unable-create-element' => 'Не можам да го создадам елементот „$1“',
	'multimaps-unable-parse-coordinates' => 'не можам да ги испарсирам географските координати „$1“',
	'multimaps-unable-parse-parameter' => 'не можам да го испарсирам параметарот „$1“. Вредноста е „$2“',
	'multimaps-unable-parse-radius' => 'радиусот на кружницата мора да има бројчена вредност, но зададено е „$1“',
	'multimaps-unknown-class-for-service' => 'Не можам да ја најдам класата „$1“ зададена на службата.',
	'multimaps-unknown-parameter' => 'Непознат параметар: „$1“',
	'multimaps-error-incorrect-class-for-service' => 'Не може да се употреби класата „$1“ зададена на службата.',
	'multimaps-method-error-unknown-action' => '$1: Непознато дејство',
	'multimaps-method-error-unexpected-result' => '$1: Неочекуван резултат на функција',
);

/** Dutch (Nederlands)
 * @author Kippenvlees1
 * @author Siebrand
 */
$messages['nl'] = array(
	'multimaps-desc' => 'Gebruikers toestaan om kaarten en coördinaten weer te geven met behulp van meerdere kaartdiensten',
	'multimaps-loading-map' => 'Bezig met het laden van de kaart...',
	'multimaps-circle-radius-not-defined' => 'voor cirkels moet een straal worden opgegeven',
	'multimaps-circle-wrong-number-parameters' => 'voor cirkels moeten twee parameters worden opgegeven; de coördinaten van het middelpunt en de straal. Hier {{PLURAL:$1|is één parameter|zijn $1 parameters}} opgegeven',
	'multimaps-marker-incorrect-icon' => 'voor de pictogrammarkering is een onjuiste bestandsnaam "$1" opgegeven',
	'multimaps-square-wrong-number-points' => 'coördinaten voor de rechthoek moeten twee punten bevatten, maar er {{PLURAL:$1|is één punt|zijn $1 punten}} opgegeven',
	'multimaps-unable-create-element' => 'Kaartelement "$1" kan niet worden aangemaakt',
	'multimaps-unable-parse-coordinates' => 'de geografische coördinaten "$1" kunnen niet verwerkt worden',
	'multimaps-unable-parse-parameter' => 'de parameter "$1" met waarde "$2" kan niet verwerkt worden',
	'multimaps-unable-parse-radius' => 'de straal van de cirkel moet een numerieke waarde zijn, maar er is "$1" opgegeven',
	'multimaps-unknown-showmap-service' => 'De dienst die de kaart weergeeft kon niet gevonden worden',
	'multimaps-unknown-class-for-service' => 'De klasse "$1" die is gedefinieerd voor de dienst bestaat niet.',
	'multimaps-unknown-parameter' => 'Onbekende parameter: "$1"',
	'multimaps-error-incorrect-class-for-service' => 'De klasse "$1" die is gedefinieerd voor de dienst kan niet gebruikt worden.',
	'multimaps-method-error-unknown-action' => '$1: onbekende handeling',
	'multimaps-method-error-unexpected-result' => '$1: een functie heeft een onverwacht resultaat teruggegeven',
);

/** Russian (русский)
 * @author Pastakhov
 */
$messages['ru'] = array(
	'multimaps-desc' => 'Позволяет пользователям отображать карты и координатные данные, используя несколько картографических сервисов',
	'multimaps-loading-map' => 'Идёт загрузка карты…',
	'multimaps-had-following-errors' => 'При обработке переданных параметров возникли следующие ошибки:',
	'multimaps-element-more-parameters' => 'Для этого элемента карты « $1 » передано больше параметров, чем ожидалось:',
	'multimaps-element-parameters-not-processed' => 'следующие параметры не были обработаны: $1',
	'multimaps-circle-radius-not-defined' => 'для окружности должен быть определен радиус',
	'multimaps-circle-wrong-number-parameters' => 'для круга должно быть определено только два параметра, координаты центра и радиус. Но {{PLURAL:$1|указан один параметр|указано $1 параметра|указано $1 параметров}}',
	'multimaps-marker-incorrect-icon' => 'Для значка маркера указано неправильное имя файла « $1 »',
	'multimaps-square-wrong-number-points' => 'координаты квадрата должны состоять только из двух точек, но {{PLURAL:$1|указана одна точка|указано $1 точки|указано $1 точек}}',
	'multimaps-unable-create-element' => 'Элемент карты « $1 » не может быть создан',
	'multimaps-unable-parse-coordinates' => 'не удается выполнить разбор географических координат « $1 »',
	'multimaps-unable-parse-parameter' => 'не удается выполнить разбор параметра « $1 » значение « $2 »',
	'multimaps-unable-parse-radius' => 'радиус круга должен быть числовым значением, но указанно « $1 »',
	'multimaps-unknown-class-for-service' => 'Класс « $1 », который определен для службы, не может быть найден.',
	'multimaps-unknown-parameter' => 'Неизвестный параметр: « $1 »',
	'multimaps-error-incorrect-class-for-service' => 'Класс « $1 », который определен для службы, не может быть использован.',
	'multimaps-method-error-unknown-action' => '$1: Неизвестное действие',
	'multimaps-method-error-unexpected-result' => '$1: Неожиданный результат функции',
);

/** Ukrainian (українська)
 * @author Base
 */
$messages['uk'] = array(
	'multimaps-desc' => 'Дозволяє користувачам відображати карти і дані координат, використовуючи декілька картографічних сервісів',
	'multimaps-loading-map' => 'Завантаження карти…',
	'multimaps-had-following-errors' => 'При обробці переданих параметрів виникли наступні помилки:',
	'multimaps-element-illegal-value' => 'для параметру «$1» було передано недопустиме значення «$2». Допустимими значеннями є: $3',
	'multimaps-element-more-parameters' => 'Для цього елементу карти «$1» передано більше параметрів, ніж очікувалось:',
	'multimaps-element-parameters-not-processed' => 'наступні параметри не було оброблено: $1',
	'multimaps-circle-radius-not-defined' => 'для кола повинен бути визначений радіус',
	'multimaps-circle-wrong-number-parameters' => 'для кола повинно бути визначено лише два параметри, координати центру та радіус. Але вказано {{PLURAL:$1|один параметр|вказано $1 параметри|вказано $1 параметрів}}',
	'multimaps-marker-incorrect-icon' => 'Для значка маркера вказано неправильну назву файлу «$1»',
	'multimaps-square-wrong-number-points' => 'коорлинати квадрату повинні складатись лише із двох точок, але {{PLURAL:$1|вказана одна точка|вказано $1 точки|вказано $1 точок}}',
	'multimaps-unable-create-element' => 'Елементи карти «$1» не може бути створено',
	'multimaps-unable-parse-coordinates' => 'не вдається обробити географічні координати «$1»',
	'multimaps-unable-parse-parameter' => 'не вдається обробити параметр «$1» значення «$2»',
	'multimaps-unable-parse-radius' => 'радіус кола повинен бути числовим значенням, але вказано «$1»',
	'multimaps-unknown-class-for-service' => 'Клас «$1» який визначено для сервісу не може бути знайдено.',
	'multimaps-unknown-parameter' => 'Невідомий параметр: «$1»',
	'multimaps-error-incorrect-class-for-service' => 'Клас «$1», що визначено для сервісу не може бути використано.',
	'multimaps-method-error-unknown-action' => '$1: Невідома дія',
	'multimaps-method-error-unexpected-result' => '$1: Невідомий результат функції',
);

/** Simplified Chinese (中文（简体）‎)
 * @author Yfdyh000
 * @author 乌拉跨氪
 */
$messages['zh-hans'] = array(
	'multimaps-desc' => '允许用户使用多个地图服务显示地图和坐标数据',
	'multimaps-loading-map' => '加载地图中……',
	'multimaps-had-following-errors' => '解析时所传递的参数有以下错误：',
	'multimaps-element-illegal-value' => '参数“$1”指定了无效的值“$2”。有效值为：$3',
	'multimaps-element-more-parameters' => '此地图元素“$1”传递了比预期更多的参数：',
	'multimaps-element-parameters-not-processed' => '未处理以下参数：$1',
	'multimaps-circle-radius-not-defined' => '圆必须定义半径。',
	'multimaps-marker-incorrect-icon' => '图标标记提供了不正确的文件名称“$1 ”',
	'multimaps-unable-create-element' => '无法创建地图元素“$1”',
	'multimaps-unable-parse-coordinates' => '无法解析地理坐标“$1”',
	'multimaps-unable-parse-parameter' => '无法解析值为$2的参数$1',
	'multimaps-unknown-parameter' => '未知参数：“$1”',
	'multimaps-method-error-unknown-action' => '$1：未知的操作',
	'multimaps-method-error-unexpected-result' => '$1：函数出现意外的结果',
);
