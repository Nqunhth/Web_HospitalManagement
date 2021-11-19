<?php
require "../ConnectionConfig/DataBase.php";

$db = new DataBase();
if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['position']) && !empty($_POST['email'])) {
    if ($db->dbConnect()) {
        // $account = new Account();
        if ($db->signUp("account",  $_POST['username'], $_POST['password'], $_POST['position'], $_POST['email'])) {
            echo "Sign Up Success";
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
header( "refresh:1;url=/Web_HospitalManagement/Manager/accountManager.html" );
exit;
?>
