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
            if ($dbusername == $username && password_verify($password, $dbpassword)) {
                $login = true;
            } else $login = false;
        } else $login = false;

        return $login;
    }

    //For Sign Up
    function setToLastAccountId($table){
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
        if($this->setToLastAccountId($table)){
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
    function signUp($table, $username, $password, $position, $email)
    {
        $position = $this->prepareData($position);
        $username = $this->prepareData($username);
        $password = $this->prepareData($password);
        $email = $this->prepareData($email);
        $password = password_hash($password, PASSWORD_DEFAULT);
        $this->sql =
            "INSERT INTO " . $table . " (username, password, position, email) VALUES ('" . $username . "','" . $password . "','" . $position . "','" . $email . "')";
        if (mysqli_query($this->connect, $this->sql)) {
            $this->addUser("user");
            if($position != "manager")
                $this->addUser($position);
            return true;
        } else return false;
    }

}

?>
