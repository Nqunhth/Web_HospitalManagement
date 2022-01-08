<?php


class CreatePrescription
{
    public static function Create()
    {
        if (
            !empty($_POST['patient_id']) && !empty($_SESSION['user_id']) && !empty($_SESSION['fullname']) && !empty($_POST['conclusion']) && !empty($_POST['medicines'])
        ) {
            $newPrescription =
                Prescription::withFullInfo(
                    $_POST['patient_id'],
                    $_SESSION['user_id'],
                    $_SESSION['fullname'],
                    $_POST['conclusion'],
                    $_POST['medicines']
                );
            Patient::changeStatus($_POST['patient_id'], "done");
            if ($newPrescription->postToDataBase()) {

                return "Create Successfull";
            } else {
                return "Create Failed";
            };
        } else {
            return "All field required!";
        };
    }
}
