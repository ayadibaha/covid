<?php
session_start();
include("./config/db.php");
if ($_POST && sizeof($_POST) > 0) {
    $username = mysqli_real_escape_string($db, htmlspecialchars($_POST['email']));
    $password = mysqli_real_escape_string($db, htmlspecialchars($_POST['pass']));
    $requete = "SELECT count(*) FROM administrator where `username` = '" . $username . "' and `password` = '" . $password . "' ";
    $exec_requete = mysqli_query($db, $requete);
    $reponse      = mysqli_fetch_array($exec_requete);
    $count = $reponse['count(*)'];
    if ($count != 0) // nom d'utilisateur et mot de passe correctes
    {
        $_SESSION['username'] = $username;
        header('Location: index.php');
    } else {
        header('Location: login.php?erreur=1'); // utilisateur ou mot de passe incorrect
    }
} else {
    header("Location: login.php");
}
