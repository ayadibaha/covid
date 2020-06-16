<?php
include("./config/db.php");
if (sizeof($_GET) > 0) {
    $lat = $_GET['lat'];
    $lng = $_GET['lng'];
    $client = $_GET['client'];
    $query = "INSERT INTO emplacement(latitude, longitude, infected_id VALUES('" . $lat . "', '" . $lng . "','12345678')";
    $result = $db->query($query);
    echo $result;
}
