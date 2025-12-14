<?php
require_once "config/Database.php";

class Course {

    private $conn;
    private $table = "courses";

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    /* =========================================
        LẤY DANH SÁCH KHÓA HỌC
    ========================================= */

    public function getAll() {
        $sql = "SELECT c.*, u.fullname AS instructor_name
                FROM courses c
                LEFT JOIN users u ON c.instructor_id = u.id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* =========================================
        LẤY KHÓA HỌC THEO ID
    ========================================= */

    public function getById($id) {
        $sql = "SELECT * FROM courses WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* =========================================
        TẠO KHÓA HỌC (GIẢNG VIÊN)
    ========================================= */

    public function create($data) {
        $sql = "INSERT INTO courses 
                (title, description, price, duration_weeks, level, category_id, instructor_id, status)
                VALUES (?,?,?,?,?,?,?,0)";


        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $data['title'],
            $data['description'],
            $data['price'],
            $data['duration_weeks'],
            $data['level'],
            $data['category_id'],
            $data['instructor_id']
        ]);
    }

    /* =========================================
        CẬP NHẬT KHÓA HỌC (GIẢNG VIÊN)
    ========================================= */

    public function update($id, $data) {
        $sql = "UPDATE courses 
                SET title = ?,
                    description = ?,
                    price = ?,
                    category_id = ?,
                    duration_weeks = ?,
                    level = ?
                WHERE id = ?";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            $data['title'],
            $data['description'],
            $data['price'],
            $data['category_id'],
            $data['duration_weeks'],
            $data['level'],
            $id
        ]);
    }

    /* =========================================
        XÓA KHÓA HỌC
    ========================================= */

    public function delete($id) {
        $sql = "DELETE FROM courses WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    /* =========================================
        KHÓA HỌC CỦA GIẢNG VIÊN
    ========================================= */

    public function getByInstructor($instructorId) {
        $sql = "SELECT * FROM courses WHERE instructor_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$instructorId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* =========================================
        DUYỆT KHÓA HỌC (ADMIN)
    ========================================= */

    public function getPending() {
        $sql = "SELECT * FROM courses WHERE status = 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($id, $status) {
        $sql = "UPDATE courses SET status = ? WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$status, $id]);
    }

    public function deleteCourse($id) {
        $sql = "DELETE FROM courses WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }

    /* =========================================
        THỐNG KÊ (ADMIN)
    ========================================= */

    public function countCourses() {
        $sql = "SELECT COUNT(*) FROM courses";
        return $this->conn->query($sql)->fetchColumn();
    }

    public function countPendingCourses() {
        $sql = "SELECT COUNT(*) FROM courses WHERE status = 0";
        return $this->conn->query($sql)->fetchColumn();
    }

    public function countByCategory($categoryId) {
        $sql = "SELECT COUNT(*) FROM courses WHERE category_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$categoryId]);
        return $stmt->fetchColumn();
    }

}
