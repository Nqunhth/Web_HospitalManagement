<?php
require "../ConnectionConfig/DataBase.php";
session_start();
$db = new DataBase();

if (!empty($_POST['current_pass']) && !empty($_POST['new_pass']) && !empty($_POST['confirm_pass'])) {
    if ($db->dbConnect()) {
        $login = $db->logIn("account", $_SESSION['username'], $_POST['current_pass']);
        if ($login == 1) {
            if ($_POST['new_pass'] == $_POST['confirm_pass']) {
                if ($db->changePasswordInside("account", $_SESSION['user_id'], $_POST['new_pass']))
                    echo "Change password success";
            } else echo "Your confirm password does not match your new password";
        } else echo "The current password you enter is wrong";
    } else echo "Error: Database connection";
} else echo "All fields are required";
