<?php

class Invoice{
    private $cusName;
    private $cusAddress;
    private $creatorId;
    private $sumCost;

    public function __construct(){
        $this->cusName = "";
        $this->cusAddress = "";
        $this->creatorId = "";
        $this->sumCost = "";
    }

    public static function withFullInfo( $iName, $iAddress, $iCreaterId, $iSumCost) {
        $instance = new self();
        $instance->fillInfo( $iName, $iAddress, $iCreaterId, $iSumCost);
        return $instance;
    }
    protected function fillInfo($iName, $iAddress, $iCreaterId, $iSumCost){
        $db = new DataBase();
        $db->dbConnect();
        $this->cusName = $db->prepareData($iName);
        $this->cusAddress = $db->prepareData($iAddress);
        $this->creatorId = $db->prepareData($iCreaterId);
        $this->sumCost = $db->prepareData($iSumCost);
    }

    function __set($key, $value){
        if ($key = 'cusName'){
            $this->cusName = $value;
        };
        if ($key = 'cusAddress'){
            $this->cusAddress = $value;
        };
        if ($key = 'creatorId'){
            $this->creatorId = $value;
        };
        if ($key = 'sumCost'){
            $this->sumCost = $value;
        };
    }
    function __get($key){
        if ($key = 'cusName'){
            return $this->cusName;
        };
        if ($key = 'cusAddress'){
            return $this->cusAddress;
        };
        if ($key = 'creatorId'){
            return $this->creatorId;
        };
        if ($key = 'sumCost'){
            return $this->sumCost;
        };
    }

    public static function fetchInvoice(){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT * 
            FROM `invoice`";
        return $conn->query($query);
    }
    public static function fetchCountTotal(){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT count(invo_id) 
            AS total 
            FROM invoice";
        return $conn->query($query);
    }
    public static function fetchInvoicePage($start, $limit){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT * 
            FROM `invoice`
            LIMIT $start, $limit";
        return $conn->query($query);
    }
    public static function fetchNewInvoice(){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT * 
            FROM `invoice`
            ORDER  BY `invo_id` DESC
            LIMIT  1";
        return $conn->query($query);
    }
    
    function postToDataBase(){
        $db = new DataBase();
        $db->dbConnect();
        $query = 
        "INSERT INTO invoice (cus_name, cus_address, creator_id, sum_cost) 
        VALUES ('" . $this->cusName . "','" . $this->cusAddress . "','" . $this->creatorId . "', '" . $this->sumCost . "')";
        
        return $db->execute($query);
    }

    public static function disableForm($formId){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
        "UPDATE `invoice`
        SET invo_status = 'disabled'
        WHERE invo_id = '" . $formId . "' ";

        return $conn->query($query);
    }
    public static function enableForm($formId){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
        "UPDATE `invoice`
        SET invo_status = 'enabled'
        WHERE invo_id = '" . $formId . "' ";

        return $conn->query($query);
    }
}

?>