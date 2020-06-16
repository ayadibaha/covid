<?php
include("./config/db.php");

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'config/PHPMailer/src/Exception.php';
require 'config/PHPMailer/src/PHPMailer.php';
require 'config/PHPMailer/src/SMTP.php';

if (sizeof($_POST) > 0) {
    $cin = $_POST['cin'];
    $emplacement = $_POST['emplacement_id'];
    $query_verif = "SELECT * FROM notification WHERE infected_cin = '" . $cin . "' and emplacement_id = '" . $emplacement . "'";
    $result = $db->query($query_verif);
    $row = mysqli_num_rows($result);
    if ($row == 0) {
        $query = "INSERT INTO notification VALUES(null, '" . $cin . "', '" . $emplacement . "',0)";
        if ($db->query($query) === TRUE) {
            try {
                $mail = new PHPMailer(true);
                $mail->IsSMTP();
                $mail->SMTPDebug = 0;
                $mail->SMTPAuth = TRUE;
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port     = 587;
                $mail->Username = "bahaeddine.ayadi@esprit.tn";
                $mail->Password = "183JMT0639";
                $mail->Host     = "smtp.gmail.com";
                $mail->Mailer   = "smtp";
                $mail->SetFrom("bahaeddine.ayadi@esprit.tn", "Admin Covid19");
                $mail->AddAddress("ayadibaha51@gmail.com");
                $mail->Subject = "Test email using PHP mailer";
                $mail->WordWrap   = 80;
                $content = "<span style='color:red;'>" . $cin . " a dépassé sa zone!</span>";
                $mail->Body = $content;
                $mail->IsHTML(true);
                $mail->send();
            } catch (Exception $e) {
                echo 'Caught exception: ',  $e->getMessage(), "\n";
            }
        }
    }
}
