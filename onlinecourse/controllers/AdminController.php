<?php
require_once "models/User.php";
require_once "models/Category.php";
require_once "models/Course.php";
require_once "core/Auth.php";

class AdminController {

    private $userModel;
    private $categoryModel;
    private $courseModel;

    public function __construct() {
        Auth::requireRole([2]); // Role 2 = Admin
        $this->userModel = new User();
        $this->categoryModel = new Category();
        $this->courseModel = new Course();
    }

    // ----------------------------------------------------------------
    // 1. DASHBOARD
    // ----------------------------------------------------------------
    public function dashboard() {
        $totalUsers = $this->userModel->countAllUsers();
        $totalActive = $this->userModel->countActiveUsers();
        $totalInactive = $this->userModel->countInactiveUsers();

        $totalCourses = $this->courseModel->countCourses();
        $pendingCourses = $this->courseModel->countPendingCourses();

        include "views/admin/dashboard.php";
    }

    // ----------------------------------------------------------------
    // 2. QUẢN LÝ NGƯỜI DÙNG
    // ----------------------------------------------------------------

    public function users() {
        $users = $this->userModel->getAllUsers();
        include "views/admin/users/manage.php";
    }

    public function changeRole() {
        if (!isset($_POST['id']) || !isset($_POST['role'])) {
            die("Thiếu dữ liệu role đổi.");
        }

        $this->userModel->updateRole($_POST['id'], $_POST['role']);
        header("Location: index.php?controller=admin&action=users");
        exit;
    }

    public function toggleActive() {
        if (!isset($_POST['id'])) {
            die("Thiếu ID user.");
        }

        $this->userModel->toggleActive($_POST['id']);
        header("Location: index.php?controller=admin&action=users");
        exit;
    }

    public function userDetail() {
        if (!isset($_GET['id'])) {
            die("Thiếu ID user.");
        }

        $user = $this->userModel->getUserById($_GET['id']);
        include "views/admin/users/detail.php";
    }


    // ----------------------------------------------------------------
    // 3. QUẢN LÝ DANH MỤC KHÓA HỌC
    // ----------------------------------------------------------------

    public function categories() {
        $categories = $this->categoryModel->getAll();
        include "views/admin/category/manage.php";
    }

    public function addCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);
            $this->categoryModel->add($name);
            header("Location: index.php?controller=admin&action=categories");
            exit;
        }
        include "views/admin/category/add.php";
    }

    public function editCategory() {
        if (!isset($_GET['id'])) die("Thiếu ID category");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->categoryModel->update($_GET['id'], $_POST['name']);
            header("Location: index.php?controller=admin&action=categories");
            exit;
        }

        $cat = $this->categoryModel->getById($_GET['id']);
        include "views/admin/category/edit.php";
    }

    public function deleteCategory() {
        if (!isset($_GET['id'])) die("Thiếu ID category");
        $this->categoryModel->delete($_GET['id']);

        header("Location: index.php?controller=admin&action=categories");
        exit;
    }


    // ----------------------------------------------------------------
    // 4. DUYỆT KHÓA HỌC
    // ----------------------------------------------------------------

    public function pendingCourses() {
        $courses = $this->courseModel->getPending(); // status = 0
        include "views/admin/courses/pending.php";
    }

    public function approveCourse() {
        if (!isset($_GET['id'])) die("Thiếu ID khóa học");

        $this->courseModel->updateStatus($_GET['id'], 1); // 1 = Approved
        header("Location: index.php?controller=admin&action=pendingCourses");
        exit;
    }

    public function rejectCourse() {
        if (!isset($_GET['id'])) die("Thiếu ID khóa học");

        $this->courseModel->updateStatus($_GET['id'], -1); // -1 = Rejected
        header("Location: index.php?controller=admin&action=pendingCourses");
        exit;
    }

}
