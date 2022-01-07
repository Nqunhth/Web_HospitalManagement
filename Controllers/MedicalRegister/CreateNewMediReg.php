<?php
class CreateNewMedicalReg
{
    public static function Create()
    {
        if (!empty($_POST['patient_name']) && !empty($_POST['patient_age']) && !empty($_POST['patient_address']) && !empty($_POST['patient_phone']) && !empty($_POST['patient_job']) && !empty($_POST['reason'])) {
            $newPatient = Patient::withFullInfo($_POST['patient_name'], $_POST['patient_age'], $_POST['patient_address'], $_POST['patient_phone'], $_POST['patient_job']);
            $patientId = $newPatient->postToDataBase();
            // echo $newPatient->patientId;
            if ($newPatient->patientId != "none") {
                $doctor = User::fetchUserById($_POST['doctor']);
                if ($doctor->num_rows > 0) {
                    $doctor = $doctor->fetch_assoc();
                    $newMediReg = MedicalRegister::withFullInfo($_SESSION['user_id'], $_POST['doctor'], $doctor['full_name'], $_POST['reason']);
                    $newMediReg->updateToDataBase($patientId);
                    return "Create patient Successfull";
                } else return "No doctor found";
            } else return "Creation error";
        } else return "All fields are required";
    }
    public static function asignSpecialist()
    {
        if (!empty($_POST['queue']) && !empty($_POST['specialist_id'])) {
            $patient  =  Patient::fetchCaringPatientByQueue($_POST['queue']);
            if ($patient->num_rows > 0) {
                $patient = $patient->fetch_assoc();
                Patient::changeStatus($patient['pat_id'], "asigned");
                MedicalRegister::asignSpecialist($patient['medi_id'], $_POST['specialist_id']);
            }
            else return "Patient not found";
        } else return "All fields are required";
    }
}
