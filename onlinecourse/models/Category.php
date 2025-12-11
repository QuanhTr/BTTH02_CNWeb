<?php
require_once "config/Database.php";

class Category {
    private $conn;
    private $table = "categories";

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function all() {
        $sql = "SELECT * FROM $this->table ORDER BY id DESC";
        return $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($name, $desc) {
        $sql = "INSERT INTO $this->table (name, description) VALUES (:name,:description)";
        $st = $this->conn->prepare($sql);
        return $st->execute([':name'=>$name, ':description'=>$desc]);
    }

    public function find($id) {
        $sql = "SELECT * FROM $this->table WHERE id=:id";
        $st = $this->conn->prepare($sql);
        $st->execute([':id'=>$id]);
        return $st->fetch(PDO::FETCH_ASSOC);
    }

    public function update($id,$name,$desc) {
        $sql = "UPDATE $this->table SET name=:name,description=:description WHERE id=:id";
        $st = $this->conn->prepare($sql);
        return $st->execute([':name'=>$name, ':description'=>$desc, ':id'=>$id]);
    }

    public function delete($id) {
        $sql = "DELETE FROM $this->table WHERE id=:id";
        $st = $this->conn->prepare($sql);
        return $st->execute([':id'=>$id]);
    }

     public function getAllCategories() {
        $sql = "SELECT * FROM $this->table ORDER BY id DESC";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
