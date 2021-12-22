<?php
class SpecCon{
    //from patient
    private $patientId;
    private $testArea;
    private $doctorId;
    private $doctorName;
    private $reason;
    private $request;
    private $result;

    public function __construct(){
        $this->patientId = "";
        $this->testArea = "";
        $this->doctorId = "";
        $this->doctorName = "";
        $this->reason = "";
        $this->request = "";
        $this->result = "";
    }

    public static function withFullInfo( $pId, $testArea, $dId, $dName, $reason, $request, $result ) {
        $instance = new self();
        $instance->fillInfo( $pId, $testArea, $dId, $dName, $reason, $request, $result );
        return $instance;
    }
    protected function fillInfo($pId, $testArea, $dId, $dName, $reason, $request, $result){
        $db = new DataBase();
        $db->dbConnect();
        $this->patientId = $db->prepareData($pId);
        $this->testArea = $db->prepareData($testArea);
        $this->doctorId = $db->prepareData($dId);
        $this->doctorName = $db->prepareData($dName);
        $this->reason = $db->prepareData($reason);
        $this->request = $db->prepareData($request);
        $this->result = $db->prepareData($result);
    }

    function __set($key, $value){
        if ($key = 'patientId'){
            $this->patientId = $value;
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
        if ($key = 'reason'){
            $this->reason = $value;
        };
        if ($key = 'request'){
            $this->request = $value;
        };
        if ($key = 'result'){
            $this->result = $value;
        };
    }
    function __get($key){
        if ($key = 'patientId'){
            return $this->patientId;
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
        if ($key = 'reason'){
            return $this->reason;
        };
        if ($key = 'request'){
            return $this->request;
        };
        if ($key = 'result'){
            return $this->result;
        };
    }

    function postToDataBase(){
        $db = new DataBase();
        $db->dbConnect();
        $query = 
        "INSERT INTO specialist_consulting (pat_id, creator_id, creator_name, spec_reason, test_area, request, result) 
        VALUES ('" . $this->patientId . "','" . $this->doctorId . "','" . $this->doctorName . "', '" . $this->reason . "', '" . $this->testArea . "', '" . $this->request . "', '" . $this->result . "')";
        
        return $db->execute($query);
    }

}

?>