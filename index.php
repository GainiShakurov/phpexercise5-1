<?php

require_once 'vendor/autoload.php';

$api = new \Yandex\Geo\Api();

// Можно искать по точке
//$api->setPoint(30.5166187, 50.4452705);

// Или можно икать по адресу
if (!empty($_GET['searchText'])) {


    $api->setQuery($_GET['searchText']);

// Настройка фильтров
    $api
        ->setLang(\Yandex\Geo\Api::LANG_RU)// локаль ответа
        ->load();

    $response = $api->getResponse();
    $response->getFoundCount(); // кол-во найденных адресов
    $response->getQuery(); // исходный запрос
    $response->getLatitude(); // широта для исходного запроса
    $response->getLongitude(); // долгота для исходного запроса

    echo '<h4>'.$_GET['searchText'].'</h4>';

// Список найденных точек
    $collection = $response->getList();
    foreach ($collection as $item) {
        echo '<b>' . $item->getAddress() . '</b><br />'; // вернет адрес
        echo 'Широта - '. $item->getLatitude() . '<br />'; // широта
        echo 'Долгота - '. $item->getLongitude() . '<br />'; // долгота
    }
}
?>

<form action="" method="GET">
    Найти:
    <p>
        <input type="text" name="searchText" value="" placeholder="Адрес">
    </p>
    <p><input type="submit" value="Найти"/></p>
</form>
