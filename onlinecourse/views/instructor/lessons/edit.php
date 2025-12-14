<?php include __DIR__ . "/../../layouts/header.php"; ?>

<div class="container mt-4">
    <h4 class="mb-3">✏ Sửa bài học</h4>

    <form method="POST"
          action="index.php?controller=lesson&action=update&id=<?= $lesson['id'] ?>">

        <input type="hidden" name="course_id" value="<?= $lesson['course_id'] ?>">

        <div class="mb-3">
            <label class="form-label">📘 Tiêu đề bài học</label>
            <input type="text"
                   name="title"
                   class="form-control"
                   value="<?= htmlspecialchars($lesson['title']) ?>"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">📝 Nội dung</label>
            <textarea name="content"
                      class="form-control"
                      rows="5"><?= htmlspecialchars($lesson['content']) ?></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">🎬 Video URL</label>
            <input type="text"
                   name="video_url"
                   class="form-control"
                   value="<?= htmlspecialchars($lesson['video_url']) ?>">
        </div>

        <div class="mb-3">
            <label class="form-label">🔢 Thứ tự bài học</label>
            <input type="number"
                   name="order"
                   class="form-control"
                   value="<?= $lesson['order'] ?>">
        </div>

        <button class="btn btn-warning">
            💾 Cập nhật
        </button>

        <a href="index.php?controller=lesson&action=manage&course_id=<?= $lesson['course_id'] ?>"
           class="btn btn-secondary">
            ⬅ Quay lại
        </a>
    </form>
</div>

<?php include __DIR__ . "/../../layouts/footer.php"; ?>
