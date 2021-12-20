<?php
require "Prescription.php";
require "../Patient/Patient.php";

session_start();

if (
    !empty($_POST['patient_id']) && !empty($_SESSION['user_id']) && !empty($_SESSION['fullname']) && !empty($_POST['conclusion']) && !empty($_POST['medicines'])) {
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

        echo "Create Successfull";
    } else {
        echo "Create Failed";
    };
}
else{
    echo "All field required!";
};