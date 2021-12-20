<?php
require "../ConnectionConfig/DataBase.php";
require "../Mail/SendMail.php";
require '../lib/PHPMailer/src/Exception.php';
require '../lib/PHPMailer/src/PHPMailer.php';
require '../lib/PHPMailer/src/SMTP.php';

$db = new DataBase();
$forgetMail = new ComfirmationMailing();

if (!empty($_POST['email'])) {
    if ($db->dbConnect()) {
        if ($db->generateTokenForRecovery("account", $_POST['email'])
        && $forgetMail->sendPasswordRecovery($_POST['email'], $db->getTokenByEmail("account", $_POST['email']))) {
            echo "Password recovery link sent! Please check your email";
            header('location: /Web_HospitalManagement/Login/loginPage.php');
        } else echo "Request Denied";
    } else echo "Error: Database connection";
} else echo "All fields are required";

?>