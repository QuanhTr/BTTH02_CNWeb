<h2>Tiến độ học tập: <?= $course['title'] ?></h2>

<p>Hoàn thành: <?= count($completedLessons) ?> / <?= count($lessons) ?> bài học</p>
<progress value="<?= count($completedLessons) ?>" max="<?= count($lessons) ?>"></progress>

<hr>

<h3>Danh sách bài học</h3>

<ul>
    <?php foreach ($lessons as $lesson): ?>
        <li>
            <?= $lesson['order'] ?>. <?= $lesson['title'] ?>

            <?php if (in_array($lesson['id'], $completedLessons)): ?>
                <span style="color: green">✔ Đã hoàn thành</span>
            <?php else: ?>
                <span style="color: red">✖ Chưa xong</span>
            <?php endif; ?>
        </li>
    <?php endforeach; ?>
</ul>
