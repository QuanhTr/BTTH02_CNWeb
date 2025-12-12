<?php
require_once "models/Course.php";
require_once "models/User.php";
require_once "models/Category.php";
require_once "models/Lesson.php";

class CourseController {
    private $courseModel;
    private $userModel;
    private $categoryModel;
    private $lessonModel;

    public function __construct() {
        $this->courseModel = new Course();
        $this->userModel = new User();
        $this->categoryModel = new Category();
        $this->lessonModel = new Lesson();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    /* ============================
        DANH SÁCH KHÓA HỌC
    ============================= */
    public function index() {
        $courses = $this->courseModel->getAll();
        include "views/courses/index.php";
    }

    /* ============================
        TẠO KHÓA HỌC
    ============================= */
    public function create() {
        // ROLE 1 = Instructor
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
            die("Chỉ giảng viên mới có quyền!");
        }

        $categories = $this->categoryModel->getAll();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $category_id = $_POST['category_id'];
            $price = $_POST['price'];
            $duration_weeks = $_POST['duration_weeks'];
            $level = $_POST['level'];
            $instructor_id = $_SESSION['user_id'];

            $this->courseModel->create(
                $title, 
                $description, 
                $instructor_id,
                $category_id,
                $price,
                $duration_weeks,
                $level
            );

            header("Location: index.php?controller=course&action=index");
            exit;
        }

        include "views/instructor/course/create.php";
    }

    /* ============================
        SỬA KHÓA HỌC
    ============================= */
    public function edit() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
            die("Chỉ giảng viên mới có quyền!");
        }

        if (!isset($_GET['id'])) die("Thiếu ID");

        $id = $_GET['id'];
        $course = $this->courseModel->getById($id);
        $categories = $this->categoryModel->getAll();

        if (!$course) die("Khóa học không tồn tại!");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $category_id = $_POST['category_id'];
            $price = $_POST['price'];
            $duration_weeks = $_POST['duration_weeks'];
            $level = $_POST['level'];

            $this->courseModel->update(
                $id, 
                $title, 
                $description, 
                $category_id, 
                $price, 
                $duration_weeks, 
                $level
            );

            header("Location: index.php?controller=course&action=index");
            exit;
        }

        include "views/instructor/course/edit.php";
    }
    public function search() {
    // Lấy danh sách danh mục để hiển thị filter
    $categories = $this->categoryModel->getAll();

    // Lấy dữ liệu tìm kiếm từ GET
    $keyword = $_GET['keyword'] ?? '';
    $category_id = $_GET['category_id'] ?? '';
    $price = $_GET['price'] ?? '';

    // Gọi model xử lý tìm kiếm
    $courses = $this->courseModel->searchCourses($keyword, $category_id, $price);

    // Gọi view
    require_once "views/courses/search.php";
}


    /* ============================
        XÓA KHÓA HỌC
    ============================= */
    public function delete() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 1) {
            die("Chỉ giảng viên mới có quyền!");
        }

        if (!isset($_GET['id'])) die("Thiếu ID");

        $id = $_GET['id'];
        $this->courseModel->delete($id);

        header("Location: index.php?controller=course&action=index");
        exit;
    }

    /* ============================
        XEM CHI TIẾT KHÓA HỌC + DANH SÁCH BÀI HỌC
    ============================= */
    public function detail() {
        if (!isset($_GET['id'])) die("Thiếu ID");

        $id = $_GET['id'];
        $course = $this->courseModel->getById($id);

        if (!$course) die("Không tìm thấy khóa học!");

        $lessons = $this->lessonModel->getByCourse($id);

        include "views/courses/detail.php";
    }
}
