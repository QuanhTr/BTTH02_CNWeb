<?php
require_once "config/Database.php";

class Admin {
    private $conn;

    public function __construct() {
        $this->conn = Database::connect();
    }

    /* -------------------------
        QUẢN LÝ NGƯỜI DÙNG
    --------------------------*/
    public function getAllUsers() {
        $stmt = $this->conn->query("SELECT * FROM users ORDER BY id DESC");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function toggleUserActive($id) {
        $stmt = $this->conn->prepare("UPDATE users SET active = NOT active WHERE id = ?");
        return $stmt->execute([$id]);
    }

    /* -------------------------
        QUẢN LÝ DANH MỤC
    --------------------------*/
    public function getAllCategories() {
        return $this->conn->query("SELECT * FROM categories")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function addCategory($name) {
        $stmt = $this->conn->prepare("INSERT INTO categories(name) VALUES (?)");
        return $stmt->execute([$name]);
    }

    public function deleteCategory($id) {
        $stmt = $this->conn->prepare("DELETE FROM categories WHERE id = ?");
        return $stmt->execute([$id]);
    }

    /* -------------------------
        DUYỆT KHÓA HỌC
    --------------------------*/
    public function getPendingCourses() {
        return $this->conn->query("SELECT * FROM courses WHERE approved = 0")->fetchAll(PDO::FETCH_ASSOC);
    }

    public function approveCourse($id) {
        $stmt = $this->conn->prepare("UPDATE courses SET approved = 1 WHERE id = ?");
        return $stmt->execute([$id]);
    }

    public function rejectCourse($id) {
        $stmt = $this->conn->prepare("DELETE FROM courses WHERE id = ?");
        return $stmt->execute([$id]);
    }

    /* -------------------------
        THỐNG KÊ
    --------------------------*/
    public function getStatistics() {
        return [
            "users"       => $this->conn->query("SELECT COUNT(*) FROM users")->fetchColumn(),
            "courses"     => $this->conn->query("SELECT COUNT(*) FROM courses")->fetchColumn(),
            "categories"  => $this->conn->query("SELECT COUNT(*) FROM categories")->fetchColumn(),
            "enrollment"  => $this->conn->query("SELECT COUNT(*) FROM enrollments")->fetchColumn(),
        ];
    }
}
