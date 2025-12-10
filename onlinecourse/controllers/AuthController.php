<?php
require_once "models/User.php";

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    // Trang login
    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $usernameOrEmail = $_POST['username_email'];
            $password = $_POST['password'];

            // Lấy user từ model
            $user = $this->userModel->login($usernameOrEmail, $password);

            // ❗ Sửa lỗi: Đảm bảo $user là array và có key password
            if (is_array($user) && isset($user['password']) && password_verify($password, $user['password'])) {

                // Lưu session
                $_SESSION['user'] = [
                    'id'       => $user['id'],
                    'fullname' => $user['fullname'],
                    'role'     => $user['role']
                ];

                header("Location: index.php");
                exit;
            }

            // Nếu sai
            $error = "Sai tài khoản hoặc mật khẩu!";
        }

        include "views/auth/login.php";
    }

    // Đăng ký
    public function register() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            $username = $_POST['username'];
            $email    = $_POST['email'];
            $password = $_POST['password'];
            $fullname = $_POST['fullname'];
            $role     = $_POST['role'] ?? 0;

            $this->userModel->register($username, $email, $password, $fullname, $role);

            header("Location: index.php?controller=auth&action=login");
            exit;
        }

        include "views/auth/register.php";
    }

    // Logout
    public function logout() {
        session_destroy();
        header("Location:index.php?controller=auth&action=login");
        exit;
    }

    // Trang profile
    public function profile() {

        // ❗ Sửa lỗi: bạn đang dùng $_SESSION['user'], không phải user_id
        if (!isset($_SESSION['user'])) {
            header("Location:index.php?controller=auth&action=login");
            exit;
        }

        $userId = $_SESSION['user']['id'];
        $user = $this->userModel->getUserById($userId);

        include "views/auth/profile.php";
    }
}
