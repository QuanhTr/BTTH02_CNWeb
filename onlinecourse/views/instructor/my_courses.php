<?php include __DIR__ . "/../layouts/header.php"; ?>

<style>
.course-page {
    width: 100%;
    display: flex;
    justify-content: center;
    padding: 40px 15px;
}

.course-card {
    width: 100%;
    max-width: 1200px;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 12px 35px rgba(0,0,0,0.1);
    border: none;
}

.course-card-header {
    background: linear-gradient(135deg, #0d6efd, #0b5ed7);
    color: #fff;
    padding: 22px 30px;
    border-radius: 16px 16px 0 0;
}

.course-card-header h3 {
    margin: 0;
    font-weight: 600;
}

.course-card-body {
    padding: 30px;
}

.dashboard-link {
    color: #ffe082; /* vàng nhạt */
    font-weight: 600;
    text-decoration: none;
}

.dashboard-link:hover {
    color: #fff3cd;
    text-decoration: underline;
}

.add-course-link {
    color: #ffffff; /* trắng */
    font-weight: 600;
}

.add-course-link:hover {
    color: #ffd54f; /* vàng đậm */
}
</style>

<div class="course-page">
    
    <div class="course-card">

        <div class="course-card-header d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center gap-3">
                <a href="index.php?controller=instructor&action=dashboard"
                class="dashboard-link">
                    ← Dashboard
                </a>

                <div>
                    <h3 class="mb-0">🎓 Quản lý khóa học</h3>
                    <small>Danh sách các khóa học bạn đang quản lý</small>
                </div>
            </div>

            <a href="index.php?controller=instructor&action=create"
            class="add-course-link">
                ➕ Thêm khóa học
            </a>
        </div>

        <!-- BODY -->
        <div class="course-card-body">

            <?php if (empty($courses)): ?>
                <div class="alert alert-info mb-0">
                    Bạn chưa có khóa học nào.
                </div>
            <?php else: ?>
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle mb-0">
                        <thead class="table-dark text-center">
                            <tr>
                                <th>Tên khóa học</th>
                                <th>Giá</th>
                                <th>Cấp độ</th>
                                <th>Trạng thái</th>
                                <th width="220">Hành động</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php foreach ($courses as $c): ?>
                                <tr>
                                    <td><?= htmlspecialchars($c['title']) ?></td>
                                    <td class="text-end"><?= number_format($c['price']) ?> đ</td>
                                    <td class="text-center"><?= $c['level'] ?></td>
                                    <td class="text-center">
                                        <?= $c['status'] == 1
                                            ? '<span class="badge bg-success">Đã duyệt</span>'
                                            : '<span class="badge bg-warning text-dark">Chờ duyệt</span>' ?>
                                    </td>
                                    <td class="text-center">
                                        <div class="d-flex flex-column gap-1">

                                            <!-- Sửa & Xóa -->
                                            <div class="d-flex gap-1 justify-content-center">
                                                <a href="index.php?controller=instructor&action=editCourse&id=<?= $c['id'] ?>"
                                                   class="btn btn-sm btn-warning">
                                                    ✏ Sửa
                                                </a>

                                                <a href="index.php?controller=instructor&action=deleteCourse&id=<?= $c['id'] ?>"
                                                   class="btn btn-sm btn-danger"
                                                   onclick="return confirm('Bạn chắc chắn muốn xóa?');">
                                                    🗑 Xóa
                                                </a>
                                            </div>

                                            <!-- Quản lý bài học -->
                                            <a href="index.php?controller=lesson&action=manage&course_id=<?= $c['id'] ?>"
                                               class="btn btn-sm btn-success">
                                                📖 Quản lý bài học
                                            </a>

                                            <!-- Quản lý tài liệu -->
                                            <a href="index.php?controller=lesson&action=materials&course_id=<?= $c['id'] ?>"
                                               class="btn btn-sm btn-warning text-white">
                                                📎 Quản lý tài liệu
                                            </a>

                                        </div>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>

        </div>
    </div>
</div>

<?php include __DIR__ . "/../layouts/footer.php"; ?>
