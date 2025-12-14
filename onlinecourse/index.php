<?php
session_start();

$controller = $_GET['controller'] ?? 'home';
$action     = $_GET['action'] ?? 'index';

switch ($controller) {

    

    // ================= HOME =================
    case "home":
        require_once "controllers/HomeController.php";
        $ctrl = new HomeController();
        if ($action === "index") {
            $ctrl->index();
        }
        break;

    // ================= AUTH =================
    case "auth":
        require_once "controllers/AuthController.php";
        $ctrl = new AuthController();

        if ($action === "login") $ctrl->login();
        elseif ($action === "register") $ctrl->register();
        elseif ($action === "logout") $ctrl->logout();
        else die("Action auth không tồn tại");
        break;

    // ================= ADMIN =================
    case "admin":
        require_once "controllers/AdminController.php";
        $ctrl = new AdminController();

        if ($action === "dashboard") $ctrl->dashboard();
        elseif ($action === "users") $ctrl->users();
        elseif ($action === "changeRole") $ctrl->changeRole();
        elseif ($action === "toggleActive") $ctrl->toggleActive();
        elseif ($action === "userDetail") $ctrl->userDetail();

        elseif ($action === "categories") $ctrl->categories();
        elseif ($action === "addCategory") $ctrl->addCategory();
        elseif ($action === "editCategory") $ctrl->editCategory();
        elseif ($action === "deleteCategory") $ctrl->deleteCategory();

        elseif ($action === "pendingCourses") $ctrl->pendingCourses();
        elseif ($action === "approveCourse") $ctrl->approveCourse();
        elseif ($action === "rejectCourse") $ctrl->rejectCourse();

        else die("Action admin không tồn tại");
        break;

    // ================= COURSE =================
    case "course":
        require_once "controllers/CourseController.php";
        $ctrl = new CourseController();

        if ($action === "index") $ctrl->index();
        elseif ($action === "detail") $ctrl->detail();
        elseif ($action === "search") $ctrl->search();
        else die("Action course không tồn tại");
        break;

    // ================= INSTRUCTOR =================
    case "instructor":
        require_once "controllers/InstructorController.php";
        $ctrl = new InstructorController();

        if ($action === "dashboard") $ctrl->dashboard();
        elseif ($action === "myCourses") $ctrl->myCourses();
        elseif ($action === "list") $ctrl->list();

        // ====== THÊM KHÓA HỌC ======
        elseif ($action === "create") $ctrl->create();
        elseif ($action === "store") $ctrl->store();

        // ====== SỬA KHÓA HỌC ======
        elseif ($action === "editCourse") $ctrl->editCourse();
        elseif ($action === "updateCourse") $ctrl->updateCourse();

        // ====== XÓA KHÓA HỌC ======
        elseif ($action === "deleteCourse") $ctrl->deleteCourse();

        // ====== HỌC VIÊN ======
        elseif ($action === "students") $ctrl->students();

        else {
            die("Action instructor không tồn tại");
        }
        break;

    case "lesson":
        require_once "controllers/LessonController.php";
        $controller = new LessonController();

        if ($action == "manage") $controller->manage();
        elseif ($action == "create") $controller->create();
        elseif ($action == "store") $controller->store();
        elseif ($action == "edit") $controller->edit();
        elseif ($action == "update") $controller->update();
        elseif ($action == "delete") $controller->delete();
        else die("Action lesson không tồn tại");
        break;

    case 'categories':
        if ($action == "categories") $ctrl->categories();
        $controller->categories();
        break;

    case "student":
        require_once "controllers/StudentController.php";
        $ctrl = new StudentController();

        if ($action == "dashboard") {
            $ctrl->dashboard();
        } elseif ($action == "myCourses") {
            $ctrl->myCourses();
        } elseif ($action == "courseProgress") {
            $ctrl->courseProgress();
        } else {
            // action mặc định
            $ctrl->dashboard();
        }
        break;

   case "enroll":
        require "controllers/EnrollmentController.php";
        $ctrl = new EnrollmentController();
        if ($action == "enroll") $ctrl->enroll();
        if ($action == "myCourses") $ctrl->myCourses();
        break;

    // ================= DEFAULT =================
    default:
        die("Controller $controller không tồn tại!");
}



