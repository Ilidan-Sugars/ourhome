<?php
$action = $_POST['action'];
include './class/sqlOh.php';
$sqlOurhome = new sqlOh("localhost", "root", "", "ourhome");




if ($action == "getrooms") {
    $date = $_POST['date'];
    $rooms = $sqlOurhome->getrooms($date);
    foreach ($room as $rooms) {
        echo '<span>' . $room['data'] . '</span>';
        echo '<div class="col-4">';
        echo '<div class="card shadow-sm">';
        echo   '<svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>';
        echo   '<div class="card-body">';
        echo    '<p class="card-text"> Комната ' . $room['name'] . '. ' . $room['description'] . '</p>';
        echo    '<div class="d-flex justify-content-between align-items-center">';
        echo       '<div class="btn-group">';
        echo         '<button type="button" class="btn btn-sm btn-outline-secondary">Подробнее</button>';
        echo         '<button type="button" class="btn btn-sm btn-outline-secondary">Написать </button>';
        echo       '</div>';
        echo    '<small class="text-muted">9 mins</small>';
        echo '</div></div></div></div>';
    }

}


?>