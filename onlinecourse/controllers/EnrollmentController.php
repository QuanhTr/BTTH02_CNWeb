<?php
require_once "models/Enrollment.php";

class EnrollmentController {

    private $enrollmentModel;

    public function __construct() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $this->enrollmentModel = new Enrollment();
    }

    // ===============================
    // ĐĂNG KÝ KHÓA HỌC
    // ===============================
    public function enroll() {

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 0) {
            die("Chỉ học viên mới đăng ký khóa học!");
        }

        if (!isset($_GET['course_id'])) {
            die("Thiếu course_id");
        }

        $course_id  = (int)$_GET['course_id'];
        $student_id = $_SESSION['user']['id'];

        if ($this->enrollmentModel->isEnrolled($student_id, $course_id)) {
            die("Bạn đã đăng ký khóa học này rồi!");
        }

        $this->enrollmentModel->enroll($student_id, $course_id);

        header("Location: index.php?controller=student&action=myCourses");
        exit;
    }

    // ===============================
    // KHÓA HỌC ĐÃ ĐĂNG KÝ
    // ===============================
    public function myCourses() {

        if (!isset($_SESSION['user']) || $_SESSION['user']['role'] != 0) {
            die("Chỉ học viên mới xem được!");
        }

        $student_id = $_SESSION['user']['id'];
        $courses = $this->enrollmentModel->getMyCourses($student_id);

        include "views/student/my_courses.php";
    }
}
