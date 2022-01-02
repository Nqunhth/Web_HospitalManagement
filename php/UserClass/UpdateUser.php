<?php


class UpdateUser
{
    public static function Update()
    {
        if (
            !empty($_SESSION['user_id'])
        ) {
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