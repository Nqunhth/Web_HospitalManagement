<?php
require "../ConnectionConfig/DataBase.php";
$db = new DataBase();
if (!empty($_POST['username']) && !empty($_POST['password'])) {
    if ($db->dbConnect()) {
        $login = $db->logIn("account", $_POST['username'], $_POST['password']);
        if ($login == 1) {
            echo "Login Success";
        };
        if($login == 0){
            echo "Username or Password wrong";
        };
        if($login == 2){
            echo "This account is yet activated or being disabled";
        };
        if($login == 3){
            echo "Username or Password wrong";
        }
    } else echo "Error: Database connection";
} else echo "All fields are required";
?>
