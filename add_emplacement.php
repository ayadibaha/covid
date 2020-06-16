<?php
include("./config/db.php");
if (sizeof($_POST) > 0) {
    $lat = $_POST['lat'];
    $lng = $_POST['lng'];
    $client = $_POST['client'];
    $query = "INSERT INTO emplacement(latitude, longitude, infected_id VALUES('" . $lat . "', '" . $lng . "','12345678')";
    $db->query($query);
}
