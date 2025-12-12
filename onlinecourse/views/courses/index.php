<h2>Danh sách khóa học</h2>

<form method="GET" action="">
    <input type="hidden" name="controller" value="course">
    <input type="hidden" name="action" value="index">

    <input type="text" name="keyword" placeholder="Tìm khóa học..." value="<?= $_GET['keyword'] ?? '' ?>">
    
    <select name="category_id">
        <option value="">-- Chọn danh mục --</option>
        <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>" 
                <?= (isset($_GET['category_id']) && $_GET['category_id'] == $cat['id']) ? 'selected' : '' ?>>
                <?= $cat['name'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <button type="submit">Lọc</button>
</form>

<hr>

<ul>
    <?php foreach ($courses as $course): ?>
        <li>
            <strong><?= $course['title'] ?></strong><br>
            Giảng viên: <?= $course['instructor_name'] ?><br>
            Giá: <?= $course['price'] ?>₫<br>

            <a href="index.php?controller=course&action=detail&id=<?= $course['id'] ?>">Xem chi tiết</a>
        </li>
        <hr>
    <?php endforeach; ?>
</ul>
