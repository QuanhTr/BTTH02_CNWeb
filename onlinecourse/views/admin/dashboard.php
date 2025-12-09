<?php include __DIR__ . "/../layouts/header.php"; ?>
<?php include __DIR__ . "/../layouts/sidebar.php"; ?>


<div class="container mt-4">
    <h2>Trang quản trị</h2>
    <hr>

    <div class="row">
        <div class="col-md-4">
            <div class="card text-bg-primary mb-3">
                <div class="card-body">
                    <h5 class="card-title">Người dùng</h5>
                    <p class="card-text">Tổng số: <?= $userCount ?></p>
                    <a href="index.php?controller=admin&action=users" class="btn btn-light">Quản lý</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-success mb-3">
                <div class="card-body">
                    <h5 class="card-title">Khóa học</h5>
                    <p class="card-text">Tổng số: <?= $courseCount ?></p>
                    <a href="index.php?controller=admin&action=approveCourses" class="btn btn-light">Duyệt khóa học</a>
                </div>
            </div>
        </div>

        <div class="col-md-4">
            <div class="card text-bg-warning mb-3">
                <div class="card-body">
                    <h5 class="card-title">Chờ duyệt</h5>
                    <p class="card-text"><?= $pendingCourses ?> khóa học</p>
                    <a href="index.php?controller=admin&action=approveCourses" class="btn btn-light">Xem danh sách</a>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include __DIR__ . "/../layouts/footer.php"; ?>
