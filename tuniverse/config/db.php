<?php
class Database {
    private $host = 'localhost';
    private $db_name = 'tuniverse';  // Updated database name
    private $username = 'root';   // Replace if using a different username
    private $password = '';       // Replace with your MySQL password if set
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO("mysql:host=" . $this->host . ";dbname=" . $this->db_name, $this->username, $this->password);
            $this->conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
        }
        return $this->conn;
    }
}
?>
