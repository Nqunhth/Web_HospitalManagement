<?php

class Receptionist{
    //from patient
    private $receptionistId;

    public function __construct(){
        $this->receptionist = "";
    }


    function __set($key, $value){
        if ($key = 'receptionist'){
            $this->receptionist = $value;
        };
    }
    function __get($key){
        if ($key = 'receptionist'){
            return $this->receptionist;
        };
    }
    public static function fetchCountTotal(){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT count(receptionist_id) 
            AS total 
            FROM receptionist";
        return $conn->query($query);
    }
    public static function fetchReceptionistPage($start, $limit){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT * 
            FROM receptionist 
            JOIN personal_info ON receptionist.receptionist_id = personal_info.user_id 
            JOIN account ON receptionist.receptionist_id = account.user_id
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