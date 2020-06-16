<?php
include("./config/db.php");
// if (sizeof($_GET) > 0) {
$lat = $_GET['lat'];
$lng = $_GET['lng'];
// $client = $_GET['client'];
$query = "INSERT INTO emplacement(latitude, longitude, infected_cin) VALUES('" . $lat . "', '" . $lng . "','12345678')";
$result = mysqli_query($db, $query);
echo $result;
// }
