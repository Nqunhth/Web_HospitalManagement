<?php

class Manager{

    public static function fetchCountTotal(){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT count(user_id) 
            AS total 
            FROM account 
            WHERE account.position = 'manager'";
        return $conn->query($query);
    }
    public static function fetchManagerPage($start, $limit){
        $db = new DataBase();
        $conn = $db->dbConnect();
        $query = 
            "SELECT * 
            FROM account 
            JOIN personal_info ON account.user_id = personal_info.user_id 
            WHERE account.position = 'manager' 
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