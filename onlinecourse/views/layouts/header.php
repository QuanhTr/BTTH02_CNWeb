<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="assets/css/style.css">
    <title>Online Course</title>
</head>
<body>
<header>
    <h2>Online Course System</h2>
    <?php if(isset($_SESSION['user'])): ?>
        Xin chào, <?= $_SESSION['user']['fullname'] ?> |
        <a href="index.php?controller=auth&action=logout">Đăng xuất</a>
    <?php endif; ?>
</header>
<hr>
