<?php
$action = $_POST['action'];
include './class/sqlOh.php';
$sqlOurhome = new sqlOh("localhost", "root", "", "ourhome");




if ($action == "getrooms") {
    $date = $_POST['date'];
    $rooms = $sqlOurhome->getrooms($date);
    foreach ($room as $rooms) {
        echo '<span>' . $room['data'] . '</span>';
    }

}


?>