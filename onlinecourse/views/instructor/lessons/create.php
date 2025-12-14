<?php include __DIR__ . "/../../layouts/header.php"; ?>

<style>
/* RESET ảnh hưởng layout */
main, body {
    width: 100%;
}

/* WRAPPER CENTER TUYỆT ĐỐI */
.course-page {
    width: 100%;
    display: flex;
    justify-content: center;   /* CENTER NGANG */
    padding: 40px 15px;
}

/* CARD */
.course-card {
    width: 100%;
    max-width: 1000px;
    background: #fff;
    border-radius: 16px;
    box-shadow: 0 12px 35px rgba(0,0,0,0.1);
    border: none;
}

/* HEADER */
.course-card-header {
    background: linear-gradient(135deg, #0d6efd, #0b5ed7);
    color: #fff;
    padding: 22px 30px;
    border-radius: 16px 16px 0 0;
}

.course-card-header h3 {
    margin: 0;
    font-weight: 600;
}

.course-card-header small {
    opacity: .9;
}

/* BODY */
.course-card-body {
    padding: 32px;
}

.form-label {
    font-weight: 600;
    margin-bottom: 6px;
}

.form-control,
.form-select {
    border-radius: 10px;
    padding: 10px 14px;
}

.form-control:focus,
.form-select:focus {
    border-color: #0d6efd;
    box-shadow: 0 0 0 0.15rem rgba(13,110,253,.15);
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

<!-- WRAPPER CENTER -->
<div class="course-page">

    <div class="course-card">

        <!-- HEADER -->
        <div class="course-card-header">
            <h3>➕ Thêm bài học mới</h3>
            <small>Nhập đầy đủ thông tin để tạo bài học</small>
        </div>

        <!-- BODY -->
        <div class="course-card-body">

            <form method="POST" action="index.php?controller=lesson&action=store">

                <!-- COURSE ID HIDDEN -->
                <input type="hidden" name="course_id" value="<?= $courseId ?>">

                <!-- TIÊU ĐỀ BÀI HỌC -->
                <div class="mb-3">
                    <label class="form-label">📘 Tiêu đề bài học</label>
                    <input type="text"
                           name="title"
                           class="form-control"
                           placeholder="Nhập tiêu đề bài học..."
                           required>
                </div>

                <!-- NỘI DUNG -->
                <div class="mb-3">
                    <label class="form-label">📝 Nội dung</label>
                    <textarea name="content"
                              class="form-control"
                              rows="5"
                              placeholder="Nhập nội dung chi tiết bài học..."></textarea>
                </div>

                <!-- VIDEO URL -->
                <div class="mb-3">
                    <label class="form-label">🎬 Video URL (YouTube)</label>
                    <input type="text"
                           name="video_url"
                           class="form-control"
                           placeholder="VD: https://www.youtube.com/watch?v=...">
                </div>

                <!-- THỨ TỰ BÀI HỌC -->
                <div class="mb-3">
                    <label class="form-label">🔢 Thứ tự bài học</label>
                    <input type="number"
                           name="order"
                           class="form-control"
                           value="1">
                </div>

                <!-- BUTTON -->
                <div class="d-flex justify-content-between">
                    <a href="index.php?controller=lesson&action=manage&course_id=<?= $courseId ?>"
                       class="btn btn-outline-secondary btn-back">
                        ⬅ Quay lại
                    </a>

                    <button class="btn btn-success btn-save">
                        💾 Lưu bài học
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<?php include __DIR__ . "/../../layouts/footer.php"; ?>
