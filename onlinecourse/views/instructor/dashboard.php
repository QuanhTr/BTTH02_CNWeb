<?php include __DIR__ . "/../layouts/header.php"; ?>
<?php include __DIR__ . "/../layouts/sidebar.php"; ?>

<style>
.dashboard-card {
    border-radius: 16px;
    box-shadow: 0 12px 30px rgba(0,0,0,0.08);
    transition: all 0.25s ease;
}
.dashboard-card:hover {
    transform: translateY(-6px);
    box-shadow: 0 18px 40px rgba(0,0,0,0.15);
}
.dashboard-icon {
    font-size: 44px;
}
</style>

<div class="content">
    <h2 class="mb-3 fw-bold">👨‍🏫 Dashboard Giảng viên</h2>
    <p class="text-muted mb-4">
        Quản lý toàn bộ khóa học, bài học và tài liệu giảng dạy của bạn
    </p>

    <div class="row g-4">

        <!-- KHÓA HỌC -->
        <div class="col-md-4">
            <div class="card dashboard-card h-100">
                <div class="card-body text-center p-4">
                    <div class="dashboard-icon mb-3 text-primary">📚</div>
                    <h5 class="fw-semibold">Quản lý khóa học</h5>
                    <p class="text-muted small">
                        Tạo, chỉnh sửa, cập nhật thông tin các khóa học
                    </p>
                    <a href="index.php?controller=instructor&action=myCourses"
                       class="btn btn-primary w-100 mt-3">
                        Vào quản lý khóa học
                    </a>
                </div>
            </div>
        </div>

        <!-- BÀI HỌC -->
        <div class="col-md-4">
            <div class="card dashboard-card h-100">
                <div class="card-body text-center p-4">
                    <div class="dashboard-icon mb-3 text-success">📖</div>
                    <h5 class="fw-semibold">Quản lý bài học</h5>
                    <p class="text-muted small">
                        Thêm, sửa, sắp xếp bài học theo từng khóa học
                    </p>
                    <!-- CHUYỂN SANG TRANG CHỌN KHÓA HỌC -->
                    <a href="index.php?controller=instructor&action=myCourses"
                       class="btn btn-success w-100 mt-3">
                        Chọn khóa học
                    </a>
                </div>
            </div>
        </div>

        <!-- TÀI LIỆU -->
        <div class="col-md-4">
            <div class="card dashboard-card h-100">
                <div class="card-body text-center p-4">
                    <div class="dashboard-icon mb-3 text-warning">📎</div>
                    <h5 class="fw-semibold">Tài liệu học tập</h5>
                    <p class="text-muted small">
                        Upload PDF, Word, PowerPoint cho từng bài học
                    </p>
                    <!-- CŨNG CHUYỂN SANG TRANG CHỌN KHÓA HỌC -->
                    <a href="index.php?controller=instructor&action=myCourses"
                       class="btn btn-warning w-100 mt-3 text-white">
                        Chọn khóa học
                    </a>
                </div>
            </div>
        </div>

    </div>
</div>

<?php include __DIR__ . "/../layouts/footer.php"; ?>
