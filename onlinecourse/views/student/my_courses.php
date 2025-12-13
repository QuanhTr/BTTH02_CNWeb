<?php include __DIR__ . "/../layouts/header.php"; ?>

<div class="container mt-4">
    <h2>📚 Khóa học của tôi</h2>
    <hr>

    <?php if (empty($courses)): ?>
        <p>Bạn chưa đăng ký khóa học nào.</p>
    <?php else: ?>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Khóa học</th>
                    <th>Tiến độ</th>
                    <th>Ngày đăng ký</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($courses as $c): ?>
                    <tr>
                        <td><?= htmlspecialchars($c['title']) ?></td>
                        <td><?= $c['progress'] ?>%</td>
                        <td><?= $c['enrolled_date'] ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php include __DIR__ . "/../layouts/footer.php"; ?>
