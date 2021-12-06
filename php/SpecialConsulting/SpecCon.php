<?php
require_once("../ConnectionConfig/DataBase.php");

class SpecCon{
    //from patient
    private $patientName;
    private $patientAge;
    private $patientAddress;
    private $patientPhone;
    private $patientJob;
    private $reason;
    private $testArea;
    private $doctorId;
    private $doctorName;
    private $request;
    private $result;

    public function __construct(){
        $this->patientName = "";
        $this->patientAge = "";
        $this->patientAddress = "";
        $this->patientPhone = "";
        $this->patientJob = "";
        $this->reason = "";
        $this->testArea = "";
        $this->doctorId = "";
        $this->doctorName = "";
        $this->request = "";
        $this->result = "";
    }

    public static function withFullInfo( $pName, $pAge, $pAddress, $pPhone, $pJob, $reason, $testArea, $dId, $dName, $request, $result ) {
        $instance = new self();
        $instance->fillInfo( $pName, $pAge, $pAddress, $pPhone, $pJob, $reason, $testArea, $dId, $dName, $request, $result );
        return $instance;
    }
    protected function fillInfo($pName, $pAge, $pAddress, $pPhone, $pJob, $reason, $testArea, $dId, $dName, $request, $result){
        $db = new DataBase();
        $db->dbConnect();
        $this->patientName = $db->prepareData($pName);
        $this->patientAge = $db->prepareData($pAge);
        $this->patientAddress = $db->prepareData($pAddress);
        $this->patientPhone = $db->prepareData($pPhone);
        $this->patientJob = $db->prepareData($pJob);
        $this->reason = $db->prepareData($reason);
        $this->testArea = $db->prepareData($testArea);
        $this->doctorId = $db->prepareData($dId);
        $this->doctorName = $db->prepareData($dName);
        $this->request = $db->prepareData($request);
        $this->result = $db->prepareData($result);
    }

    function __set($key, $value){
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
        if ($key = 'reason'){
            $this->reason = $value;
        };
        if ($key = 'testArea'){
            $this->testArea = $value;
        };
        if ($key = 'doctorId'){
            $this->doctorId = $value;
        };
        if ($key = 'doctorName'){
            $this->doctorName = $value;
        };
        if ($key = 'request'){
            $this->request = $value;
        };
        if ($key = 'result'){
            $this->result = $value;
        };
    }
    function __get($key){
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
        if ($key = 'reason'){
            return $this->reason;
        };
        if ($key = 'testArea'){
            return $this->testArea;
        };
        if ($key = 'doctorId'){
            return $this->doctorId;
        };
        if ($key = 'doctorName'){
            return $this->doctorName;
        };
        if ($key = 'request'){
            return $this->request;
        };
        if ($key = 'result'){
            return $this->result;
        };
    }

    function postToDataBase(){
        // $new = $this->prepareSpecCon();
        $db = new DataBase();
        $db->dbConnect();
        $query = 
        "INSERT INTO specialist_consulting (creator_id, creator_name, spec_reason, test_area, request, result) 
        VALUES ('" . $this->doctorId . "','" . $this->doctorName . "', '" . $this->reason . "', '" . $this->testArea . "', '" . $this->request . "', '" . $this->result . "')";
        
        return $db->execute($query);
    }

}

?>