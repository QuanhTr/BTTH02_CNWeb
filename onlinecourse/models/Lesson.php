<?php
require_once "config/Database.php";

class Lesson {
    private $conn;
    private $table = "lessons";

    public function __construct() {
        $db = new Database();
        $this->conn = $db->getConnection();
    }

    public function getByCourse($course_id) {
        $stmt = $this->conn->prepare("SELECT * FROM $this->table WHERE course_id=:course_id ORDER BY `order` ASC");
        $stmt->bindValue(':course_id',$course_id);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function create($course_id,$title,$content,$video_url,$order) {
        $sql = "INSERT INTO $this->table (course_id,title,content,video_url,`order`) VALUES (:course_id,:title,:content,:video_url,:order)";
        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(':course_id',$course_id);
        $stmt->bindValue(':title',$title);
        $stmt->bindValue(':content',$content);
        $stmt->bindValue(':video_url',$video_url);
        $stmt->bindValue(':order',$order);
        return $stmt->execute();
    }
}
