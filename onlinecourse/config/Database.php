<?php
class Database {
    private $host = "localhost";
    private $db_name = "onlinecourse";
    private $username = "root";
    private $password = ""; // hoặc mật khẩu của bạn
    public $conn;

    public function getConnection() {
        $this->conn = null;
        try {
            $this->conn = new PDO(
                "mysql:host={$this->host};port=3306;dbname={$this->db_name}",
                $this->username,
                $this->password
            );
            $this->conn->exec("set names utf8mb4");
        } catch(PDOException $exception) {
            echo "Connection error: " . $exception->getMessage();
            exit;
        }
        return $this->conn;
    }
}
