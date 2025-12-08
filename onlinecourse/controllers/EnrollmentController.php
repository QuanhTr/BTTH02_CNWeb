<?php
require_once "models/Enrollment.php";
require_once "models/Course.php";

class EnrollmentController {
    private $enrollmentModel;
    private $courseModel;

    public function __construct() {
        $this->enrollmentModel = new Enrollment();
        $this->courseModel = new Course();
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
    }

    // Đăng ký khóa học
    public function enroll() {
        if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 0){
            echo "Chỉ học viên mới đăng ký khóa học!";
            exit;
        }

        $course_id = $_GET['course_id'];
        $student_id = $_SESSION['user_id'];
        $this->enrollmentModel->enroll($course_id,$student_id);
        header("Location:index.php?controller=enrollment&action=my_courses");
        exit;
    }

    // Xem khóa học đã đăng ký
    public function my_courses() {
        if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 0){
            echo "Chỉ học viên mới xem được!";
            exit;
        }

        $student_id = $_SESSION['user_id'];
        $enrollments = $this->enrollmentModel->getByStudent($student_id);
        include "views/enrollments/my_courses.php";
    }
}
