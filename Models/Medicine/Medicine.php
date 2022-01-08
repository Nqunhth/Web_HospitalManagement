<?php

class Medicine{
    //from patient
    private $medicineId;
    private $medicineSeri;
    private $medicineName;
    private $medicineUnitPrice;
    private $medicineUnit;
    private $medicineProducer;
    private $medicineQuantity;

    public function __construct(){
        $this->medicineId = "";
        $this->medicineSeri = "";
        $this->medicineName = "";
        $this->medicineUnitPrice = "";
        $this->medicineUnit = "";
        $this->medicineProducer = "";
        $this->medicineQuantity = "";
    }

    public static function withFullInfo( $mSeri, $mName, $mUnitPrice, $mUnit, $mProducer, $mQuantity) {
        $instance = new self();
        $instance->fillInfo( $mSeri, $mName, $mUnitPrice, $mUnit, $mProducer, $mQuantity);
        return $instance;
    }
    protected function fillInfo($mSeri, $mName, $mUnitPrice, $mUnit, $mProducer, $mQuantity){
        $db = new DataBase();
        $db->dbConnect();
        $this->medicineSeri = $db->prepareData($mSeri);
        $this->medicineName = $db->prepareData($mName);
        $this->medicineUnitPrice = $db->prepareData($mUnitPrice);
        $this->medicineUnit = $db->prepareData($mUnit);
        $this->medicineProducer = $db->prepareData($mProducer);
        $this->medicineQuantity = $db->prepareData($mQuantity);
    }

    function __set($key, $value){
        if ($key = 'medicineId'){
            $this->medicineId = $value;
        };
        if ($key = 'medicineSeri'){
            $this->medicineSeri = $value;
        };
        if ($key = 'medicineName'){
            $this->medicineName = $value;
        };
        if ($key = 'medicineUnitPrice'){
            $this->medicineUnitPrice = $value;
        };
        if ($key = 'medicineUnit'){
            $this->medicineUnit = $value;
        };
        if ($key = 'medicineProducer'){
            $this->medicineProducer = $value;
        };
        if ($key = 'medicineQuantity'){
            $this->medicineQuantity = $value;
        };
    }
    function __get($key){
        if ($key = 'medicineId'){
            return $this->medicineId;
        };
        if ($key = 'medicineSeri'){
            return $this->medicineSeri;
        };
        if ($key = 'medicineName'){
            return $this->medicineName;
        };
        if ($key = 'medicineUnitPrice'){
            return $this->medicineUnitPrice;
        };
        if ($key = 'medicineUnit'){
            return $this->medicineUnit;
        };
        if ($key = 'medicineProducer'){
            return $this->medicineProducer;
        };
        if ($key = 'medicineQuantity'){
            return $this->medicineQuantity;
        };
    }
    public static function fetchCountTotal(){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT count(medicine_id) 
            AS total 
            FROM medicine";
        return $conn->query($query);
    }
    public static function fetchMedicinePage($start, $limit){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT * 
            FROM `medicine`
            LIMIT $start, $limit";
        return $conn->query($query);
    }
    public static function fetchMedicine(){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT * 
            FROM `medicine`";
        return $conn->query($query);
    }
    public static function fetchMedicineSelected($mName){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT * 
            FROM `medicine`
            WHERE `medicine_name` = '$mName'";
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