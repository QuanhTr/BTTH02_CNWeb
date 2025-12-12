<?php
require_once "models/Lesson.php";
require_once "models/Course.php";

class LessonController {
    private $lessonModel;
    private $courseModel;

    public function __construct() {
        $this->lessonModel = new Lesson();
        $this->courseModel = new Course();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // =========================
    // 1. DANH SÁCH BÀI HỌC
    // =========================
    public function index() {
        if (!isset($_GET['course_id'])) {
            echo "Thiếu course_id!";
            exit;
        }

        $course_id = $_GET['course_id'];

        // Kiểm tra khóa học có tồn tại không
        $course = $this->courseModel->find($course_id);
        if (!$course) {
            echo "Khóa học không tồn tại!";
            exit;
        }

        $lessons = $this->lessonModel->getByCourse($course_id);
        include "views/lessons/index.php";
    }

    // =========================
    // 2. TẠO BÀI HỌC
    // =========================
    public function create() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
            echo "Chỉ giảng viên mới có quyền tạo bài học!";
            exit;
        }

        if (!isset($_GET['course_id'])) {
            echo "Thiếu course_id!";
            exit;
        }

        $course_id = $_GET['course_id'];

        // Kiểm tra khóa học có tồn tại không
        $course = $this->courseModel->find($course_id);
        if (!$course) {
            echo "Khóa học không tồn tại!";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Lấy dữ liệu
            $title = trim($_POST['title']);
            $content = trim($_POST['content']);
            $video_url = trim($_POST['video_url']);
            $order = intval($_POST['order']);

            // Validate
            if ($title == "") {
                echo "Tiêu đề không được để trống!";
                exit;
            }

            $this->lessonModel->create($course_id, $title, $content, $video_url, $order);

            header("Location:index.php?controller=lesson&action=index&course_id=$course_id");
            exit;
        }

        include "views/lessons/create.php";
    }

    // =========================
    // 3. SỬA BÀI HỌC
    // =========================
    public function edit() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
            echo "Chỉ giảng viên mới có quyền sửa bài học!";
            exit;
        }

        if (!isset($_GET['id'])) {
            echo "Thiếu lesson_id!";
            exit;
        }

        $lesson_id = $_GET['id'];

        // Lấy bài học cũ
        $lesson = $this->lessonModel->find($lesson_id);
        if (!$lesson) {
            echo "Bài học không tồn tại!";
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $title = trim($_POST['title']);
            $content = trim($_POST['content']);
            $video_url = trim($_POST['video_url']);
            $order = intval($_POST['order']);

            $this->lessonModel->update($lesson_id, $title, $content, $video_url, $order);

            header("Location:index.php?controller=lesson&action=index&course_id=" . $lesson['course_id']);
            exit;
        }

        include "views/lessons/edit.php";
    }

    // =========================
    // 4. XÓA BÀI HỌC
    // =========================
    public function delete() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
            echo "Chỉ giảng viên mới có quyền xóa bài học!";
            exit;
        }

        if (!isset($_GET['id'])) {
            echo "Thiếu lesson_id!";
            exit;
        }

        $lesson_id = $_GET['id'];

        $lesson = $this->lessonModel->find($lesson_id);
        if (!$lesson) {
            echo "Bài học không tồn tại!";
            exit;
        }

        $this->lessonModel->delete($lesson_id);

        header("Location:index.php?controller=lesson&action=index&course_id=" . $lesson['course_id']);
        exit;
    }
}
