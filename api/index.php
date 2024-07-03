<?php
$origin = '*';
//http://aaaaaaaaaaaaaaa.ru
header('Access-Control-Allow-Origin: ' . $origin . '');
$action = $_POST['action'];
include './class/sqlOh.php';
$sqlOurhome = new sqlOh("localhost", "root", "", "ourhome");


if ($action == "getrooms") {
    $date = $_POST['date'];
    $rooms = $sqlOurhome->getrooms($date);

    echo '<div id="back" class="btn btn-primary">Вернуться к выбору даты.</div>';
    echo '<div>' . $date . ' </div>';
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
    echo '<div id="date" data-date="' . $date . '"></div>';
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
        echo '<button id="new-order"  data-id="' . $elements['id'] . '" class="btn btn-primary" >Арендовать</button>';

        echo '</div>';
        echo '</div>';
    }
}

if ($action == "application") {
    $room_id = $_POST['room_id'];
    $date = $_POST['date'];
    $room = $sqlOurhome->getroom($room_id);

    foreach ($room as $elements) {
        echo '<div class="white-popup">';
        echo '<div class="mfp-close white-popup__close">X</div>';
        echo '<div class="white-popup__block application">';
        echo '<span>Заказ на ' . $date . '</span>';
        echo '<span>Комната: ' . $elements['name'] . '</span>';
        echo '<span>Цена за ночь: ' . $elements['price'] . '</span>';
        echo '<input type="text" id="name" placeholder="Ведите ваше имя">';
        echo '<input type="number" id="number" placeholder="Количество людей">';
        echo '<input type="email" id="email" placeholder="Email">';
        echo '<input type="number" id="tel" placeholder="Номер телефона">';
        echo '<textarea id="coment" placeholder="Коментарий" name="story" rows="5" ></textarea>';
        echo '<button id="do_application" class="btn btn-primary" data-id="' . $elements['id'] . '" >Сделать заказ</button>';
        echo '</div>';
        echo '</div>';
    }
}

if ($action == "placeOrder") {
    $room_id = $_POST['room_id'];
    $date = $_POST['date'];
    $name = $_POST['name'];
    $number = $_POST['number'];
    $email = $_POST['email'];
    $tel = $_POST['tel'];
    $coment = $_POST['coment'];

    $room = $sqlOurhome->placeOrder($room_id, $date, $name, $number, $email, $tel, $coment);
    echo $room;
    if($room==true){
        echo '<div class="white-popup">';
        echo '<div class="mfp-close white-popup__close">X</div>';
        echo '<div class="white-popup__block application">';
        echo '<span>Ваш заказ оформлен</span>';
        echo '</div>';
        echo '</div>';

        $massage = "Ваш заказ принят. Дата $date";
        $to = $email;
        $from = "ourhome@aaaaaaaaaaaaaaa.ru";
        $subject = "Заказ на Our Home";

        $subject = "=?utf-8?B?".base64_encode($subject)."?=";
        $headers = "From: $from\r\nReply-to: $from\r\nContent-type:text/plain; charset=utf-8\r\n";
        mail($to, $subject, $massage, $headers);

    }
    else {
        echo '<div class="white-popup">';
        echo '<div class="mfp-close white-popup__close">X</div>';
        echo '<div class="white-popup__block application">';
        echo '<span>Не удалось сделать Заказ 😥</span>';
        echo '</div>';
        echo '</div>';
    }
}


?>