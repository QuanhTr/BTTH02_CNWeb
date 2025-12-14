<?php
class Material {
    private $conn;
    public function __construct() {
        $this->conn = (new Database())->getConnection();
    }

    public function upload($lessonId, $file) {
        $stmt = $this->conn->prepare(
            "INSERT INTO materials (lesson_id,file_path) VALUES (?,?)"
        );
        return $stmt->execute([$lessonId, $file]);
    }

     // Lấy tài liệu theo bài học
    public function getByLesson($lessonId) {
        $sql = "SELECT * FROM materials WHERE lesson_id = ?";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([$lessonId]);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    // Thêm tài liệu
    public function create($data) {
        $sql = "INSERT INTO materials
                (lesson_id, filename, file_path, file_type)
                VALUES (?, ?, ?, ?)";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([
            $data['lesson_id'],
            $data['filename'],
            $data['file_path'],
            $data['file_type']
        ]);
    }

    // Xóa tài liệu
    public function delete($id) {
        $sql = "DELETE FROM materials WHERE id = ?";
        $stmt = $this->conn->prepare($sql);
        return $stmt->execute([$id]);
    }
}
