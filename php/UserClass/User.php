<?php
class User{
    private $userId;
    private $userName;
    private $userAge;
    private $userGender;
    private $userBirthDay; 
    private $userField;
    private $userAddress;
    private $userPhone;
    private $userCardNum;
    private $userCardDate;
   

    public function __construct(){
        $this->userId = "";
        $this->userName = "";
        $this->userAge = "";
        $this->userGender = "";
        $this->userBirthDay = "";
        $this->userField = "";
        $this->userAddress = "";
        $this->userPhone = "";
        $this->userCardNum = "";
        $this->userCardDate = "";
    }

    public static function withFullInfo( $uName, $uAge, $uGender, $uBirthday, $uField, $uAddress, $uPhone, $uCardNum, $uCardDate) {
        $instance = new self();
        $instance->fillInfo( $uName, $uAge, $uGender, $uBirthday, $uField, $uAddress, $uPhone, $uCardNum, $uCardDate);
        return $instance;
    }
    protected function fillInfo($uName, $uAge, $uGender, $uBirthday, $uField, $uAddress, $uPhone, $uCardNum, $uCardDate){
        $db = new DataBase();
        $db->dbConnect();
        $this->userName = $db->prepareData($uName);
        $this->userAge = $db->prepareData($uAge);
        $this->userGender = $db->prepareData($uGender);
        $this->userBirthDay = $db->prepareData($uBirthday);
        $this->userField = $db->prepareData($uField);
        $this->userAddress = $db->prepareData($uAddress);
        $this->userPhone = $db->prepareData($uPhone);
        $this->userCardNum = $db->prepareData($uCardNum);
        $this->userCardDate = $db->prepareData($uCardDate);
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
        if ($key = 'userGender'){
            $this->userGender = $value;
        };
        if ($key = 'userBirthDay'){
            $this->userBirthDay = $value;
        };
        if ($key = 'userField'){
            $this->userField = $value;
        };
        if ($key = 'userAddress'){
            $this->userAddress = $value;
        };
        if ($key = 'userPhone'){
            $this->userPhone = $value;
        };
        if ($key = 'userCardNum'){
            $this->userCardNum = $value;
        };
        if ($key = 'userCardDate'){
            $this->userCardDate = $value;
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
        if ($key = 'userGender'){
            return $this->userGender;
        };
        if ($key = 'userBirthDay'){
            return $this->userBirthDay;
        };
        if ($key = 'userField'){
            return $this->userField;
        };
        if ($key = 'userAddress'){
            return $this->userAddress;
        };
        if ($key = 'userPhone'){
            return $this->userPhone;
        };
        if ($key = 'userCardNum'){
            return $this->userCardNum;
        };
        if ($key = 'userCardDate'){
            return $this->userCardDate;
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
    public static function updateInfo($userName,$userAge,$userGender,$userBirthDay,$userField,$userAddress,$userPhone,$userCardNum,$userCardDate,$userId)
    {
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = "UPDATE `personal_info`
        SET
        `full_name`='" . $userName . "',
        `age`='" . $userAge . "',
        `gender`='" . $userGender . "',
        `birthday`='" . $userBirthDay . "',
        `specialized_field`='" . $userField . "',
        `address`='" . $userAddress . "',
        `phone_number`='" . $userPhone . "',
        `id_card_number`='" . $userCardNum . "',
        `id_card_date`='" . $userCardDate . "'
        WHERE `user_id` = '" . $userId . "'";

        $db->execute($query);
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
    public static function disableAccount($accountId){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
        "UPDATE `account`
        SET status = 'disabled'
        WHERE user_id = '" . $accountId . "' ";

        return $conn->query($query);
    }
    public static function enableAccount($accountId){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
        "UPDATE `account`
        SET status = 'enabled'
        WHERE user_id = '" . $accountId . "' ";

        return $conn->query($query);
    }
}

?>