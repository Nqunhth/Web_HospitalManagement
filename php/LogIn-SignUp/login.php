<?php
require "../ConnectionConfig/DataBase.php";
require "../UserClass/User.php";

session_start();


$db = new DataBase();
if (!empty($_POST['username']) && !empty($_POST['password'])) {
    if ($db->dbConnect()) {
        $login = $db->logIn("account", $_POST['username'], $_POST['password']);
        if ($login == 1) {
            // echo "Login Success";
            $curr = User::fetchUserByUsername($_POST['username']);
            if ($curr->num_rows > 0)
                $curr = $curr->fetch_assoc();
            $_SESSION['user_id'] = $curr['user_id'];
            $_SESSION['username'] = $curr['username'];
            $_SESSION['fullname'] = $curr['full_name'];
            $_SESSION['email'] = $curr['email'];
            $_SESSION['position'] = $curr['position'];
            $_SESSION['success'] = "Login Success";
            header('location: /Web_HospitalManagement');
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