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
            <h3>✏ Sửa khóa học</h3>
            <small>Cập nhật đầy đủ thông tin khóa học</small>
        </div>

        <!-- BODY -->
        <div class="course-card-body">

            <form method="POST"
                  action="index.php?controller=instructor&action=updateCourse&id=<?= $course['id'] ?>">

                <!-- TÊN + DANH MỤC -->
                <div class="row mb-3">
                    <div class="col-md-7">
                        <label class="form-label">📘 Tên khóa học</label>
                        <input type="text"
                               name="title"
                               value="<?= htmlspecialchars($course['title']) ?>"
                               class="form-control"
                               required>
                    </div>

                    <div class="col-md-5">
                        <label class="form-label">📂 Danh mục</label>
                        <select name="category_id" class="form-select">
                            <?php foreach ($categories as $cat): ?>
                                <option value="<?= $cat['id'] ?>"
                                    <?= $cat['id'] == $course['category_id'] ? 'selected' : '' ?>>
                                    <?= htmlspecialchars($cat['name']) ?>
                                </option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>

                <!-- MÔ TẢ -->
                <div class="mb-3">
                    <label class="form-label">📝 Mô tả khóa học</label>
                    <textarea name="description"
                              class="form-control"
                              rows="4"><?= htmlspecialchars($course['description']) ?></textarea>
                </div>

                <!-- GIÁ + THỜI LƯỢNG + CẤP ĐỘ -->
                <div class="row mb-4">
                    <div class="col-md-4">
                        <label class="form-label">💰 Giá (VNĐ)</label>
                        <input type="number"
                               name="price"
                               value="<?= $course['price'] ?>"
                               class="form-control"
                               required>
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">⏱ Thời lượng (tuần)</label>
                        <input type="number"
                               name="duration_weeks"
                               value="<?= $course['duration_weeks'] ?>"
                               class="form-control">
                    </div>

                    <div class="col-md-4">
                        <label class="form-label">🎯 Cấp độ</label>
                        <select name="level" class="form-select">
                            <option value="Beginner" <?= $course['level']=='Beginner'?'selected':'' ?>>
                                Cơ bản
                            </option>
                            <option value="Intermediate" <?= $course['level']=='Intermediate'?'selected':'' ?>>
                                Trung cấp
                            </option>
                            <option value="Advanced" <?= $course['level']=='Advanced'?'selected':'' ?>>
                                Cao cấp
                            </option>
                        </select>
                    </div>
                </div>

                <!-- BUTTON -->
                <div class="d-flex justify-content-between">
                    <a href="index.php?controller=instructor&action=myCourses"
                       class="btn btn-outline-secondary btn-back">
                        ⬅ Quay lại
                    </a>

                    <button class="btn btn-warning btn-save">
                        💾 Cập nhật khóa học
                    </button>
                </div>

            </form>

        </div>
    </div>
</div>

<?php include __DIR__ . "/../../layouts/footer.php"; ?>
