<?php
include("./config/db.php");
$query = "UPDATE `notification` SET `treated` = '1'";
$db->query($query);
