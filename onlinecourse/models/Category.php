<?php
require_once "config/Database.php";

class Category {
    private $conn;
    private $table = "categories";

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }
    public function countCategories() {
        $stmt = $this->conn->prepare("SELECT COUNT(*) FROM categories");
        $stmt->execute();
        return $stmt->fetchColumn();
    }


    // ✅ LẤY TẤT CẢ DANH MỤC
    public function getAll() {
        $sql = "SELECT * FROM categories ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // ======================
    // KIỂM TRA TỒN TẠI
    // ======================
    public function exists($name) {
        $stmt = $this->conn->prepare(
            "SELECT id FROM {$this->table} WHERE name = ?"
        );
        $stmt->execute([$name]);
        return $stmt->fetch() ? true : false;
    }

    // ======================
    // THÊM
    // ======================
    public function add($name) {
        $stmt = $this->conn->prepare(
            "INSERT INTO {$this->table} (name) VALUES (?)"
        );
        return $stmt->execute([$name]);
    }

    // ======================
    // LẤY THEO ID
    // ======================
    public function getById($id) {
        $stmt = $this->conn->prepare(
            "SELECT * FROM {$this->table} WHERE id = ?"
        );
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    // ======================
    // CẬP NHẬT
    // ======================
    public function update($id, $name) {
        $stmt = $this->conn->prepare(
            "UPDATE {$this->table} SET name = ? WHERE id = ?"
        );
        return $stmt->execute([$name, $id]);
    }

    // ======================
    // XÓA
    // ======================
    public function delete($id) {
        $stmt = $this->conn->prepare(
            "DELETE FROM {$this->table} WHERE id = ?"
        );
        return $stmt->execute([$id]);
    }

     public function getAllCategories() {
        $sql = "SELECT * FROM $this->table ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

}
