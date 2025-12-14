<?php include __DIR__ . "/../../layouts/header.php"; ?>

<style>
.course-page {
    width: 100%;
    display: flex;
    justify-content: center;
    padding: 40px 15px;
}

.course-card {
    width: 100%;
    max-width: 1000px;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 12px 35px rgba(0,0,0,0.1);
    border: none;
}

.course-card-header {
    background: linear-gradient(135deg, #ffc107, #ffb300);
    color: #212529;
    padding: 22px 30px;
    border-radius: 16px 16px 0 0;
}

.course-card-header h3 {
    margin: 0;
    font-weight: 600;
}

.course-card-header small {
    opacity: 0.85;
}

.course-card-body {
    padding: 32px;
}

.form-label {
    font-weight: 600;
}

.form-control,
.form-select {
    border-radius: 10px;
    padding: 10px 14px;
}

.form-control:focus,
.form-select:focus {
    border-color: #ffc107;
    box-shadow: 0 0 0 0.15rem rgba(255,193,7,.25);
}

.btn-save {
    padding: 10px 34px;
    font-weight: 600;
    border-radius: 10px;
}

.btn-back {
    padding: 10px 22px;
    border-radius: 10px;
}
</style>

<div class="course-page">

    <div class="course-card">

        <!-- HEADER -->
        <div class="course-card-header">
            <h3>✏ Sửa bài học</h3>
            <small>Cập nhật đầy đủ thông tin bài học</small>
        </div>

        <!-- BODY -->
        <div class="course-card-body">

            <form method="POST"
                  action="index.php?controller=lesson&action=update&id=<?= $lesson['id'] ?>">

                <input type="hidden" name="course_id" value="<?= $lesson['course_id'] ?>">

                <!-- TIÊU ĐỀ + NỘI DUNG -->
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

                <!-- VIDEO URL + THỨ TỰ -->
                <div class="row mb-4">
                    <div class="col-md-8">
                        <label class="form-label">🎬 Video URL</label>
                        <input type="text"
                               name="video_url"
                               class="form-control"
                               value="<?= htmlspecialchars($lesson['video_url']) ?>">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">🔢 Thứ tự bài học</label>
                        <input type="number"
                               name="order"
                               class="form-control"
                               value="<?= $lesson['order'] ?>">
                    </div>
                </div>

                <!-- BUTTON -->
                <div class="d-flex justify-content-between">
                    <a href="index.php?controller=lesson&action=manage&course_id=<?= $lesson['course_id'] ?>"
                       class="btn btn-outline-secondary btn-back">
                        ⬅ Quay lại
                    </a>

                    <button class="btn btn-warning btn-save">
                        💾 Cập nhật bài học
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<?php include __DIR__ . "/../../layouts/footer.php"; ?>
