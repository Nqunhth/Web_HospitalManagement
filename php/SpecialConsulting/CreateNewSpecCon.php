<?php
class CreateSpecCon
{
    public static function Create()
    {
        if (
            !empty($_POST['patient_id']) && !empty($_POST['test_area']) && !empty($_SESSION['user_id']) && !empty($_SESSION['fullname']) && !empty($_POST['reason']) && !empty($_POST['request']) && !empty($_POST['result'])
        ) {
            $newSpecCon =
                SpecCon::withFullInfo(
                    $_POST['patient_id'],
                    $_POST['test_area'],
                    $_SESSION['user_id'],
                    $_SESSION['fullname'],
                    $_POST['reason'],
                    $_POST['request'],
                    $_POST['result']
                );
            Patient::changeStatus($_POST['patient_id'], "consulted");
            if ($newSpecCon->postToDataBase()) {

                return "Create Successfull";
            } else {
                return "Create Failed";
            };
        } else {
            return "All field required!";
        };
    }
}
