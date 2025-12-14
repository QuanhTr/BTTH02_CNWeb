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

    public function getStudentsByCourse($courseId) {
        $stmt = $this->conn->prepare(
            "SELECT u.fullname, e.progress
            FROM enrollments e
            JOIN users u ON e.student_id = u.id
            WHERE e.course_id=?"
        );
        $stmt->execute([$courseId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
