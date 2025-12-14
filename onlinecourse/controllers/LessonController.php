<?php
require_once "models/Lesson.php";
require_once "models/Course.php";
require_once "models/Material.php";

class LessonController {

    private $lessonModel;
    private $courseModel;
    private $materialModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Chỉ giảng viên mới được thao tác
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
            die("Bạn không có quyền truy cập");
        }

        $this->lessonModel   = new Lesson();
        $this->courseModel   = new Course();
        $this->materialModel = new Material();
    }

    // =============================
    // DANH SÁCH BÀI HỌC THEO KHÓA
    // =============================
    public function manage() {
        if (!isset($_GET['course_id'])) {
            die("Thiếu course_id");
        }

        $courseId = $_GET['course_id'];

        // Kiểm tra khóa học thuộc giảng viên
        $course = $this->courseModel->getById($courseId);
        if (!$course || $course['instructor_id'] != $_SESSION['user']['id']) {
            die("Bạn không có quyền quản lý khóa học này");
        }

        $lessons = $this->lessonModel->getByCourse($courseId);

        require "views/instructor/lessons/manage.php";
    }

    // =============================
    // FORM THÊM BÀI HỌC
    // =============================
    public function create() {
        if (!isset($_GET['course_id'])) {
            die("Thiếu course_id");
        }

        $courseId = $_GET['course_id'];
        require "views/instructor/lessons/create.php";
    }

    // =============================
    // LƯU BÀI HỌC
    // =============================
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die("Phương thức không hợp lệ");
        }

        // Lấy dữ liệu từ form
        $course_id = $_POST['course_id'];
        $title     = $_POST['title'];
        $content   = $_POST['content'];
        $video_url = $_POST['video_url'];
        $order     = $_POST['order'];

        // Gọi create với 5 tham số riêng lẻ
        $this->lessonModel->create($course_id, $title, $content, $video_url, $order);

        header("Location: index.php?controller=lesson&action=manage&course_id=".$course_id);
        exit;
    }

    // =============================
    // FORM SỬA BÀI HỌC
    // =============================
    public function edit() {
        if (!isset($_GET['id'])) {
            die("Thiếu ID bài học");
        }

        $lesson = $this->lessonModel->getById($_GET['id']);
        if (!$lesson) die("Bài học không tồn tại");

        require "views/instructor/lessons/edit.php";
    }

    // =============================
    // CẬP NHẬT BÀI HỌC
    // =============================
    public function update() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die("Phương thức không hợp lệ");
        }

        $id        = $_GET['id'];
        $course_id = $_POST['course_id'];

        $title     = $_POST['title'];
        $content   = $_POST['content'];
        $video_url = $_POST['video_url'];
        $order     = $_POST['order'];

        $this->lessonModel->update($id, $title, $content, $video_url, $order);

        header("Location: index.php?controller=lesson&action=manage&course_id=".$course_id);
        exit;
    }

    // =============================
    // XÓA BÀI HỌC
    // =============================
    public function delete() {
        if (!isset($_GET['id'])) {
            die("Thiếu ID bài học");
        }

        $lesson = $this->lessonModel->getById($_GET['id']);
        if (!$lesson) die("Bài học không tồn tại");

        $this->lessonModel->delete($_GET['id']);

        header("Location: index.php?controller=lesson&action=manage&course_id=".$lesson['course_id']);
        exit;
    }

    // =============================
    // CHI TIẾT BÀI HỌC + TÀI LIỆU
    // =============================
    public function detail() {
        if (!isset($_GET['id'])) die("Thiếu lesson_id");

        $lesson    = $this->lessonModel->getById($_GET['id']);
        $materials = $this->materialModel->getByLesson($_GET['id']);

        require "views/instructor/lessons/detail.php";
    }

    // =============================
    // UPLOAD TÀI LIỆU
    // =============================
    public function uploadMaterial() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') return;

        $lessonId = $_POST['lesson_id'];
        $file     = $_FILES['file'];

        $filename = $file['name'];
        $tmp      = $file['tmp_name'];
        $ext      = pathinfo($filename, PATHINFO_EXTENSION);

        $path = "uploads/materials/" . time() . "_" . $filename;
        move_uploaded_file($tmp, $path);

        $this->materialModel->create([
            'lesson_id' => $lessonId,
            'filename'  => $filename,
            'file_path' => $path,
            'file_type' => $ext
        ]);

        header("Location: index.php?controller=lesson&action=detail&id=".$lessonId);
        exit;
    }
}
