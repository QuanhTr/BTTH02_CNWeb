<div style="padding: 20px;">
    <h2>Welcome to the Online Course System</h2>
    <p>Chào mừng bạn đến với hệ thống khóa học trực tuyến.</p>

    <?php if (!isset($_SESSION['user'])): ?>
        <p>
            <a href="index.php?controller=auth&action=login">Đăng nhập</a> |
            <a href="index.php?controller=auth&action=register">Đăng ký</a>
        </p>
    <?php else: ?>
        <p>Xin chào, <strong><?= $_SESSION['user']['fullname'] ?></strong>!</p>

        <?php if ($_SESSION['user']['role'] == 0): ?>
            <a href="index.php?controller=student&action=dashboard">Vào trang học viên</a>

        <?php elseif ($_SESSION['user']['role'] == 1): ?>
            <a href="index.php?controller=instructor&action=dashboard">Vào trang giảng viên</a>

        <?php elseif ($_SESSION['user']['role'] == 2): ?>
            <a href="index.php?controller=admin&action=dashboard">Vào trang quản trị</a>
        <?php endif; ?>

    <?php endif; ?>
</div>
