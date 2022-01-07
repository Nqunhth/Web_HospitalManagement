<?php header('Content-type: text/html; charset=utf-8');
class DataBaseConfig
{
    public $servername;
    public $username;
    public $password;
    public $databasename;

    public function __construct()
    {

        $this->servername = 'localhost';
        $this->username = 'root';
        $this->password = '';
        $this->databasename = 'ooap_hhm_0301';

    }
}

?>
