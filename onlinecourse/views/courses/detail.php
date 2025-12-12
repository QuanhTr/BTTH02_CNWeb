<h2><?= $course['title'] ?></h2>

<p><strong>Giảng viên:</strong> <?= $course['instructor_name'] ?></p>
<p><strong>Mô tả:</strong> <?= $course['description'] ?></p>
<p><strong>Giá:</strong> <?= $course['price'] ?>₫</p>

<hr>

<?php if ($isEnrolled): ?>
    <p style="color: green;">Bạn đã đăng ký khóa học này ✔</p>
    <a href="index.php?controller=lesson&action=index&course_id=<?= $course['id'] ?>">Vào học</a>
<?php else: ?>
    <form method="POST" action="index.php?controller=enrollment&action=register">
        <input type="hidden" name="course_id" value="<?= $course['id'] ?>">
        <button type="submit">Đăng ký ngay</button>
    </form>
<?php endif; ?>

<hr>

<h3>Bài học</h3>

<ul>
    <?php foreach ($lessons as $lesson): ?>
        <li><?= $lesson['order'] ?>. <?= $lesson['title'] ?></li>
    <?php endforeach; ?>
</ul>
