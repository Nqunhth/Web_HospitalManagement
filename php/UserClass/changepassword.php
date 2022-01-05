<?php

class ChangePassword{
    public function __construct()
    {
    }
    public static function changePassword(){
        $db = new DataBase();

        if (!empty($_POST['current_pass']) && !empty($_POST['new_pass']) && !empty($_POST['confirm_pass'])) {
            if ($db->dbConnect()) {
                $login = $db->logIn("account", $_SESSION['username'], $_POST['current_pass']);
                if ($login == 1) {
                    if ($_POST['new_pass'] == $_POST['confirm_pass']) {
                        if ($db->changePasswordInside("account", $_SESSION['user_id'], $_POST['new_pass']))
                            return "Change password success";
                    } else return "Your confirm password does not match your new password";
                } else return "The current password you enter is wrong";
            } else return "Error: Database connection";
        } else return "All fields are required";
    }
}