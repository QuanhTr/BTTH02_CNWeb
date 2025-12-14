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
    // Lấy bài học theo ID
    public function getById($id) {
        $sql = "SELECT * FROM lessons WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$id]);
        return $stmt->fetch(PDO::FETCH_ASSOC);
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

    // Cập nhật bài học
    public function update($id, $data) {
        $sql = "UPDATE lessons
                SET title=?, content=?, video_url=?, `order`=?
                WHERE id=?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['title'],
            $data['content'],
            $data['video_url'],
            $data['order'],
            $id
        ]);
    }

    // Xóa bài học
    public function delete($id) {
        $sql = "DELETE FROM lessons WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
