<?php
require_once('constants.php');

class Database {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli(Host_Name, Database_User, Password,Db_Name);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }else{
            echo 'connection success!';
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>
