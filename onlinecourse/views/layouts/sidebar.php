<?php
require_once __DIR__ . "/../../core/Auth.php";
$user = Auth::user();
if(!$user || $user['role'] != 2){
    return;
}
?>

<style>
    .sidebar {
        width: 240px;
        height: 100vh;
        background: #ffffff;
        padding: 20px 15px;
        border-radius: 0 25px 25px 0;
        box-shadow: 4px 0 20px rgba(0, 0, 0, 0.08);
        position: fixed;
        top: 0;
        left: 0;
    }

    .sidebar ul {
        list-style: none;
        padding-left: 0;
        margin-top: 20px;
    }

    .sidebar li {
        margin-bottom: 15px;
    }

    .sidebar a {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 12px 16px;
        font-size: 15px;
        font-weight: 500;
        text-decoration: none;
        color: #2d3436;
        background: #f5f7fa;
        border-radius: 14px;
        transition: 0.25s ease;
    }

    .sidebar a:hover {
        background: #e8ecf1;
        transform: translateX(5px);
    }

    /* Icon style */
    .sidebar i {
        font-size: 18px;
        opacity: 0.75;
    }

    /* Active link highlight */
    .sidebar a.active {
        background: #dfe6ee;
        font-weight: 600;
    }

    /* Push page content right */
    .content {
        margin-left: 260px !important; 
        padding: 30px;
    }
</style>

<aside class="sidebar">
    <h4 style="font-weight:600; margin-left:10px; color:#2d3436;">Quản trị</h4>

    <ul>
        <li>
            <a href="index.php?controller=admin&action=dashboard"
               class="<?= ($_GET['action'] ?? '') == 'dashboard' ? 'active' : '' ?>">
                <i class="bi bi-speedometer2"></i> Trang chính
            </a>
        </li>

        <li>
            <a href="index.php?controller=admin&action=users"
               class="<?= ($_GET['action'] ?? '') == 'users' ? 'active' : '' ?>">
                <i class="bi bi-people-fill"></i> Người dùng
            </a>
        </li>

        <li>
            <a href="index.php?controller=admin&action=categories"
               class="<?= ($_GET['controller'] ?? '') == 'category' ? 'active' : '' ?>">
                <i class="bi bi-tags-fill"></i> Danh mục khóa học
            </a>
        </li>

        <li>
            <a href="index.php?controller=admin&action=pendingCourses"
               class="<?= ($_GET['action'] ?? '') == 'pendingCourses' ? 'active' : '' ?>">
                <i class="bi bi-hourglass-split"></i> Khóa học chờ xử lý
            </a>
        </li>
    </ul>
</aside>
