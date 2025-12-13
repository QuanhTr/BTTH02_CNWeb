<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once "models/Course.php";
require_once "models/Enrollment.php";

class StudentController {

    public function __construct() {
        // Chặn nếu chưa đăng nhập hoặc không phải học viên
        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 0) {
            header("Location: index.php?controller=auth&action=login");
            exit;
        }
    }

    // Dashboard học viên
    public function dashboard() {
        require_once "views/student/dashboard.php";
    }

    // Danh sách khóa học đã đăng ký
    public function myCourses() {
        $enrollmentModel = new Enrollment();
        $courses = $enrollmentModel->getMyCourses($_SESSION['user']['id']);
        require_once "views/student/my_courses.php";
    }

    // Theo dõi tiến độ

    public function courseProgress() {
    if (empty($_GET['id'])) die("Thiếu ID khóa học");

    $enrollmentModel = new Enrollment();
    $courses = $enrollmentModel->getMyCourses($_SESSION['user']['id']);

    foreach ($courses as $c) {
        if ($c['id'] == $_GET['id']) {
            $course = $c;
            break;
        }
    }

    if (!isset($course)) die("Không tìm thấy khóa học");

    require "views/student/course_progress.php";
}

}
