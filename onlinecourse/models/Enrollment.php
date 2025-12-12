<?php
class Enrollment {
    private $conn;

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();

    }

    // ============================
    // 1. ĐĂNG KÝ KHÓA HỌC
    // ============================
    public function enroll($student_id, $course_id) {
        $sql = "INSERT INTO enrollments (student_id, course_id, enrolled_at) 
                VALUES (:student_id, :course_id, NOW())";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":student_id", $student_id, PDO::PARAM_INT);
        $stmt->bindValue(":course_id", $course_id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    // ===================================
    // 2. KIỂM TRA ĐÃ ĐĂNG KÝ HAY CHƯA
    // ===================================
    public function isEnrolled($student_id, $course_id) {
        $sql = "SELECT * FROM enrollments 
                WHERE student_id = :student_id AND course_id = :course_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":student_id", $student_id);
        $stmt->bindValue(":course_id", $course_id);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ============================
    // 3. LẤY TẤT CẢ KHÓA HỌC CỦA 1 HỌC VIÊN
    // ============================
    public function getByStudent($student_id) {
        $sql = "SELECT c.*, e.enrolled_at
                FROM enrollments e
                JOIN courses c ON e.course_id = c.id
                WHERE e.student_id = :student_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":student_id", $student_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ==========================================
    // 4. LẤY TẤT CẢ HỌC VIÊN CỦA 1 KHÓA HỌC
    // ==========================================
    public function getStudentsByCourse($course_id) {
        $sql = "SELECT u.*, e.enrolled_at
                FROM enrollments e
                JOIN users u ON e.student_id = u.id
                WHERE e.course_id = :course_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":course_id", $course_id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // =====================================
    // 5. HỦY ĐĂNG KÝ (NẾU CẦN)
    // =====================================
    public function delete($student_id, $course_id) {
        $sql = "DELETE FROM enrollments 
                WHERE student_id = :student_id 
                AND course_id = :course_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":student_id", $student_id);
        $stmt->bindValue(":course_id", $course_id);

        return $stmt->execute();
    }
}
