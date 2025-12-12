<?php
require_once "config/Database.php";

class Course {
    private $conn;
    private $table = "courses";

    public function __construct() {
        $db = new Database();
        // SỬA LỖI: phương thức đúng là connect()
        $this->conn = $db->getConnection();
    }

    /* --------------------------------
        LẤY DANH SÁCH KHÓA HỌC
    -------------------------------- */
    /**
 * Lấy danh sách khóa học — robust: thử JOIN users/categories,
 * nếu query lỗi (ví dụ column không tồn tại) sẽ fallback về SELECT * FROM courses
 */
public function getAll() {
    // Query ưu tiên (có join instructor + category)
    $sql = "SELECT c.*, u.fullname AS instructor_name, cat.name AS category_name
            FROM {$this->table} c
            LEFT JOIN users u ON c.instructor_id = u.id
            LEFT JOIN categories cat ON c.category_id = cat.id
            ORDER BY c.id DESC";

    try {
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Nếu query trả về false hoặc null (nguy cơ lỗi), fallback
        if ($rows === false) {
            throw new Exception('Query returned false');
        }

        return $rows;
    } catch (Exception $e) {
        // Ghi log lỗi để debug (bạn có thể đổi thành error_log())
        // Nếu PDOStatement tồn tại, show errorInfo cho debug
        if (isset($stmt) && $stmt instanceof PDOStatement) {
            $err = $stmt->errorInfo();
            error_log('Course::getAll() SQL error: ' . print_r($err, true));
        } else {
            error_log('Course::getAll() Exception: ' . $e->getMessage());
        }

        // Fallback: trả về dữ liệu cơ bản không join — tránh crash app
        try {
            $fallbackSql = "SELECT * FROM {$this->table} ORDER BY id DESC";
            $stmt2 = $this->conn->prepare($fallbackSql);
            $stmt2->execute();
            return $stmt2->fetchAll(PDO::FETCH_ASSOC);
        } catch (Exception $e2) {
            // Nếu vẫn lỗi, log và trả về mảng rỗng
            error_log('Course::getAll() fallback error: ' . $e2->getMessage());
            return [];
        }
    }
}


    /* --------------------------------
        LẤY KHÓA HỌC THEO ID
    -------------------------------- */
    public function getById($id) {
        $sql = "SELECT * FROM {$this->table} WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
    }
   public function searchCourses($keyword, $category_id, $price) {
    $sql = "SELECT c.*, u.fullname AS instructor_name, cat.name AS category_name
            FROM courses c
            LEFT JOIN users u ON c.instructor_id = u.id
            LEFT JOIN categories cat ON c.category_id = cat.id
            WHERE 1=1";

    $params = [];

    // Tìm theo tên khóa học
    if (!empty($keyword)) {
        $sql .= " AND c.title LIKE :keyword";
        $params[':keyword'] = "%" . $keyword . "%";
    }

    // Lọc danh mục
    if (!empty($category_id)) {
        $sql .= " AND c.category_id = :category_id";
        $params[':category_id'] = $category_id;
    }

    // Lọc giá
    if ($price === "free") {
        $sql .= " AND c.price = 0";
    } elseif ($price === "paid") {
        $sql .= " AND c.price > 0";
    }

    $stmt = $this->conn->prepare($sql);

    // Bind tất cả param có trong mảng
    foreach ($params as $key => $value) {
        $stmt->bindValue($key, $value);
    }

    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

public function find($id) {
    return $this->getById($id);
}


    /* --------------------------------
        TẠO KHÓA HỌC MỚI
    -------------------------------- */
    public function create($title, $description, $instructor_id, $category_id, $price, $duration_weeks, $level) {
        $sql = "INSERT INTO {$this->table} 
                (title, description, instructor_id, category_id, price, duration_weeks, level) 
                VALUES 
                (:title, :description, :instructor_id, :category_id, :price, :duration_weeks, :level)";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":title", $title);
        $stmt->bindValue(":description", $description);
        $stmt->bindValue(":instructor_id", $instructor_id, PDO::PARAM_INT);
        $stmt->bindValue(":category_id", $category_id, PDO::PARAM_INT);
        $stmt->bindValue(":price", $price);
        $stmt->bindValue(":duration_weeks", $duration_weeks, PDO::PARAM_INT);
        $stmt->bindValue(":level", $level);

        return $stmt->execute();
    }

    /* --------------------------------
        CẬP NHẬT KHÓA HỌC
    -------------------------------- */
    public function update($id, $title, $description, $category_id, $price, $duration_weeks, $level) {
        $sql = "UPDATE {$this->table} SET 
                    title = :title,
                    description = :description,
                    category_id = :category_id,
                    price = :price,
                    duration_weeks = :duration_weeks,
                    level = :level
                WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        $stmt->bindValue(":title", $title);
        $stmt->bindValue(":description", $description);
        $stmt->bindValue(":category_id", $category_id, PDO::PARAM_INT);
        $stmt->bindValue(":price", $price);
        $stmt->bindValue(":duration_weeks", $duration_weeks, PDO::PARAM_INT);
        $stmt->bindValue(":level", $level);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /* --------------------------------
        XÓA KHÓA HỌC
    -------------------------------- */
    public function delete($id) {
        $sql = "DELETE FROM {$this->table} WHERE id = :id";

        $stmt = $this->conn->prepare($sql);
        $stmt->bindValue(":id", $id, PDO::PARAM_INT);

        return $stmt->execute();
    }

    /* --------------------------------
        KHÓA HỌC CHỜ DUYỆT
    -------------------------------- */
    public function getPending() {
        $sql = "SELECT * FROM {$this->table} WHERE status = 0";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute();

        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public function updateStatus($id, $status) {
        $sql = "UPDATE {$this->table} SET status = :status WHERE id = :id";

        $stmt = $this->conn->prepare($sql);

        return $stmt->execute([
            ":status" => $status,
            ":id" => $id
        ]);
    }

    public function deleteCourse($id) {
        return $this->delete($id);
    }

    /* --------------------------------
            THỐNG KÊ
    -------------------------------- */
    public function countCourses() {
        $sql = "SELECT COUNT(*) AS total FROM {$this->table}";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)["total"];
    }

    public function countActiveCourses() {
        $sql = "SELECT COUNT(*) AS total FROM {$this->table} WHERE status = 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)["total"];
    }

    public function countInactiveCourses() {
        $sql = "SELECT COUNT(*) AS total FROM {$this->table} WHERE status = 2";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)["total"];
    }

    public function countPendingCourses() {
        $sql = "SELECT COUNT(*) AS total FROM {$this->table} WHERE status = 0";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC)["total"];
    }
}
