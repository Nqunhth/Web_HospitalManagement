<?php
class ForgerPassword
{
    public function __construct()
    {
    }
    public static function forgetPassword()
    {
        $db = new DataBase();
        $forgetMail = new ComfirmationMailing();

        if (!empty($_POST['email'])) {
            if ($db->dbConnect()) {
                if (
                    $db->generateTokenForRecovery("account", $_POST['email'])
                    && $forgetMail->sendPasswordRecovery($_POST['email'], $db->getTokenByEmail("account", $_POST['email']))
                ) 
                {
                    return "Password recovery link sent! Please check your email";
                } else return "Your email must be in format of mail@gmail.com";
            } else return "Error: Database connection";
        } else return "All fields are required";
    }
}
