<?php
require_once "config/Database.php";

class Course {
    private $conn;
    private $table = "courses";

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getAll() {
        $stmt = $this->conn->prepare("SELECT c.*, u.fullname as instructor_name FROM $this->table c LEFT JOIN users u ON c.instructor_id = u.id");
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function getById($id) {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE id=:id");
        $stmt->bindValue(':id',$id);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function create($title,$description,$instructor_id,$category_id,$price,$duration_weeks,$level) {
        $sql = "INSERT INTO $this->table (title,description,instructor_id,category_id,price,duration_weeks,level) VALUES (:title,:description,:instructor_id,:category_id,:price,:duration_weeks,:level)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':title',$title);
        $stmt->bindValue(':description',$description);
        $stmt->bindValue(':instructor_id',$instructor_id);
        $stmt->bindValue(':category_id',$category_id);
        $stmt->bindValue(':price',$price);
        $stmt->bindValue(':duration_weeks',$duration_weeks);
        $stmt->bindValue(':level',$level);
        return $stmt->execute();
    }

    public function update($id,$title,$description,$category_id,$price,$duration_weeks,$level) {
        $sql = "UPDATE $this->table SET title=:title,description=:description,category_id=:category_id,price=:price,duration_weeks=:duration_weeks,level=:level WHERE id=:id";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':title',$title);
        $stmt->bindValue(':description',$description);
        $stmt->bindValue(':category_id',$category_id);
        $stmt->bindValue(':price',$price);
        $stmt->bindValue(':duration_weeks',$duration_weeks);
        $stmt->bindValue(':level',$level);
        $stmt->bindValue(':id',$id);
        return $stmt->execute();
    }

    public function delete($id) {
        $stmt = $this->conn->prepare("DELETE FROM $this->table WHERE id=:id");
        $stmt->bindValue(':id',$id);
        return $stmt->execute();
    }
}
