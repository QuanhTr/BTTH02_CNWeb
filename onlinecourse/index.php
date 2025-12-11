<?php
session_start();

$controller = $_GET['controller'] ?? 'home';
$action     = $_GET['action'] ?? 'index';

switch ($controller) {

    // ================= HOME =================
    case "home":
        require_once "controllers/HomeController.php";
        $ctrl = new HomeController();
        if ($action == "index") $ctrl->index();
        break;

    // ================= AUTH =================
    case "auth":
        require_once "controllers/AuthController.php";
        $ctrl = new AuthController();
        if ($action == "login") $ctrl->login();
        if ($action == "register") $ctrl->register();
        if ($action == "logout") $ctrl->logout();
        break;

    // ================= ADMIN =================
    case "admin":
        require_once "controllers/AdminController.php";
        $ctrl = new AdminController();

        if ($action == "dashboard") $ctrl->dashboard();
        if ($action == "users") $ctrl->users();
        if ($action == "changeRole") $ctrl->changeRole();
        if ($action == "toggleActive") $ctrl->toggleActive();
        if ($action == "userDetail") $ctrl->userDetail();

        if ($action == "categories") $ctrl->categories();
        if ($action == "addCategory") $ctrl->addCategory();
        if ($action == "editCategory") $ctrl->editCategory();
        if ($action == "deleteCategory") $ctrl->deleteCategory();

        if ($action == "pendingCourses") $ctrl->pendingCourses();
        if ($action == "approveCourse") $ctrl->approveCourse();
        if ($action == "rejectCourse") $ctrl->rejectCourse();
        break;

    // ================= COURSE =================
    case "course":
        require_once "controllers/CourseController.php";
        $ctrl = new CourseController();
        if ($action == "index") $ctrl->index();
        if ($action == "detail") $ctrl->detail();
        if ($action == "search") $ctrl->search();
        break;

        

    // ================= DEFAULT =================
    default:
        die("Controller $controller không tồn tại!");
}
