<?php
session_start();
require_once "models/User.php";

class UserController {

    private $user;

    public function __construct() {
        $this->user = new User();
    }

    /* LOGIN PROCESS */
    public function login() {
        if(isset($_POST['login'])) {
            $ue = $_POST['username'];
            $pw = $_POST['password'];

            $user = $this->user->login($ue,$pw);

            if($user) {
                $_SESSION['user'] = $user;
                header("Location: index.php");
                exit;
            }
            $error = "Sai tài khoản hoặc mật khẩu!";
            require "views/login.php";
        }
    }

    /* REGISTER PROCESS */
    public function register() {
        if(isset($_POST['register'])) {
            $this->user->register(
                $_POST['username'],
                $_POST['email'],
                $_POST['password'],
                $_POST['fullname']
            );
            header("Location: login.php");
            exit;
        }
    }

    /* LOGOUT */
    public function logout() {
        session_destroy();
        header("Location: login.php");
    }

    /* ADMIN – USER LIST */
    public function listUsers() {
        $users = $this->user->getAllUsers();
        require "views/admin/users.php";
    }

    /* ADMIN – DELETE */
    public function deleteUser($id) {
        $this->user->deleteUser($id);
        header("Location: users.php");
    }

    /* ADMIN – UPDATE ROLE */
    public function updateRole($id,$role) {
        $this->user->updateRole($id,$role);
        header("Location: users.php");
    }

    /* ADMIN – TOGGLE ACTIVE */
    public function toggleActive($id) {
        $this->user->toggleActive($id);
        header("Location: users.php");
    }
}
