<?php

class Pharmacist{
    //from patient
    private $pharmacistId;

    public function __construct(){
        $this->pharmacistId = "";
    }


    function __set($key, $value){
        if ($key = 'pharmacistId'){
            $this->pharmacistId = $value;
        };
    }
    function __get($key){
        if ($key = 'pharmacistId'){
            return $this->pharmacistId;
        };
    }
    public static function fetchCountTotal(){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT count(pharmacist_id) 
            AS total 
            FROM pharmacist";
        return $conn->query($query);
    }
    public static function fetchPharmacistPage($start, $limit){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT * 
            FROM pharmacist 
            JOIN personal_info ON pharmacist.pharmacist_id = personal_info.user_id 
            JOIN account ON pharmacist.pharmacist_id = account.user_id
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