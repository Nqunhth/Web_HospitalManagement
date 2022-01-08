<?php
require "../../Models/ConnectionConfig/DataBase.php";

if (isset($_GET["token"])) {
    $db = new DataBase();
    if ($db->dbConnect()) {
        if ($db->verify("account", $_GET["token"])) {
            echo "Your account has been activated. You can now exit this site and continue using the app";
        } else {
            echo "No inactive account found. Activation failed";
        };
    }
    else{
        echo "Connection Error!";
    }
}
?>
