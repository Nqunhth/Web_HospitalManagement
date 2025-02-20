<?php
class SignUp
{
    public function __construct()
    {
    }
    public static function SignUp()
    {
        $comfirmMail = new ComfirmationMailing();
        $comfirmMail->SetServer();

        $db = new DataBase();
        if (!empty($_POST['username']) && !empty($_POST['password']) && !empty($_POST['position']) && !empty($_POST['email']) && !empty($_POST['fullname']) && !empty($_POST['field1']) && !empty($_POST['field2'])) {
            if ($_POST['position'] == 'doctor') {
                $field = $_POST['field2'];
            } else {
                $field = $_POST['field1'];
            }
            if ($db->dbConnect()) {
                if (
                    $db->signUp("account",  $_POST['username'], $_POST['password'], $_POST['position'], $_POST['email'], $_POST['fullname'], $field)
                    && $comfirmMail->SendTo($_POST['email'], $_POST['fullname'], $_POST['password'], $db->getToken("account", $_POST['username']))
                ) {
                    return "Account saved. Confirmation sent!";
                } else {
                    return "Sign up Failed";
                }
                $db->close();
            } else {
                return "Error: Database connection";
            }
        } else {
            return "All fields are required";
        };
    }
}
