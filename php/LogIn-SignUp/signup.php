<?php
require "../ConnectionConfig/DataBase.php";
require "../Mail/SendMail.php";

$comfirmMail = new ComfirmationMailing();
$comfirmMail->SetServer();

$db = new DataBase();
if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['position']) && !empty($_POST['email']) && !empty($_POST['fullname']) && !empty($_POST['field1']) && !empty($_POST['field2'])) {
    if($_POST['position'] == 'doctor') {
        $field = $_POST['field2'];
    } else {
        $field = $_POST['field1'];
    }
    if ($db->dbConnect()) {
        if ($db->signUp("account",  $_POST['username'], $_POST['password'], $_POST['position'], $_POST['email'], $_POST['fullname'], $field)
        && $comfirmMail->SendTo($_POST['email'], $_POST['fullname'], $db->getToken("account", $_POST['username']))) {
            echo "Account saved. Confirmation sent!";
        } else {
            echo "Sign up Failed";
        }
        $db->close();
    } else {
        echo "Error: Database connection";
    }
} else {
    echo "All fields are required";
};
header( "refresh:1;url=/Web_HospitalManagement/Manager/accountManager.php" );
exit;
?>