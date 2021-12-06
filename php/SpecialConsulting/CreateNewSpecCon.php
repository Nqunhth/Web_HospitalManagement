<?php
require "SpecCon.php";

session_start();

if (
    !empty($_POST['patient_name']) && !empty($_POST['patient_age']) && !empty($_POST['patient_address']) && !empty($_POST['patient_phone']) && !empty($_POST['patient_job']) &&
    !empty($_POST['reason']) && !empty($_POST['test_area']) && !empty($_SESSION['user_id']) && !empty($_SESSION['fullname']) && !empty($_POST['request']) && !empty($_POST['result'])
) {
    $newSpecCon =
        SpecCon::withFullInfo(
            $_POST['patient_name'],
            $_POST['patient_age'],
            $_POST['patient_address'],
            $_POST['patient_phone'],
            $_POST['patient_job'],
            $_POST['reason'],
            $_POST['test_area'],
            $_SESSION['user_id'],
            $_SESSION['fullname'],
            $_POST['request'],
            $_POST['result']
        );
    if ($newSpecCon->postToDataBase()) {
        echo "Create Successfull";
    } else {
        echo "Create Failed";
    };
}
else{
    echo "All field required!";
};
