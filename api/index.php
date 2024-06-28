<?php
$origin = 'http://aaaaaaaaaaaaaaa.ru';
header('Access-Control-Allow-Origin: '.$origin.'');
$action = $_POST['action'];
include './class/sqlOh.php';
$sqlOurhome = new sqlOh("localhost", "root", "", "ourhome");


if ($action == "getrooms") {
    $date = $_POST['date'];
    $rooms = $sqlOurhome->getrooms($date);

    echo '<div id="back" class="btn btn-primary">Вернуться к выбору даты.</div>';
    echo '<div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">';
    foreach ($rooms as $room) {
        echo '<div class="col-sm-12 col-md-6 col-lg-4">';
        echo '<div class="card shadow-sm">';
        echo '<img class="bd-placeholder-img card-img-top" width="100%" height="225" src="' . $room['url_img'] . '"</img>';
        echo '<div class="card-body">';
        echo '<p class="card-text">' . $room['name'] . ' - ' . $room['id'] . '</p>';
        echo '<div class="d-flex justify-content-between align-items-center">';
        echo '<div class="btn-group">';
        echo '<button href="#popup" class="btn btn-sm btn-outline-secondary more-popup-link"  data-id="' . $room['id'] . '">Подробнее</button>';
        echo '<button type="button" class="btn btn-sm btn-outline-secondary">Написать </button>';
        echo '</div>';
        echo '<small class="text-muted">Ночь: ' . $room['price'] . '</small>';
        echo '</div></div></div></div>';
    }
    echo '</div>';
}

if ($action == "getroom") {
    $room_id = $_POST['room_id'];
    $room = $sqlOurhome->getroom($room_id);

    foreach ($room as $elements) {
        echo '<div class="white-popup">';
        echo '<div class="mfp-close white-popup__close">X</div>';
        echo '<img src="' . $elements['url_img'] . '" alt="">';
        echo '<div class="white-popup__block">';
        echo '<span>' . $elements['name'] . '</span>';
        echo '<span>' . $elements['description'] . '</span>';
        echo '<span>Цена за ночь: ' . $elements['price'] . '</span>';
        echo '<button class="btn btn-primary">Арендовать</button>';

        echo '</div>';
        echo '</div>';
    }
}

?>