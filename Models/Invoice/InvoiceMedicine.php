<?php

class InvoiceMedicine{
    private $medicineId;
    private $medicineName;
    private $invoId;
    private $quantity;
    private $cost;


    public function __construct(){
        $this->medicineId = "";
        $this->medicineName = "";
        $this->invoId = "";
        $this->quantity = "";
        $this->cost = "";
    }

    public static function withFullInfo($mId, $mName, $iId, $quantity, $cost) {
        $instance = new self();
        $instance->fillInfo($mId, $mName, $iId, $quantity, $cost);
        return $instance;
    }
    protected function fillInfo($mId, $mName, $iId, $quantity, $cost){
        $db = new DataBase();
        $db->dbConnect();
        $this->medicineId = $db->prepareData($mId);
        $this->medicineName = $db->prepareData($mName);
        $this->invoId = $db->prepareData($iId);
        $this->quantity = $db->prepareData($quantity);
        $this->cost = $db->prepareData($cost);
    }

    function __set($key, $value){
        if ($key = 'medicineId'){
            $this->medicineId = $value;
        };
        if ($key = 'medicineName'){
            $this->medicineName = $value;
        };
        if ($key = 'invoId'){
            $this->invoId = $value;
        };
        if ($key = 'quantity'){
            $this->quantity = $value;
        };
        if ($key = 'cost'){
            $this->cost = $value;
        };
    }
    function __get($key){
        if ($key = 'medicineId'){
            return $this->medicineId;
        };
        if ($key = 'medicineName'){
            return $this->medicineName;
        };
        if ($key = 'invoId'){
            return $this->invoId;
        };
        if ($key = 'quantity'){
            return $this->quantity;
        };
        if ($key = 'cost'){
            return $this->cost;
        };
    }

    public static function fetchInMe($id){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
        "SELECT * 
        FROM `invoice_medicine` 
        WHERE invo_id = $id";
        return $conn->query($query);
    }

    
    function postToDataBase(){
        $db = new DataBase();
        $db->dbConnect();
        $query = 
        "INSERT INTO invoice_medicine (medicine_id, medicine_name, invo_id, quantity, cost) 
        VALUES ('" . $this->medicineId . "','" . $this->medicineName . "','" . $this->invoId . "', '" . $this->quantity . "', '" . $this->cost . "')";
        return $db->execute($query);
    }
}

?>