<h2>Khóa học đã đăng ký</h2>

<?php if (empty($courses)): ?>
    <p>Bạn chưa đăng ký khóa học nào.</p>
<?php else: ?>
    <ul>
        <?php foreach ($courses as $course): ?>
            <li>
                <strong><?= $course['title'] ?></strong><br>
                Giảng viên: <?= $course['instructor_name'] ?><br>

                <a href="index.php?controller=course&action=detail&id=<?= $course['id'] ?>">
                    Xem khóa học
                </a> |
                <a href="index.php?controller=lesson&action=index&course_id=<?= $course['id'] ?>">
                    Xem bài học
                </a> |
                <a href="index.php?controller=student&action=progress&course_id=<?= $course['id'] ?>">
                    Tiến độ
                </a>
            </li>
            <hr>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
