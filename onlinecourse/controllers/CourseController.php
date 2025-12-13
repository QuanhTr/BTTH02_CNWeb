<?php
require_once "models/Course.php";
require_once "models/User.php";
require_once "models/Category.php";

class CourseController {
    private $courseModel;
    private $userModel;
    private $categoryModel;

    public function __construct() {
        $this->courseModel = new Course();
        $this->userModel = new User();
        $this->categoryModel = new Category();
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
    }

    // Danh sách khóa học
    public function index() {
        $keyword = $_GET['keyword'] ?? '';
        $cat     = $_GET['category'] ?? null;

        $courses = $this->courseModel->getApproved($keyword, $cat);
        require "views/courses/index.php";
    }

    // Tạo khóa học
    public function create() {
        if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 1){
            echo "Chỉ giảng viên mới có quyền!";
            exit;
        }

        $categories = (new Category())->getAll();
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $category_id = $_POST['category_id'];
            $price = $_POST['price'];
            $duration_weeks = $_POST['duration_weeks'];
            $level = $_POST['level'];
            $instructor_id = $_SESSION['user_id'];

            $this->courseModel->create($title,$description,$instructor_id,$category_id,$price,$duration_weeks,$level);
            header("Location:index.php?controller=course&action=index");
            exit;
        }

        include "views/courses/create.php";
    }

    // Edit khóa học
    public function edit() {
        if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 1){
            echo "Chỉ giảng viên mới có quyền!";
            exit;
        }

        $id = $_GET['id'];
        $course = $this->courseModel->getById($id);
        $categories = (new Category())->getAll();

        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $description = $_POST['description'];
            $category_id = $_POST['category_id'];
            $price = $_POST['price'];
            $duration_weeks = $_POST['duration_weeks'];
            $level = $_POST['level'];
            $this->courseModel->update($id,$title,$description,$category_id,$price,$duration_weeks,$level);
            header("Location:index.php?controller=course&action=index");
            exit;
        }

        include "views/courses/edit.php";
    }

    // Delete khóa học
    public function delete() {
        if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 1){
            echo "Chỉ giảng viên mới có quyền!";
            exit;
        }
        $id = $_GET['id'];
        $this->courseModel->delete($id);
        header("Location:index.php?controller=course&action=index");
        exit;
    }

    // Chi tiết khóa học
    public function detail() {
    if (empty($_GET['id'])) {
        die("Thiếu ID khóa học");
    }

    $courseModel = new Course();
    $course = $courseModel->getByIdWithDetail($_GET['id']);

    if (!$course) {
        die("Khóa học không tồn tại");
    }

    require "views/courses/detail.php";
}

}
