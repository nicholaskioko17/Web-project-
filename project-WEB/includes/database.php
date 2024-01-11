<?php
require_once('constant.php');

class Database {
    private $conn;

    public function __construct() {
        $this->conn = new mysqli(Host_Name, Database_User, Password, Database_Name);

        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getConnection() {
        return $this->conn;
    }
}
?>
