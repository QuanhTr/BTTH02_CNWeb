<style>
    header {
    margin: 0 auto;       /* căn giữa theo chiều ngang */
    padding: 15px 20px;
    background: #fff;
    position: relative;
    z-index: 10;
    text-align: center;   /* căn giữa nội dung bên trong header */
    max-width: 1000px;   
}
</style>

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
