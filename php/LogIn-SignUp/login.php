<?php

class Login
{
    public static function Login()
    {
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
                    $_SESSION['avatar'] = $curr['avatar'];
                    $_SESSION['position'] = $curr['position'];
                    $_SESSION['specialized_field'] = $curr['specialized_field'];
                    $_SESSION['success'] = "Login Success";
                    header('location: /Web_HospitalManagement');
                };
                if ($login == 0) {
                    return "Username or Password wrong";
                };
                if ($login == 2) {
                    return "This account is yet activated or being disabled";
                };
                if ($login == 3) {
                    return "Username or Password wrong";
                }
            } else return "Error: Database connection";
        } else  return "All fields are required";
    }
}
