<?php


class UpdateUser
{
    public static function Update()
    {
        if (
            !empty($_SESSION['user_id'])
        ) {
            if($_POST['gender'] == "female" || $_POST['gender'] == "male"){}
            else{                    
                return "Gender must be either male of female";
            };
            if(preg_match('/^[1-9][0-9]*$/', $_POST['age'])){}
            else{                    
                return "Age must be greater than 0";
            };
            if(preg_match('/^[0-9][0-9]*$/', $_POST['phone'])){}
            else{                    
                return "Invalid data Phone Number";
            };
            if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $_POST['birthday'])) {}
            else{
                return "Your birthday must be in format of yyyy-mm-dd";
            }
            if(preg_match("/^[0-9]{4}-(0[1-9]|1[0-2])-(0[1-9]|[1-2][0-9]|3[0-1])$/", $_POST['id_date'])) {}
            else{
                return "Your ID card date must be in format of yyyy-mm-dd";
            }
            User::updateInfo(                    
            $_POST['full_name'],
            $_POST['age'],
            $_POST['gender'],
            $_POST['birthday'],
            $_POST['field'],
            $_POST['address'],
            $_POST['phone'],
            $_POST['id_number'],
            $_POST['id_date'],
            $_SESSION['user_id']);
            return "Updated Successfully";
        } else {
            return "Not Found User";
        };
    }
}