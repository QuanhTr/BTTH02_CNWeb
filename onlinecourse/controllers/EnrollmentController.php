<?php
require_once "models/Enrollment.php";
require_once "models/Course.php";

class EnrollmentController {
    private $enrollmentModel;
    private $courseModel;

    public function __construct() {
        $this->enrollmentModel = new Enrollment();
        $this->courseModel = new Course();

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }
    

    /* ================================
        ĐĂNG KÝ KHÓA HỌC
    ================================= */
    public function enroll() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 0) {
            die("Chỉ học viên mới được đăng ký khóa học!");
        }

        if (!isset($_GET['course_id'])) {
            die("Thiếu ID khóa học!");
        }

        $course_id  = $_GET['course_id'];
        $student_id = $_SESSION['user_id'];

        // Kiểm tra khóa học có tồn tại không
        $course = $this->courseModel->getById($course_id);
        if (!$course) {
            die("Khóa học không tồn tại!");
        }

        // Kiểm tra xem đã đăng ký chưa
        if ($this->enrollmentModel->isEnrolled($course_id, $student_id)) {
            die("Bạn đã đăng ký khóa học này rồi!");
        }

        // Thực hiện đăng ký
        $this->enrollmentModel->enroll($course_id, $student_id);

        header("Location: index.php?controller=enrollment&action=my_courses");
        exit;
    }

    /* ================================
        XEM KHÓA HỌC ĐÃ ĐĂNG KÝ
    ================================= */
    public function my_courses() {
        if (!isset($_SESSION['user_id']) || $_SESSION['role'] != 0) {
            die("Chỉ học viên mới xem được danh sách khóa học!");
        }

        $student_id = $_SESSION['user_id'];
        $courses = $this->enrollmentModel->getByStudent($student_id);


        include "views/student/my_courses.php";   // đúng đường dẫn trong cấu trúc của bạn
    }
}
