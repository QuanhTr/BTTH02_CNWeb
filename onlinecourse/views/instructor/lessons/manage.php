<?php include __DIR__ . "/../../layouts/header.php"; ?>

<div class="container mt-4">

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h4>📚 Quản lý bài học</h4>

        <a href="index.php?controller=lesson&action=create&course_id=<?= $courseId ?>"
           class="btn btn-primary">
            ➕ Thêm bài học
        </a>
    </div>

    <?php if (empty($lessons)): ?>
        <div class="alert alert-info">
            Chưa có bài học nào trong khóa học này.
        </div>
    <?php else: ?>
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark text-center">
                <tr>
                    <th width="60">STT</th>
                    <th>Tiêu đề</th>
                    <th width="120">Thứ tự</th>
                    <th width="200">Hành động</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($lessons as $index => $lesson): ?>
                    <tr>
                        <td class="text-center"><?= $index + 1 ?></td>
                        <td><?= htmlspecialchars($lesson['title']) ?></td>
                        <td class="text-center"><?= $lesson['order'] ?></td>
                        <td class="text-center">
                            <a href="index.php?controller=lesson&action=edit&id=<?= $lesson['id'] ?>"
                               class="btn btn-sm btn-warning">
                                ✏ Sửa
                            </a>

                            <a href="index.php?controller=lesson&action=delete&id=<?= $lesson['id'] ?>"
                               class="btn btn-sm btn-danger"
                               onclick="return confirm('Bạn chắc chắn muốn xóa bài học này?')">
                                🗑 Xóa
                            </a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>

    <a href="index.php?controller=instructor&action=myCourses"
       class="btn btn-secondary mt-3">
        ⬅ Quay lại khóa học
    </a>
</div>

<?php include __DIR__ . "/../../layouts/footer.php"; ?>
