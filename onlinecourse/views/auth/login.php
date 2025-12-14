<?php include "views/layouts/header.php"; ?>

<style>
body {
    background-color: #f2f5f8;
    font-family: "Segoe UI", Tahoma, Geneva, Verdana, sans-serif;
}

.auth-page {
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    padding: 20px;
}

.auth-card {
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 12px 35px rgba(0,0,0,0.12);
    padding: 40px 35px;
    width: 100%;
    max-width: 400px;
}

.auth-card h2 {
    text-align: center;
    color: #0d6efd;
    margin-bottom: 30px;
    font-weight: 700;
}

.auth-card .form-label {
    font-weight: 600;
    margin-bottom: 6px;
    display: block;
}

.auth-card .form-control {
    width: 100%;
    padding: 12px 14px;
    border-radius: 10px;
    border: 1px solid #ccc;
    margin-bottom: 18px;
    transition: 0.3s;
}

.auth-card .form-control:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.2rem rgba(13,110,253,.2);
    outline: none;
}

.auth-card .btn-primary {
    width: 100%;
    padding: 12px 0;
    border-radius: 10px;
    border: none;
    background: linear-gradient(135deg, #0d6efd, #0b5ed7);
    font-weight: 600;
    color: #fff;
    cursor: pointer;
    transition: 0.3s;
}

.auth-card .btn-primary:hover {
    background: linear-gradient(135deg, #0b5ed7, #0a58ca);
}

.auth-card .login-footer {
    text-align: center;
    margin-top: 20px;
    font-size: 14px;
}

.auth-card .login-footer a {
    color: #0d6efd;
    text-decoration: none;
    font-weight: 600;
}

.auth-card .login-footer a:hover {
    text-decoration: underline;
}
</style>

<div class="auth-page">
    <div class="auth-card">
        <h2>Đăng nhập</h2>

        <?php if(isset($error)): ?>
            <div class="alert alert-danger"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <form method="POST">
            <label class="form-label">Tên đăng nhập hoặc Email</label>
            <input type="text" name="username_email" class="form-control" required>

            <label class="form-label">Mật khẩu</label>
            <input type="password" name="password" class="form-control" required>

            <button type="submit" class="btn btn-primary">Đăng nhập</button>
        </form>

        <div class="login-footer">
            Chưa có tài khoản? <a href="index.php?controller=auth&action=register">Đăng ký</a>
        </div>
    </div>
</div>

<?php include "views/layouts/footer.php"; ?>
