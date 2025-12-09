<?php
require_once __DIR__ . "/../../core/Auth.php";
$user = Auth::user();
if(!$user || $user['role'] != 2){

    return;
}
?>
<aside class="sidebar">
    <ul>
        <li><a href="index.php?controller=admin&action=dashboard">Trang chính</a></li>
        <li><a href="index.php?controller=admin&action=users">Người dùng</a></li>
        <li><a href="index.php?controller=category&action=index">Danh mục khóa học</a></li>
        <li><a href="index.php?controller=admin&action=pendingCourses">Khóa học đang chờ xử lý</a></li>
    </ul>
</aside>
