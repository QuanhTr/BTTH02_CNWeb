<?php
require_once "config/Database.php";

class Material {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getByLesson($lesson_id) {
        $stmt = $this->conn->prepare(
            "SELECT * FROM materials WHERE lesson_id=?"
        );
        $stmt->execute([$lesson_id]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
