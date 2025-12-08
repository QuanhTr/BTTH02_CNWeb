<?php
require_once "models/User.php";
require_once "core/Auth.php";

class AdminController {

    public function dashboard() {
        Auth::requireRole([2]);
        include "views/admin/dashboard.php";
    }

    public function users() {
        Auth::requireRole([2]);

        $model = new User();
        $users = $model->getAllUsers();
        include "views/admin/users/manage.php";
    }

    public function changeRole() {
        Auth::requireRole([2]);

        $model = new User();
        $model->updateRole($_GET['id'], $_GET['role']);
        header("Location: index.php?controller=admin&action=users");
    }

    public function toggleActive() {
        Auth::requireRole([2]);

        $model = new User();
        $model->toggleActive($_GET['id']);
        header("Location: index.php?controller=admin&action=users");
    }
}
