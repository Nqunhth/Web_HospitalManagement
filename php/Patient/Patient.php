<?php

class Patient{
    //from patient
    private $patientId;
    private $patientName;
    private $patientAge;
    private $patientAddress;
    private $patientPhone;
    private $patientJob;

    public function __construct(){
        $this->patientId = "";
        $this->patientName = "";
        $this->patientAge = "";
        $this->patientAddress = "";
        $this->patientPhone = "";
        $this->patientJob = "";
    }

    public static function withFullInfo( $pName, $pAge, $pAddress, $pPhone, $pJob) {
        $instance = new self();
        $instance->fillInfo( $pName, $pAge, $pAddress, $pPhone, $pJob);
        return $instance;
    }
    protected function fillInfo($pName, $pAge, $pAddress, $pPhone, $pJob){
        $db = new DataBase();
        $db->dbConnect();
        $this->patientName = $db->prepareData($pName);
        $this->patientAge = $db->prepareData($pAge);
        $this->patientAddress = $db->prepareData($pAddress);
        $this->patientPhone = $db->prepareData($pPhone);
        $this->patientJob = $db->prepareData($pJob);
    }

    function __set($key, $value){
        if ($key = 'patientId'){
            $this->patientId = $value;
        };
        if ($key = 'patientName'){
            $this->patientName = $value;
        };
        if ($key = 'patientAge'){
            $this->patientAge = $value;
        };
        if ($key = 'patientAddress'){
            $this->patientAddress = $value;
        };
        if ($key = 'patientPhone'){
            $this->patientPhone = $value;
        };
        if ($key = 'patientJob'){
            $this->patientJob = $value;
        };
    }
    function __get($key){
        if ($key = 'patientId'){
            return $this->patientId;
        };
        if ($key = 'patientName'){
            return $this->patientName;
        };
        if ($key = 'patientAge'){
            return $this->patientAge;
        };
        if ($key = 'patientAddress'){
            return $this->patientAddress;
        };
        if ($key = 'patientPhone'){
            return $this->patientPhone;
        };
        if ($key = 'patientJob'){
            return $this->patientJob;
        };
    }

    function postToDataBase(){
        // $new = $this->prepareSpecCon();
        $db = new DataBase();
        $db->dbConnect();
        $query = 
        "INSERT INTO patient (pat_name, pat_age, pat_address, pat_phone, pat_job) 
        VALUES ('" . $this->patientName . "','" . $this->patientAge . "', '" . $this->patientAddress . "', '" . $this->patientPhone . "', '" . $this->patientJob . "')";
        
        if($db->execute($query)){
            $newMediReg = new MedicalRegister();
            $this->patientId = $db->insert_id();
            $this->patientId = $db->prepareData($this->patientId);
            if($newMediReg->createEmptyDoc($this->patientId)){
                return $this->patientId;
            };
        }
        return "none";
    }

    public static function fetchCaringPatient(){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT * 
            FROM `patient`
            JOIN `medical_register`
            ON patient.pat_id = medical_register.pat_id
            WHERE DATE(medical_register.created_date) = CURRENT_DATE && medical_register.medi_status = 'enabled' && pat_status = 'caring';";
        return $conn->query($query);
    }
    public static function fetchAllPatient(){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT * 
            FROM `patient`
            JOIN `medical_register`
            ON patient.pat_id = medical_register.pat_id";
        return $conn->query($query);
    }
    public static function fetchPatientByQueue($queue){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT * 
            FROM `patient`
            JOIN `medical_register`
            ON patient.pat_id = medical_register.pat_id
            WHERE DATE(medical_register.created_date) = CURRENT_DATE && medical_register.medi_status = 'enabled' && pat_status = 'caring' && queue_number = '" . $queue . "'";
        return $conn->query($query);
    }
}

?>