<?php include __DIR__ . "/../layouts/header.php"; ?>

<style>
.course-container {
    max-width: 1200px;
    margin: 30px auto;
}

.course-title {
    font-size: 26px;
    font-weight: 700;
    margin-bottom: 20px;
}

.course-grid {
    display: grid;
    grid-template-columns: repeat(auto-fill, minmax(320px, 1fr));
    gap: 22px;
}

.course-card {
    background: #fff;
    border-radius: 14px;
    overflow: hidden;
    box-shadow: 0 6px 18px rgba(0,0,0,0.08);
    transition: 0.25s;
}

.course-card:hover {
    transform: translateY(-6px);
}

.course-img img {
    width: 100%;
    height: 180px;
    object-fit: cover;
}

.course-body {
    padding: 18px;
}

.course-name {
    font-size: 18px;
    font-weight: 700;
    color: #0984e3;
    margin-bottom: 6px;
}

.course-desc {
    font-size: 14px;
    color: #555;
    line-height: 1.5;
    margin-bottom: 10px;
}

.course-meta {
    font-size: 13px;
    color: #636e72;
    margin-bottom: 5px;
}

.course-price {
    font-size: 16px;
    font-weight: 700;
    color: #00b894;
    margin-top: 10px;
}

.course-actions {
    padding: 15px;
    display: flex;
    justify-content: space-between;
    border-top: 1px solid #eee;
}

.btn {
    padding: 7px 14px;
    border-radius: 8px;
    font-size: 14px;
    text-decoration: none;
    font-weight: 600;
}

.btn-detail {
    background: #0984e3;
    color: #fff;
}

.btn-enroll {
    background: #00b894;
    color: #fff;
}

.empty {
    text-align: center;
    margin-top: 40px;
    color: #777;
}
</style>

<div class="course-container">
    <div class="course-title">📚 Danh sách khóa học</div>

    <?php if (empty($courses)): ?>
        <div class="empty">Chưa có khóa học nào.</div>
    <?php else: ?>
        <div class="course-grid">
            <?php foreach ($courses as $c): ?>
                <div class="course-card">

                    <div class="course-img">
                        <img src="assets/uploads/courses/<?= $c['image'] ?: 'default.jpg' ?>">
                    </div>

                    <div class="course-body">
                        <div class="course-name">
                            <?= htmlspecialchars($c['title']) ?>
                        </div>

                        <div class="course-desc">
                            <?= htmlspecialchars(substr($c['description'], 0, 120)) ?>...
                        </div>

                        <!-- <div class="course-meta">👨‍🏫 Giảng viên: <?= $c['instructor_name'] ?></div>
                        <div class="course-meta">📂 Danh mục: <?= $c['category_name'] ?></div> -->
                        <div class="course-meta">⏱ <?= $c['duration_weeks'] ?> tuần</div>
                        <div class="course-meta">🎯 Trình độ: <?= $c['level'] ?></div>

                        <div class="course-price">
                            💰 <?= number_format($c['price']) ?> VNĐ
                        </div>
                    </div>

                    <div class="course-actions">
                        <a class="btn btn-detail"
                           href="index.php?controller=course&action=detail&id=<?= $c['id'] ?>">
                           Chi tiết
                        </a>

                        <a class="btn btn-enroll"
                        href="index.php?controller=enroll&action=enroll&course_id=<?= $c['id'] ?>">
                        Đăng ký
                        </a>

                    </div>

                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<?php include __DIR__ . "/../layouts/footer.php"; ?>
