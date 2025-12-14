<?php
require_once "config/Database.php";

class Enrollment {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    // =========================
    // Kiểm tra đã đăng ký chưa
    // =========================
    public function isEnrolled($student_id, $course_id) {
        $sql = "SELECT id 
                FROM enrollments 
                WHERE student_id = ? AND course_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$student_id, $course_id]);
        return $stmt->fetch();
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
