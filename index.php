<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Яндекс Геолокация</title>
</head>
<body>

<form action="" method="GET">
    Найти:
    <p>
        <input type="text" name="searchText" value="" placeholder="Адрес">
    </p>
    <p><input type="submit" value="Найти"/></p>
</form>

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
        echo '<b>' . $item->getAddress() . '</b><br />'; // вернет адрес
        echo 'Широта - ' . $item->getLatitude() . '<br />'; // широта
        echo 'Долгота - ' . $item->getLongitude() . '<br />'; // долгота
    }
}
?>

</body>
</html>