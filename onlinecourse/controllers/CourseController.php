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
        $courses = $this->courseModel->getAll();
        include "views/courses/index.php";
    }

    // GIẢNG VIÊN - TẠO KHÓA HỌC
public function create() {
    if ($_SESSION['user']['role'] != 1) die("Không có quyền");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $data = [
            'title' => $_POST['title'],
            'description' => $_POST['description'],
            'price' => $_POST['price'],
            'duration_weeks' => $_POST['duration_weeks'],
            'level' => $_POST['level'],
            'category_id' => $_POST['category_id'],
            'instructor_id' => $_SESSION['user']['id']
        ];
        $this->courseModel->create($data);
        header("Location: index.php?controller=instructor&action=myCourses");
        exit;
    }

    include "views/instructor/course/create.php";
}

// SỬA KHÓA HỌC
public function edit() {
    $id = $_GET['id'];
    $course = $this->courseModel->getById($id);

    if ($_SESSION['user']['id'] != $course['instructor_id']) die("Không có quyền");

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $this->courseModel->update($id, $_POST);
        header("Location: index.php?controller=instructor&action=myCourses");
        exit;
    }

    include "views/instructor/course/edit.php";
}

// XÓA KHÓA HỌC
public function delete() {
    $id = $_GET['id'];
    $this->courseModel->deleteCourse($id);
    header("Location: index.php?controller=instructor&action=myCourses");
}


    // Chi tiết khóa học
    public function detail() {
        $id = $_GET['id'];
        $course = $this->courseModel->getById($id);
        include "views/courses/detail.php";
    }
}
