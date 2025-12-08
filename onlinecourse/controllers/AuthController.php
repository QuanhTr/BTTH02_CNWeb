<?php
require_once "models/User.php";

class AuthController {
    private $userModel;

    public function __construct() {
        $this->userModel = new User();
        if(session_status()===PHP_SESSION_NONE){
            session_start();
        }
    }

    // Trang login
    public function login() {
        if($_SERVER['REQUEST_METHOD']==='POST') {
            $usernameOrEmail = $_POST['username_email'];
            $password = $_POST['password'];
            $user = $this->userModel->login($usernameOrEmail,$password);
            if($user){
                $_SESSION['user'] = [
                    'id' => $user['id'],
                    'fullname' => $user['fullname'],
                    'role' => $user['role']
                ];

                header("Location:index.php");
                exit;
            } else {
                $error = "Sai tài khoản hoặc mật khẩu!";
            }
        }
        include "views/auth/login.php";
    }

    // Trang register
    public function register() {
        if($_SERVER['REQUEST_METHOD']==='POST') {
            $username = $_POST['username'];
            $email = $_POST['email'];
            $password = $_POST['password'];
            $fullname = $_POST['fullname'];
            $role = $_POST['role'] ?? 0; // default học viên
            $this->userModel->register($username,$email,$password,$fullname,$role);
            header("Location:index.php?controller=auth&action=login");
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

    // Profile
    public function profile() {
        if(!isset($_SESSION['user_id'])){
            header("Location:index.php?controller=auth&action=login");
            exit;
        }
        $user = $this->userModel->getUserById($_SESSION['user_id']);
        include "views/auth/profile.php";
    }
}
