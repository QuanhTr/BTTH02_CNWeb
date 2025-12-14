<?php include __DIR__ . "/../layouts/header.php"; ?>
<?php include __DIR__ . "/../layouts/sidebar.php"; ?>

<style>
.student-dashboard {
    padding: 30px;
    background: #f5f7fa;
    min-height: 100vh;
}

.student-title {
    font-size: 26px;
    font-weight: 700;
    color: #2d3436;
    margin-bottom: 10px;
}

.student-subtitle {
    color: #636e72;
    margin-bottom: 30px;
}

.student-grid {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(260px, 1fr));
    gap: 22px;
}

.student-card {
    background: #fff;
    border-radius: 18px;
    padding: 24px;
    box-shadow: 0 8px 22px rgba(0,0,0,0.08);
    transition: 0.3s;
    position: relative;
    overflow: hidden;
}

.student-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 14px 30px rgba(0,0,0,0.12);
}

.student-icon {
    font-size: 54px;
    position: absolute;
    right: 20px;
    bottom: 15px;
    opacity: 0.08;
}

.student-card h3 {
    font-size: 18px;
    font-weight: 700;
    margin-bottom: 8px;
}

.student-card p {
    font-size: 14px;
    color: #555;
    margin-bottom: 18px;
}

.student-card a {
    display: inline-block;
    padding: 8px 16px;
    border-radius: 10px;
    font-weight: 600;
    text-decoration: none;
    font-size: 14px;
}

.btn-blue { background: #0984e3; color: #fff; }
.btn-green { background: #00b894; color: #fff; }

</style>

<div class="student-dashboard">

    <div class="student-title">
        👋 Xin chào, <?= htmlspecialchars($_SESSION['user']['fullname']) ?>
    </div>
    <div class="student-subtitle">
        Chào mừng bạn đến với hệ thống học trực tuyến
    </div>

    <div class="student-grid">

        <!-- Danh sách khóa học -->
        <div class="student-card">
            <h3>📚 Danh sách khóa học</h3>
            <p>
                Khám phá các khóa học mới, tìm kiếm theo danh mục,
                trình độ và giảng viên.
            </p>
            <a class="btn-blue"
               href="index.php?controller=course&action=index">
                Xem khóa học
            </a>
            <div class="student-icon">📚</div>
        </div>

        <!-- Khóa học của tôi -->
        <div class="student-card">
            <h3>🧾 Khóa học của tôi</h3>
            <p>
                Xem các khóa học bạn đã đăng ký và theo dõi tiến độ học tập.
            </p>
            <a class="btn-green"
               href="index.php?controller=student&action=myCourses">
                Vào học
            </a>
            <div class="student-icon">🎓</div>
        </div>

    </div>

</div>

<?php include __DIR__ . "/../layouts/footer.php"; ?>
