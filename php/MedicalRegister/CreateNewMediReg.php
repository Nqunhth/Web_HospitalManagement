<?php
require "../ConnectionConfig/DataBase.php";
require "MedicalRegister.php";
require "../Patient/Patient.php";
require "../UserClass/User.php";

session_start();

$newPatient = Patient::withFullInfo($_POST['patient_name'], $_POST['patient_age'], $_POST['patient_address'], $_POST['patient_phone'], $_POST['patient_job']);
$patientId = $newPatient->postToDataBase();
// echo $newPatient->patientId;
if ($newPatient->patientId != "none") {
    $doctor = User::fetchUserById($_POST['doctor']);
    if ($doctor->num_rows > 0){
        $doctor = $doctor->fetch_assoc();
        $newMediReg = MedicalRegister::withFullInfo($_SESSION['user_id'], $_POST['doctor'], $doctor['full_name'], $_POST['reason']);
        $newMediReg->updateToDataBase($patientId);
        echo "Create patient Successfull";
    }
    else echo "No doctor found";
        
}
else echo "Creation error";




