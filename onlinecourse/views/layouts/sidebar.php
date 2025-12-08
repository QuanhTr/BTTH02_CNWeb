<?php
require_once __DIR__ . "/../../core/Auth.php";
$user = Auth::user();
if(!$user || $user['role'] != 2){
    // not admin, do nothing
    return;
}
?>
<aside class="sidebar">
    <ul>
        <li><a href="index.php?controller=admin&action=dashboard">Dashboard</a></li>
        <li><a href="index.php?controller=admin&action=users">Users</a></li>
        <li><a href="index.php?controller=category&action=index">Categories</a></li>
        <li><a href="index.php?controller=admin&action=pendingCourses">Pending Courses</a></li>
    </ul>
</aside>
