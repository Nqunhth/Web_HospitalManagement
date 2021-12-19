<?php
class User{
    private $userId;
    private $userName;
    private $userAge;
    private $userAddress;
    private $userPhone;
    private $userField;

    public function __construct(){
        $this->userId = "";
        $this->userName = "";
        $this->userAge = "";
        $this->userAddress = "";
        $this->userPhone = "";
        $this->userField = "";
    }

    public static function withFullInfo( $uName, $uAge, $uAddress, $uPhone, $uField) {
        $instance = new self();
        $instance->fillInfo( $uName, $uAge, $uAddress, $uPhone, $uField);
        return $instance;
    }
    protected function fillInfo($uName, $uAge, $uAddress, $uPhone, $uField){
        $db = new DataBase();
        $db->dbConnect();
        $this->userName = $db->prepareData($uName);
        $this->userAge = $db->prepareData($uAge);
        $this->userAddress = $db->prepareData($uAddress);
        $this->userPhone = $db->prepareData($uPhone);
        $this->userField = $db->prepareData($uField);
    }

    function __set($key, $value){
        if ($key = 'userId'){
            $this->userId = $value;
        };
        if ($key = 'userName'){
            $this->userName = $value;
        };
        if ($key = 'userAge'){
            $this->userAge = $value;
        };
        if ($key = 'userAddress'){
            $this->userAddress = $value;
        };
        if ($key = 'userPhone'){
            $this->userPhone = $value;
        };
        if ($key = 'userField'){
            $this->userField = $value;
        };
    }
    function __get($key){
        if ($key = 'userId'){
            return $this->userId;
        };
        if ($key = 'userName'){
            return $this->userName;
        };
        if ($key = 'userAge'){
            return $this->userAge;
        };
        if ($key = 'userAddress'){
            return $this->userAddress;
        };
        if ($key = 'userPhone'){
            return $this->userPhone;
        };
        if ($key = 'userField'){
            return $this->userField;
        };
    }

    public static function fetchActiveUser($table){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
        "SELECT * FROM " . $table . " 
        JOIN personal_info ON " . $table . "." . $table . "_id = personal_info.user_id
        JOIN account ON " . $table . "." . $table . "_id = account.user_id
        WHERE account.status = 'enabled'";

        return $conn->query($query);
    }
    public static function fetchActiveDoctorForReceptionist(){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
        "SELECT * FROM doctor 
        JOIN personal_info ON doctor.doctor_id = personal_info.user_id
        JOIN account ON doctor.doctor_id = account.user_id
        WHERE account.status = 'enabled' && personal_info.specialized_field = 'Tổng quát'";

        return $conn->query($query);
    }
    public static function fetchUserById($userId){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
        "SELECT * FROM account 
        JOIN personal_info ON account.user_id = personal_info.user_id
        WHERE account.user_id = '" . $userId . "'";

        return $conn->query($query);
    }

    public static function fetchUserByUsername($username){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $username = $db->prepareData($username);
        $query = 
        "SELECT * FROM account 
        JOIN personal_info ON account.user_id = personal_info.user_id
        WHERE account.username = '" . $username . "'";

        return $conn->query($query);
    }
    public static function fetchSpecialist(){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
        "SELECT * FROM doctor 
        JOIN personal_info ON doctor.doctor_id = personal_info.user_id
        JOIN account ON doctor.doctor_id = account.user_id
        WHERE account.status = 'enabled' && personal_info.specialized_field <> 'Tổng quát'";

        return $conn->query($query);
    }
    function postToDataBase(){
        // $new = $this->prepareSpecCon();
        // $db = new DataBase();
        // $db->dbConnect();
        // $query = 
        // "INSERT INTO patient (pat_name, pat_age, pat_address, pat_phone, pat_job) 
        // VALUES ('" . $this->patientName . "','" . $this->patientAge . "', '" . $this->patientAddress . "', '" . $this->patientPhone . "', '" . $this->patientJob . "')";
        
        // if($db->execute($query)){
        //     $newMediReg = new MedicalRegister();
        //     $this->patientId = $db->insert_id();
        //     $this->patientId = $db->prepareData($this->patientId);
        //     if($newMediReg->createEmptyDoc($this->patientId)){
        //         return $this->patientId;
        //     };
        // }
        // return "none";
    }

}

?>