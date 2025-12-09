<?php include "views/layouts/header.php"; ?>


<div class="login-wrapper">
    <div class="login-card">

        <h2 class="login-title">Đăng nhập</h2>

        <?php if(isset($error)): ?>
            <div class="alert alert-danger"><?= $error ?></div>
        <?php endif; ?>

        <form method="POST">

            <div class="mb-3">
                <label class="form-label">Tên đăng nhập hoặc Email</label>
                <input type="text" name="username_email" class="form-control" required>
            </div>

            <div class="mb-3">
                <label class="form-label">Mật khẩu</label>
                <input type="password" name="password" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-primary">Đăng nhập</button>
        </form>

        <div class="login-footer">
            Chưa có tài khoản?
            <a href="index.php?controller=auth&action=register">Đăng ký</a>
        </div>

    </div>
</div>

<?php include "views/layouts/footer.php"; ?>
