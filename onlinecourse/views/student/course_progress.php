<h2>Nội dung khóa học</h2>
<?php foreach ($lessons as $l): ?>
<div class="mb-3">
    <h5><?= $l['title'] ?></h5>
    <p><?= nl2br($l['content']) ?></p>
</div>
<?php endforeach; ?>
