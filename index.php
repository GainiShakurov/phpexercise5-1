<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Яндекс Геолокация</title>
    <script src="https://api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript">
    </script>
    <script type="text/javascript">
        ymaps.ready(init);
        var myMap;

        function init() {
            myMap = new ymaps.Map("map", {
                center: [55.76, 37.64],
                zoom: 7
            });
        }

        function makePoint(Latitude, Longitude) {

            myMap.panTo([Latitude, Longitude]);

            var myPlacemark = new ymaps.Placemark([Latitude, Longitude], {
                hintContent: 'Точка'
            }, {});

            myMap.geoObjects
                .add(myPlacemark)
        }



    </script>
</head>
<body>

<form action="" method="GET">
    Найти:
    <p>
        <input type="text" name="searchText" value="" placeholder="Адрес">
    </p>
    <p><input type="submit" value="Найти"/></p>
</form>

<div id="map" style="width: 600px; height: 400px"></div>

<?php

require_once 'vendor/autoload.php';

$api = new \Yandex\Geo\Api();

if (!empty($_GET['searchText'])) {
    $api->setQuery($_GET['searchText']);

// Настройка фильтров
    $api
        ->setLang(\Yandex\Geo\Api::LANG_RU)// локаль ответа
        ->load();

    $response = $api->getResponse();

    echo '<h4>' . $_GET['searchText'] . '</h4>';

// Список найденных точек
    $collection = $response->getList();
    foreach ($collection as $item) {
        echo '<a href="" onclick="makePoint(' . $item->getLatitude() . ', '. $item->getLongitude() . '); return false;" >' . $item->getAddress() . '</a><br />'; // вернет адрес
        echo 'Широта - ' . $item->getLatitude() . '<br />'; // широта
        echo 'Долгота - ' . $item->getLongitude() . '<br />'; // долгота
    }
}
?>

</body>
</html>