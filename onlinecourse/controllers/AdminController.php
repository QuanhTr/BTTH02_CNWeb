<?php
require_once "models/User.php";
require_once "core/Auth.php";

class AdminController {

    private $userModel;

    public function __construct() {
        Auth::requireRole([2]); // Chỉ admin mới được vào tất cả hàm
        $this->userModel = new User();
    }

    // Trang dashboard
    public function dashboard() {
        $totalUsers = $this->userModel->countAllUsers();
        $totalActive = $this->userModel->countActiveUsers();
        $totalInactive = $this->userModel->countInactiveUsers();

        include "views/admin/dashboard.php";
    }

    // Danh sách tất cả user
    public function users() {
        $users = $this->userModel->getAllUsers();
        include "views/admin/users/manage.php";
    }

    // Đổi role (CHỈ POST)
    public function changeRole() {
        if (!isset($_POST['id']) || !isset($_POST['role'])) {
            die("Thiếu dữ liệu.");
        }

        $id = intval($_POST['id']);
        $role = intval($_POST['role']);

        $this->userModel->updateRole($id, $role);
        header("Location: index.php?controller=admin&action=users");
        exit;
    }

    // Kích hoạt / vô hiệu hóa user
    public function toggleActive() {
        if (!isset($_POST['id'])) {
            die("Thiếu dữ liệu.");
        }

        $id = intval($_POST['id']);
        $this->userModel->toggleActive($id);
        
        header("Location: index.php?controller=admin&action=users");
        exit;
    }

    // Xem chi tiết user
    public function userDetail() {
        if (!isset($_GET['id'])) {
            die("Thiếu ID user.");
        }

        $user = $this->userModel->getUserById($_GET['id']);
        include "views/admin/users/detail.php";
    }
}
