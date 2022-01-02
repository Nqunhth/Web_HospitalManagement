<?php

class Doctor{
    //from patient
    private $doctorId;

    public function __construct(){
        $this->doctorId = "";
    }


    function __set($key, $value){
        if ($key = 'doctorId'){
            $this->doctorId = $value;
        };
    }
    function __get($key){
        if ($key = 'doctorId'){
            return $this->doctorId;
        };
    }
    public static function fetchCountTotal(){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT count(doctor_id) 
            AS total 
            FROM doctor";
        return $conn->query($query);
    }
    public static function fetchDoctorPage($start, $limit){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT * 
            FROM doctor 
            JOIN personal_info ON doctor.doctor_id = personal_info.user_id 
            JOIN account ON doctor.doctor_id = account.user_id
            LIMIT $start, $limit";
        return $conn->query($query);
    }
    // public static function changeStatus($patientId, $status)
    // {
    //     $db = new DataBase();
    //     $db->dbConnect();
    //     $query = 
    //     "UPDATE patient
    //     SET pat_status = '" . $status . "'
    //     WHERE pat_id = '" . $patientId . "' ";
        
    //     if($db->execute($query)){
    //         echo "Change patient status Successfull";
    //     }
    // }
    
}

?>