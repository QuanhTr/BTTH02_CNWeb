<?php
require_once "models/Lesson.php";
require_once "models/Course.php";

class LessonController {
    private $lessonModel;
    private $courseModel;

    public function __construct() {
        $this->lessonModel = new Lesson();
        $this->courseModel = new Course();
        if(session_status() === PHP_SESSION_NONE){
            session_start();
        }
    }

    // Danh sách bài học theo khóa học
    public function index() {
        $course_id = $_GET['course_id'];
        $lessons = $this->lessonModel->getByCourse($course_id);
        include "views/lessons/index.php";
    }

    // Tạo bài học
    public function create() {
        if(!isset($_SESSION['user_id']) || $_SESSION['role'] != 1){
            echo "Chỉ giảng viên mới có quyền!";
            exit;
        }

        $course_id = $_GET['course_id'];
        if($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = $_POST['title'];
            $content = $_POST['content'];
            $video_url = $_POST['video_url'];
            $order = $_POST['order'];

            $this->lessonModel->create($course_id,$title,$content,$video_url,$order);
            header("Location:index.php?controller=lesson&action=index&course_id=$course_id");
            exit;
        }

        include "views/lessons/create.php";
    }

    // Edit bài học
    public function edit() {
        echo "Chức năng edit bài học bạn có thể tự thêm tương tự create().";
    }

    // Delete bài học
    public function delete() {
        echo "Chức năng delete bài học bạn có thể thêm tương tự CourseController->delete().";
    }
}
