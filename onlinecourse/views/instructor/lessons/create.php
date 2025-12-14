<?php include __DIR__ . "/../../layouts/header.php"; ?>

<div class="container mt-4">
    <h4 class="mb-3">➕ Thêm bài học</h4>

    <form method="POST"
          action="index.php?controller=lesson&action=store">

        <input type="hidden" name="course_id" value="<?= $courseId ?>">

        <div class="mb-3">
            <label class="form-label">📘 Tiêu đề bài học</label>
            <input type="text"
                   name="title"
                   class="form-control"
                   required>
        </div>

        <div class="mb-3">
            <label class="form-label">📝 Nội dung</label>
            <textarea name="content"
                      class="form-control"
                      rows="5"></textarea>
        </div>

        <div class="mb-3">
            <label class="form-label">🎬 Video URL (YouTube)</label>
            <input type="text"
                   name="video_url"
                   class="form-control">
        </div>

        <div class="mb-3">
            <label class="form-label">🔢 Thứ tự bài học</label>
            <input type="number"
                   name="order"
                   class="form-control"
                   value="1">
        </div>

        <button class="btn btn-success">
            💾 Lưu bài học
        </button>

        <a href="index.php?controller=lesson&action=manage&course_id=<?= $courseId ?>"
           class="btn btn-secondary">
            ⬅ Quay lại
        </a>
    </form>
</div>

<?php include __DIR__ . "/../../layouts/footer.php"; ?>
