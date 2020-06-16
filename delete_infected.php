<?php
include("./config/db.php");
if (sizeof($_POST) > 0) {
    $query = "DELETE FROM infected WHERE CIN = " . $_POST['cin'];
    $result = mysqli_query($db, $query);
    return $result;
}
