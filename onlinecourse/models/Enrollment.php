<?php
require_once "config/Database.php";

class Enrollment {
    private $conn;
    private $table = "enrollments";

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function enroll($course_id,$student_id) {
        $sql = "INSERT INTO $this->table (course_id,student_id) VALUES (:course_id,:student_id)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':course_id',$course_id);
        $stmt->bindValue(':student_id',$student_id);
        return $stmt->execute();
    }

    public function getByStudent($student_id) {
        $stmt = $this->conn->prepare("SELECT e.*, c.title FROM $this->table e LEFT JOIN courses c ON e.course_id=c.id WHERE student_id=:student_id");
        $stmt->bindValue(':student_id',$student_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
