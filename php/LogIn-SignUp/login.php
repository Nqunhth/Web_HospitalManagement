<?php
require "../ConnectionConfig/DataBase.php";
$db = new DataBase();
if (!empty($_POST['username']) && !empty($_POST['password'])) {
    if ($db->dbConnect()) {
        if ($db->logIn("account", $_POST['username'], $_POST['password'])) {
            echo "Login Success";
            $db->close();
            header( "refresh:1;url=/Web_HospitalManagement" );
            exit;
        } else echo "Username or Password wrong";
    } else echo "Error: Database connection";
} else echo "All fields are required";
header( "refresh:1;url=/Web_HospitalManagement/Login/loginPage.html" );
exit;
?>
