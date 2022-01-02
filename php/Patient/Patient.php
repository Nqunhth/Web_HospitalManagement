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
            WHERE DATE(medical_register.created_date) = CURRENT_DATE && medical_register.medi_status = 'enabled' && pat_status = 'caring'
            ORDER BY medical_register.queue_number;";
        return $conn->query($query);
    }
    public static function fetchCaringPatientForDoctor($doctorId){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT * 
            FROM `patient`
            JOIN `medical_register`
            ON patient.pat_id = medical_register.pat_id
            WHERE DATE(medical_register.created_date) = CURRENT_DATE && medical_register.medi_status = 'enabled' && pat_status = 'caring' && doctor_id = '" . $doctorId . "'
            ORDER BY medical_register.queue_number;";
        return $conn->query($query);
    }
    public static function fetchAsignedPatient(){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT * 
            FROM `patient`
            JOIN `medical_register`
            ON patient.pat_id = medical_register.pat_id
            WHERE DATE(medical_register.created_date) = CURRENT_DATE && medical_register.medi_status = 'enabled' && pat_status = 'asigned'
            ORDER BY medical_register.queue_number;";
        return $conn->query($query);
    }
    public static function fetchAsignedPatientForDoctor($doctorId){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT * 
            FROM `patient`
            JOIN `medical_register`
            ON patient.pat_id = medical_register.pat_id
            JOIN personal_info
            ON personal_info.user_id = specialist_id
            LEFT JOIN `specialist_consulting`
            ON patient.pat_id = specialist_consulting.pat_id
            WHERE DATE(medical_register.created_date) = CURRENT_DATE && medical_register.medi_status = 'enabled' && (pat_status = 'asigned' || pat_status = 'consulted') && doctor_id = '" . $doctorId . "'
            ORDER BY medical_register.queue_number;";
        return $conn->query($query);
    }
    public static function fetchConsultedPatientForDoctor($doctorId){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT * 
            FROM `patient`
            JOIN `medical_register`
            ON patient.pat_id = medical_register.pat_id
            JOIN personal_info
            ON personal_info.user_id = specialist_id
            WHERE DATE(medical_register.created_date) = CURRENT_DATE && medical_register.medi_status = 'enabled' && pat_status = 'consulted' && doctor_id = '" . $doctorId . "'
            ORDER BY medical_register.queue_number;";
        return $conn->query($query);
    }
    public static function fetchAsignedPatientBySpecialist($specialistId){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT * 
            FROM `patient`
            JOIN `medical_register`
            ON patient.pat_id = medical_register.pat_id
            JOIN personal_info
            ON personal_info.user_id = specialist_id
            LEFT JOIN `specialist_consulting`
            ON patient.pat_id = specialist_consulting.pat_id
            WHERE DATE(medical_register.created_date) = CURRENT_DATE && medical_register.medi_status = 'enabled' && pat_status = 'asigned' && specialist_id = '" . $specialistId . "';";
        return $conn->query($query);
    }
    public static function fetchCountTotal(){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT count(pat_id) 
            AS total 
            FROM patient";
        return $conn->query($query);
    }
    public static function fetchAllPatient($start, $limit){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT * 
            FROM `patient`
            JOIN `medical_register`
            ON patient.pat_id = medical_register.pat_id
            LEFT JOIN prescription
            ON patient.pat_id = prescription.pat_id
            LIMIT $start, $limit";
        return $conn->query($query);
    }
    public static function fetchCaringPatientByQueue($queue){
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
    public static function fetchAsignedPatientByQueue($queue){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT * 
            FROM `patient`
            JOIN `medical_register`
            ON patient.pat_id = medical_register.pat_id
            WHERE DATE(medical_register.created_date) = CURRENT_DATE && medical_register.medi_status = 'enabled' && pat_status = 'asigned' && queue_number = '" . $queue . "'";
        return $conn->query($query);
    }
    public static function fetchConsultedPatientByQueue($queue){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT * 
            FROM `patient`
            JOIN `medical_register`
            ON patient.pat_id = medical_register.pat_id
            WHERE DATE(medical_register.created_date) = CURRENT_DATE && medical_register.medi_status = 'enabled' && pat_status = 'consulted' && queue_number = '" . $queue . "'";
        return $conn->query($query);
    }
    public static function changeStatus($patientId, $status)
    {
        $db = new DataBase();
        $db->dbConnect();
        $query = 
        "UPDATE patient
        SET pat_status = '" . $status . "'
        WHERE pat_id = '" . $patientId . "' ";
        
        if($db->execute($query)){
            echo "Change patient status Successfull";
        }
    }
}

?>