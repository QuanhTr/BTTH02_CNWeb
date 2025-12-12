<?php
require_once "config/Database.php";

class Lesson {
    private $conn;
    private $table = "lessons";

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }
    public function find($id) {
    $sql = "SELECT * FROM lessons WHERE id = :id";
    $stmt = $this->conn->prepare($sql);
    $stmt->bindValue(":id", $id, PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}


    /* ===============================
        LẤY DANH SÁCH BÀI HỌC THEO KHÓA HỌC
    ================================== */
    public function getByCourse($course_id) {
        $sql = "SELECT * FROM {$this->table} 
                WHERE course_id = :course_id 
                ORDER BY lesson_order ASC";   // đổi tên cột tránh conflict ORDER

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':course_id', $course_id);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* ===============================
        TẠO BÀI HỌC MỚI
    ================================== */
    public function create($course_id, $title, $content, $video_url, $order) {
        $sql = "INSERT INTO {$this->table} 
                (course_id, title, content, video_url, lesson_order) 
                VALUES (:course_id, :title, :content, :video_url, :lesson_order)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(':course_id', $course_id);
        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':content', $content);
        $stmt->bindValue(':video_url', $video_url);
        $stmt->bindValue(':lesson_order', $order);

        return $stmt->execute();
    }

    /* ===============================
        LẤY 1 BÀI HỌC THEO ID
    ================================== */
    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM {$this->table} WHERE id = :id");
        $stmt->bindValue(':id', $id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    /* ===============================
        CẬP NHẬT BÀI HỌC
    ================================== */
    public function update($id, $title, $content, $video_url, $order) {
        $sql = "UPDATE {$this->table} 
                SET title = :title, 
                    content = :content, 
                    video_url = :video_url, 
                    lesson_order = :lesson_order 
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(':title', $title);
        $stmt->bindValue(':content', $content);
        $stmt->bindValue(':video_url', $video_url);
        $stmt->bindValue(':lesson_order', $order);
        $stmt->bindValue(':id', $id);

        return $stmt->execute();
    }

    /* ===============================
        XÓA BÀI HỌC
    ================================== */
    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM {$this->table} WHERE id = :id");
        $stmt->bindValue(':id', $id);
        return $stmt->execute();
    }
}
