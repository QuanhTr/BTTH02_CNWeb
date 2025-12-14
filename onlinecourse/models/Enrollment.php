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

    // =========================
    // Đăng ký khóa học
    // =========================
    public function enroll($student_id, $course_id) {
        if ($this->isEnrolled($student_id, $course_id)) {
            return false;
        }

        $sql = "INSERT INTO enrollments (student_id, course_id, progress)
                VALUES (?, ?, 0)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$student_id, $course_id]);
    }

    // =========================
    // Khóa học đã đăng ký
    // =========================
    public function getMyCourses($studentId) {
    $stmt = $this->conn->prepare(
        "SELECT c.*, e.progress, e.enrolled_date
         FROM enrollments e
         JOIN courses c ON e.course_id = c.id
         WHERE e.student_id = ?"
    );
    $stmt->execute([$studentId]);
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

    // =========================
    // Cập nhật tiến độ
    // =========================
    public function updateProgress($student_id, $course_id, $progress) {
        $sql = "UPDATE enrollments 
                SET progress = ? 
                WHERE student_id = ? AND course_id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$progress, $student_id, $course_id]);
    }
}
