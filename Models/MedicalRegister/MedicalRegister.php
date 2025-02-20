<?php
class MedicalRegister{
    private $mediId;
    private $patientId;
    private $creatorId;
    private $doctorId;
    private $doctorName;
    private $reason;
    private $queueNumber;


    //Constructor
    public function __construct(){
        $this->mediId = "";
        $this->patientId = "";
        $this->creatorId = "";
        $this->doctorId = "";
        $this->doctorName = "";
        $this->reason = "";
        $this->queueNumber = "";
    }

    public static function withFullInfo($creatorId, $doctorId, $doctorName, $reason) {
        $instance = new self();
        $instance->fillInfo($creatorId, $doctorId, $doctorName, $reason);
        return $instance;
    }
    protected function fillInfo($creatorId, $doctorId, $doctorName, $reason){
        $db = new DataBase();
        $db->dbConnect();
        $this->creatorId = $db->prepareData($creatorId);
        $this->doctorId = $db->prepareData($doctorId);
        $this->doctorName = $db->prepareData($doctorName);
        $this->reason = $db->prepareData($reason);
    }
    //End Constructor

    function __set($key, $value){
        if ($key = 'patientId'){
            $this->patientId = $value;
        };
        if ($key = 'creatorId'){
            $this->creatorId = $value;
        };
        if ($key = 'doctorId'){
            $this->doctorId = $value;
        };
        if ($key = 'doctorName'){
            $this->doctorName = $value;
        };
        if ($key = 'reason'){
            $this->reason = $value;
        };
        if ($key = 'queueNumber'){
            $this->queueNumber = $value;
        };
    }
    function __get($key){
        if ($key = 'patientId'){
            return $this->patientId;
        };
        if ($key = 'creatorId'){
            return $this->creatorId;
        };
        if ($key = 'doctorId'){
            return $this->doctorId;
        };
        if ($key = 'doctorName'){
            return $this->doctorName;
        };
        if ($key = 'reason'){
            return $this->reason;
        };
        if ($key = 'queueNumber'){
            return $this->queueNumber;
        };
    }

    public static function fetchCountTotal(){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT count(medi_id) 
            AS total 
            FROM medical_register";
        return $conn->query($query);
    }
    public static function fetchMediPage($start, $limit){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT * 
            FROM `medical_register` 
            JOIN `patient` ON `medical_register`.`pat_id`= `patient`.`pat_id`
            LIMIT $start, $limit";
        return $conn->query($query);
    }

    function createEmptyDoc($patientId){
        $db = new DataBase();
        $db->dbConnect();
        $query = 
        "INSERT INTO medical_register (pat_id) VALUES ('" . $patientId . "')";
        
        if($db->execute($query)){
            return true;
        }
        else return false;
    }

    function updateToDataBase($patientId){
        $db = new DataBase();
        $db->dbConnect();
        $query = 
        "UPDATE medical_register
        SET creator_id = '" . $this->creatorId . "', doctor_id = '" . $this->doctorId . "', doctor_name = '" . $this->doctorName . "', medi_reason = '" . $this->reason . "'
        WHERE medical_register.pat_id = '" . $patientId . "' ";
        
        if($db->execute($query)){
            echo "Create Medi Successfull";
        }
    }

    static function asignSpecialist($mediId, $specialistId){
        $db = new DataBase();
        $db->dbConnect();
        $query = 
        "UPDATE medical_register
        SET specialist_id = '" . $specialistId . "'
        WHERE medical_register.medi_id = '" . $mediId . "' ";
        
        if($db->execute($query)){
            echo "Asign specialist success";
        }
    }
}

?>