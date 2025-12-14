<?php
require_once "models/Course.php";
require_once "models/Enrollment.php";
require_once "models/Category.php";

class InstructorController {

    private $courseModel;
    private $enrollmentModel;
    private $categoryModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        // Chỉ giảng viên
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 1) {
            die("Chỉ giảng viên mới được truy cập!");
        }

        $this->courseModel     = new Course();
        $this->enrollmentModel = new Enrollment();
        $this->categoryModel   = new Category();
    }

    // ================= DASHBOARD =================
    public function dashboard() {
        include "views/instructor/dashboard.php";
    }

    // ================= DANH SÁCH KHÓA HỌC =================
    public function myCourses() {
        $instructorId = $_SESSION['user']['id'];
        $courses = $this->courseModel->getByInstructor($instructorId);
        require "views/instructor/my_courses.php";
    }

    public function list() {
        $instructorId = $_SESSION['user']['id'];
        $courses = $this->courseModel->getByInstructor($instructorId);
        require "views/instructor/list.php";
    }

    // ================= FORM TẠO KHÓA HỌC =================
    public function create() {
        // FIX: Category KHÔNG có getAll() → dùng getAllCategories()
        $categories = $this->categoryModel->getAllCategories();
        require "views/instructor/course/create.php";
    }

    // ================= LƯU KHÓA HỌC =================
    public function store() {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            die("Phương thức không hợp lệ");
        }

        $data = [
            'title'          => trim($_POST['title']),
            'description'    => trim($_POST['description']),
            'price'          => $_POST['price'],
            'duration_weeks' => $_POST['duration_weeks'],
            'level'          => $_POST['level'],
            'category_id'    => $_POST['category_id'],
            'instructor_id'  => $_SESSION['user']['id']
        ];

        if ($data['title'] === '' || $data['price'] === '') {
            die("Vui lòng nhập đầy đủ thông tin");
        }

        $this->courseModel->create($data);

        header("Location: index.php?controller=instructor&action=myCourses");
        exit;
    }

    // ================= FORM SỬA KHÓA HỌC =================
    public function editCourse() {

        if (!isset($_GET['id'])) {
            die("Thiếu ID khóa học");
        }

        $courseId = $_GET['id'];
        $course = $this->courseModel->getById($courseId);

        if (!$course) {
            die("Khóa học không tồn tại");
        }

        // Chỉ sửa khóa học của mình
        if ($course['instructor_id'] != $_SESSION['user']['id']) {
            die("Bạn không có quyền sửa khóa học này");
        }

        $categories = $this->categoryModel->getAllCategories();

        require "views/instructor/course/edit.php";
    }

    // ================= CẬP NHẬT KHÓA HỌC =================
    public function updateCourse() {
        $id = $_GET['id'];

        $data = [
            'title' => $_POST['title'],
            'description' => $_POST['description'],   // ✅ thêm
            'price' => $_POST['price'],
            'duration_weeks' => $_POST['duration_weeks'],
            'level' => $_POST['level'],                 // ✅ thêm
            'category_id' => $_POST['category_id']
        ];

        $this->courseModel->update($id, $data);

        header("Location: index.php?controller=instructor&action=myCourses");
    }


    // ================= XÓA KHÓA HỌC =================
    public function deleteCourse() {

        if (!isset($_GET['id'])) {
            die("Thiếu ID khóa học");
        }

        $courseId = $_GET['id'];

        // Lấy khóa học
        $course = $this->courseModel->getById($courseId);

        if (!$course) {
            die("Khóa học không tồn tại");
        }

        // Chỉ cho xóa khóa học của chính giảng viên
        if ($course['instructor_id'] != $_SESSION['user']['id']) {
            die("Bạn không có quyền xóa khóa học này");
        }

        // Xóa
        $this->courseModel->deleteCourse($courseId);

        header("Location: index.php?controller=instructor&action=myCourses");
        exit;
    }


    // ================= DANH SÁCH HỌC VIÊN =================
    public function students() {
        if (!isset($_GET['course_id'])) {
            die("Thiếu course_id");
        }

        $students = $this->enrollmentModel
            ->getStudentsByCourse($_GET['course_id']);

        require "views/instructor/students/list.php";
    }
}
