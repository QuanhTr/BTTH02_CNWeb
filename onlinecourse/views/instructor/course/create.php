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
            <h3>➕ Thêm khóa học mới</h3>
            <small>Nhập đầy đủ thông tin để tạo khóa học</small>
        </div>

        <!-- BODY -->
        <div class="course-card-body">

            <form method="post" action="index.php?controller=instructor&action=store">

                <!-- TÊN + DANH MỤC -->
                <div class="row mb-3">
                    <div class="col-md-7">
                        <label class="form-label">📘 Tên khóa học</label>
                        <input type="text"
                               name="title"
                               class="form-control"
                               placeholder="VD: Lập trình PHP từ cơ bản đến nâng cao"
                               required>
                    </div>

                    <div class="col-md-5">
                        <label class="form-label">📂 Danh mục</label>
                        <select name="category_id" class="form-select">
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>">
                                    <?= htmlspecialchars($cat['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- MÔ TẢ -->
                <div class="mb-4">
                    <label class="form-label">📝 Mô tả khóa học</label>
                    <textarea name="description"
                              rows="4"
                              class="form-control"
                              placeholder="Mô tả ngắn gọn nội dung khóa học..."></textarea>
                </div>

                <!-- GIÁ – THỜI LƯỢNG – CẤP ĐỘ -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label class="form-label">💰 Giá (VNĐ)</label>
                        <input type="number" name="price" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">⏱ Thời lượng (tuần)</label>
                        <input type="number" name="duration_weeks" class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">🎯 Cấp độ</label>
                        <select name="level" class="form-select">
                            <option>Cơ bản</option>
                            <option>Trung cấp</option>
                            <option>Cao cấp</option>
                        </select>
                    </div>
                </div>

                <!-- BUTTON -->
                <div class="d-flex justify-content-between">
                    <a href="index.php?controller=instructor&action=myCourses"
                       class="btn btn-outline-secondary btn-back">
                        ⬅ Quay lại
                    </a>

                    <button class="btn btn-success btn-save">
                        💾 Lưu khóa học
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<?php include __DIR__ . "/../../layouts/footer.php"; ?>
