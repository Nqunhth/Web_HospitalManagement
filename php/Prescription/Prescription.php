<?php

class Prescription{
    //from patient
    private $patientId;
    private $creatorId;
    private $creatorName;
    private $conclusion;
    private $medicines;

    public function __construct(){
        $this->patientId = "";
        $this->creatorId = "";
        $this->creatorName = "";
        $this->conclusion = "";
        $this->medicines = "";
    }

    public static function withFullInfo( $pId, $creatorId, $creatorName, $conclusion, $medicines ) {
        $instance = new self();
        $instance->fillInfo( $pId, $creatorId, $creatorName, $conclusion, $medicines );
        return $instance;
    }
    protected function fillInfo($pId, $creatorId, $creatorName, $conclusion, $medicines){
        $db = new DataBase();
        $db->dbConnect();
        $this->patientId = $db->prepareData($pId);
        $this->creatorId = $db->prepareData($creatorId);
        $this->creatorName = $db->prepareData($creatorName);
        $this->conclusion = $db->prepareData($conclusion);
        $this->medicines = $db->prepareData($medicines);
    }

    function __set($key, $value){
        if ($key = 'patientId'){
            $this->patientId = $value;
        };
        if ($key = 'creatorId'){
            $this->creatorId = $value;
        };
        if ($key = 'creatorName'){
            $this->creatorName = $value;
        };
        if ($key = 'conclusion'){
            $this->conclusion = $value;
        };
        if ($key = 'medicines'){
            $this->medicines = $value;
        };
    }
    function __get($key){
        if ($key = 'patientId'){
            return $this->patientId;
        };
        if ($key = 'creatorId'){
            return $this->creatorId;
        };
        if ($key = 'creatorName'){
            return $this->creatorName;
        };
        if ($key = 'conclusion'){
            return $this->conclusion;
        };
        if ($key = 'medicines'){
            return $this->medicines;
        };

    }

    function postToDataBase(){
        $db = new DataBase();
        $db->dbConnect();
        $query = 
        "INSERT INTO prescription (pat_id, creator_id, creator_name, conclusion, medicines) 
        VALUES ('" . $this->patientId . "','" . $this->creatorId . "','" . $this->creatorName . "', '" . $this->conclusion . "', '" . $this->medicines . "')";
        
        return $db->execute($query);
    }

}

?>