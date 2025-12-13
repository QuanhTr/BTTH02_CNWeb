<?php include __DIR__ . "/../layouts/header.php"; ?>

<div class="container mt-4">
    <h2><?= htmlspecialchars($course['title']) ?></h2>

    <p><strong>Giảng viên:</strong> <?= $course['instructor_name'] ?></p>
    <p><strong>Danh mục:</strong> <?= $course['category_name'] ?></p>
    <p><strong>Trình độ:</strong> <?= $course['level'] ?></p>
    <p><strong>Thời lượng:</strong> <?= $course['duration_weeks'] ?> tuần</p>
    <p><strong>Giá:</strong> <?= number_format($course['price']) ?> VNĐ</p>

    <hr>
    <p><?= nl2br(htmlspecialchars($course['description'])) ?></p>

    
</div>

<?php include __DIR__ . "/../layouts/footer.php"; ?>
