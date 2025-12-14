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
        Auth::requireRole([2]); // Role 2 = Admin only
        $this->userModel = new User();
        $this->categoryModel = new Category();
        $this->courseModel = new Course();
    }

    // ============================================================
    // 1. DASHBOARD
    // ============================================================
    public function dashboard() {
        $userCount      = $this->userModel->countAllUsers(); 
        $totalUsers     = $this->userModel->countAllUsers();
        $totalActive    = $this->userModel->countActiveUsers();
        $totalInactive  = $this->userModel->countInactiveUsers();
        
        $categoryCount = $this->categoryModel->countCategories();
        $courseCount    = $this->courseModel->countCourses();  
        $totalCourses   = $this->courseModel->countCourses();
        $pendingCourses = $this->courseModel->countPendingCourses();

        include "views/admin/dashboard.php";
    }

    // ============================================================
    // 2. QUẢN LÝ NGƯỜI DÙNG
    // ============================================================
    public function users() {
        $users = $this->userModel->getAllUsers();
        include "views/admin/users/manage.php";
    }

    public function changeRole() {
        if (empty($_POST['id']) || empty($_POST['role'])) {
            die("Thiếu dữ liệu đổi vai trò.");
        }

        $allowedRoles = [0, 1, 2];
        if (!in_array($_POST['role'], $allowedRoles)) {
            die("Giá trị role không hợp lệ!");
        }

        $user = $this->userModel->getUserById($_POST['id']);
        if (!$user) {
            die("User không tồn tại.");
        }

        $this->userModel->updateRole($_POST['id'], $_POST['role']);
        header("Location: index.php?controller=admin&action=users");
        exit;
    }

    public function toggleUser() {
        if (!isset($_GET['id'])) return;

        require_once "models/User.php";
        $userModel = new User();
        $userModel->toggleActive($_GET['id']);

        header("Location: index.php?controller=admin&action=users");
        exit;
    }


    public function toggleActive() {
        if (empty($_POST['id'])) {
            die("Thiếu ID user.");
        }

        $user = $this->userModel->getUserById($_POST['id']);
        if (!$user) {
            die("User không tồn tại.");
        }

        $this->userModel->toggleActive($_POST['id']);
        header("Location: index.php?controller=admin&action=users");
        exit;
    }

    public function userDetail() {
        if (empty($_GET['id'])) {
            die("Thiếu ID user.");
        }

        $user = $this->userModel->getUserById($_GET['id']);
        if (!$user) {
            die("User không tồn tại.");
        }

        include "views/admin/users/detail.php";
    }

    // ============================================================
    // 3. QUẢN LÝ DANH MỤC KHÓA HỌC
    // ============================================================
    public function categories() {
        $categories = $this->categoryModel->getAllCategories();
        include "views/admin/categories/list.php";
    }


    public function addCategory() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);

            if ($name === "") {
                die("Tên danh mục không được để trống.");
            }

            if ($this->categoryModel->exists($name)) {
                die("Tên danh mục đã tồn tại.");
            }

            $this->categoryModel->add($name);
            header("Location: index.php?controller=admin&action=categories");
            exit;
        }

        include "views/admin/category/add.php";
    }

    public function editCategory() {
        if (empty($_GET['id'])) die("Thiếu ID category");

        $cat = $this->categoryModel->getById($_GET['id']);
        if (!$cat) die("Danh mục không tồn tại.");

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = trim($_POST['name']);

            if ($name === "") die("Tên danh mục không được để trống.");

            $this->categoryModel->update($_GET['id'], $name);
            header("Location: index.php?controller=admin&action=categories");
            exit;
        }

        include "views/admin/category/edit.php";
    }

    public function deleteCategory() {
        if (empty($_GET['id'])) die("Thiếu ID category");

        $cat = $this->categoryModel->getById($_GET['id']);
        if (!$cat) die("Danh mục không tồn tại.");

        // Kiểm tra xem có khóa học nào đang sử dụng category này không
        if ($this->courseModel->countByCategory($_GET['id']) > 0) {
            die("Không thể xóa danh mục vì đang có khóa học thuộc danh mục này!");
        }

        $this->categoryModel->delete($_GET['id']);
        header("Location: index.php?controller=admin&action=categories");
        exit;
    }

    // ============================================================
    // 4. DUYỆT KHÓA HỌC
    // ============================================================
    public function pendingCourses() {
        // Gọi phương thức getPending từ model
        $pendingCourses = $this->courseModel->getPending();

        // Load view hiển thị
        require_once 'views/admin/pending_courses.php';
    }

    public function approveCourse() {
        if (empty($_GET['id'])) die("Thiếu ID khóa học");

        $course = $this->courseModel->getById($_GET['id']);
        if (!$course) die("Khóa học không tồn tại.");

        $this->courseModel->updateStatus($_GET['id'], 1);
        header("Location: index.php?controller=admin&action=pendingCourses");
        exit;
    }

    public function rejectCourse() {
    $id = $_GET['id'];

    $this->courseModel->deleteCourse($id);

    header("Location: index.php?controller=admin&action=pendingCourses");
    exit();
}

}
