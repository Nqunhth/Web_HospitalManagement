<?php
require "DataBaseConfig.php";

class DataBase
{
    public $connect;
    public $data;
    private $sql;
    protected $servername;
    protected $username;
    protected $password;
    protected $databasename;

    public function __construct()
    {
        $this->connect = null;
        $this->data = null;
        $this->sql = null;
        $dbc = new DataBaseConfig();
        $this->servername = $dbc->servername;
        $this->username = $dbc->username;
        $this->password = $dbc->password;
        $this->databasename = $dbc->databasename;
    }

    function dbConnect()
    {
        $this->connect = mysqli_connect($this->servername, $this->username, $this->password, $this->databasename);
        return $this->connect;
    }

    function close()
    {
        $this->connect->close();
    }
    
    function insert_id(){
        return $this->connect->insert_id;
    }

    function prepareData($data)
    {
        return mysqli_real_escape_string($this->connect, stripslashes(htmlspecialchars($data)));
    }

    function executeSelectQuery($query) {
		$result = mysqli_query($this->connect,$query);
		while($row=mysqli_fetch_assoc($result)) {
			$resultset[] = $row;
		}
		if(!empty($resultset))
			return $resultset;
	}

    //For Log In
    function logIn($table, $username, $password)
    {      
        $username = $this->prepareData($username);
        $password = $this->prepareData($password);
        $this->sql = "select * from " . $table . " where username = '" . $username . "'";
        $result = mysqli_query($this->connect, $this->sql);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) != 0) {
            $dbusername = $row['username'];
            $dbpassword = $row['password'];
            $dbstatus = $row['status'];
            if ($dbstatus == "enabled") {
                if ($dbusername == $username && password_verify($password, $dbpassword)) {
                    $login = 1; // success
                } else $login = 0; // wrong username or password
            } else $login = 2; // disabled account
        } else $login = 3; // no fetch result
        return $login;
    }
    //For Sign Up
    function getToken($table, $username)
    {
        $username = $this->prepareData($username);
        $this->sql = "select token from " . $table . " where username = '" . $username . "'";
        $result = mysqli_query($this->connect, $this->sql);
        $row = mysqli_fetch_assoc($result);
        return $row['token'];
    }
    function setToLastId($table){
        $new_id = $this->connect->insert_id;
        $new_id = $this->prepareData($new_id);
        $this->sql = "ALTER TABLE " . $table . " AUTO_INCREMENT = " . $new_id . "";
        if(mysqli_query($this->connect, $this->sql))
        {
            return true;
        }
        else return false;
    }
    function addUser($table){
        if($this->setToLastId($table)){
            $this->sql = "INSERT INTO " . $table . " (" . $table . "_id) VALUES (null)";
            if(mysqli_query($this->connect, $this->sql)){
                return true;
            };            
        }
        else
        {
            echo("Error description: " . $this->connect->error);
        };
        return false;
    }
    function addNameAndField($table, $fullname, $field){
        if($this->setToLastId($table)){
            $this->sql =
            "INSERT INTO " . $table . " (full_name, specialized_field) VALUES ('" . $fullname . "','" . $field . "')";
            if(mysqli_query($this->connect, $this->sql)){
                return true;
            };            
        }
        else
        {
            echo("Error description: " . $this->connect->error);
        };
        return false;
    }
    function signUp($table, $username, $password, $position, $email, $fullname, $field)
    {
        $position = $this->prepareData($position);
        $username = $this->prepareData($username);
        $password = $this->prepareData($password);
        $email = $this->prepareData($email);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $token = $this->prepareData(md5($username . strval(time())));

        $fullname = $this->prepareData($fullname);
        $field = $this->prepareData($field);

        $this->sql =
            "INSERT INTO " . $table . " (username, password, position, email, token) VALUES ('" . $username . "','" . $password . "','" . $position . "','" . $email . "','" . $token . "')";
        if (mysqli_query($this->connect, $this->sql) && $this->addUser("user") && $this->addNameAndField("personal_info", $fullname, $field)) {
            if($position != "manager")
                $this->addUser($position);
            return true;
        } else return false;
    }
    function verify($table, $token)
    {
        $token = $this->prepareData($token);

        $this->sql = "select * from " . $table . " where token = '" . $token . "'";
        $result = mysqli_query($this->connect, $this->sql);
        $row = mysqli_fetch_assoc($result);
        if (mysqli_num_rows($result) == 0) {
            return false;
        } else {
            $this->sql = "UPDATE " . $table . " SET status = 'enabled' where token = '" . $token . "'";
            
            if (mysqli_query($this->connect, $this->sql)) {
                $this->discardToken($table, $token);
                return true;
            } else return false;
        }
    }
    function discardToken($table, $token)
    {
        $token = $this->prepareData($token);
        $this->sql = "UPDATE " . $table . " SET token = 'activated' where token = '" . $token . "'";
        mysqli_query($this->connect, $this->sql);
    }
    function execute($query) {
        if(mysqli_query($this->connect,$query))
            return true;
        else {
            printf("Error message: %s\n", mysqli_error($this->connect));
            return false;
        }
    }
        // function uploadImg($table, $link)
    // {
    //     $link = $this->prepareData($link);
    //     $this->sql = "INSERT INTO " . $table . " (img_link) VALUES ('" . $link . "')";
    //     if (mysqli_query($this->connect, $this->sql)) {
    //         return true;
    //     } else return false;
    // }

    
    function changePassword($table, $token, $password){
        $password = $this->prepareData($password);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $token = $this->prepareData($token);
        $this->sql =
            "UPDATE " . $table . 
            " SET password='" . $password . "' WHERE token='" . $token . "';";
        if (mysqli_query($this->connect, $this->sql)) {  
            $this->discardToken($table, $token);  
            return true;
        } else return false;
    }
    function changePasswordInside($table, $userId, $password){
        $password = $this->prepareData($password);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $this->sql =
            "UPDATE " . $table . 
            " SET password='" . $password . "' WHERE user_id='" . $userId . "';";
        if (mysqli_query($this->connect, $this->sql)) {  
            return true;
        } else return false;
    }
    function getTokenByEmail($table, $email)
    {
        $username = $this->prepareData($email);
        $this->sql = "select token from " . $table . " where email = '" . $email . "'";
        $result = mysqli_query($this->connect, $this->sql);
        $row = mysqli_fetch_assoc($result);
        return $row['token'];
    }
    function generateTokenForRecovery($table, $email){
        $token = $this->prepareData(md5($email . strval(time())));
        $this->sql = "UPDATE " . $table . " SET token = '" . $token . "' where email = '" . $email . "'";
        if (mysqli_query($this->connect, $this->sql)) {
            return true;
        } else return false;
    }
}


