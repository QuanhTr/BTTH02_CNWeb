<style>
    .home-container {
        max-width: 600px;
        margin: 40px auto;
        padding: 30px;
        background: #ffffff;
        border-radius: 12px;
        box-shadow: 0 4px 12px rgba(0,0,0,0.08);
        font-family: Arial, sans-serif;
        text-align: center;
    }

    .home-container h2 {
        margin-bottom: 10px;
        font-size: 26px;
        font-weight: 600;
        color: #333;
    }

    .home-container p {
        color: #555;
        font-size: 16px;
        margin-bottom: 20px;
    }

    .home-container a {
        display: inline-block;
        margin: 8px;
        padding: 10px 18px;
        text-decoration: none;
        font-size: 15px;
        background: #f4f4f4;
        color: #333;
        border-radius: 6px;
        border: 1px solid #ddd;
        transition: 0.2s;
    }

    .home-container a:hover {
        background: #e9e9e9;
    }

    .home-user-name {
        font-weight: bold;
        color: #222;
    }
</style>

<div class="home-container">
    <h2>Chào mừng bạn đến với hệ thống khóa học trực tuyến.</h2>

    <?php if (!isset($_SESSION['user'])): ?>
        <a href="index.php?controller=auth&action=login">Đăng nhập</a>
        <a href="index.php?controller=auth&action=register">Đăng ký</a>

    <?php else: ?>
        <p>
            Xin chào, <span class="home-user-name"><?= $_SESSION['user']['fullname'] ?></span>
        </p>

        <?php if ($_SESSION['user']['role'] == 0): ?>
            <a href="index.php?controller=student&action=dashboard">Vào trang học viên</a>

        <?php elseif ($_SESSION['user']['role'] == 1): ?>
            <a href="index.php?controller=instructor&action=dashboard">Vào trang giảng viên</a>

        <?php elseif ($_SESSION['user']['role'] == 2): ?>
            <a href="index.php?controller=admin&action=dashboard">Vào trang quản trị</a>
        <?php endif; ?>

    <?php endif; ?>
</div>
