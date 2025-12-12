<h2>Tìm kiếm khóa học</h2>

<form method="GET" action="">
    <input type="hidden" name="controller" value="course">
    <input type="hidden" name="action" value="search">

    <input type="text" name="keyword" placeholder="Nhập từ khóa..." 
           value="<?= $_GET['keyword'] ?? '' ?>" style="width: 250px;">

    <select name="category_id">
        <option value="">-- Danh mục --</option>
        <?php foreach ($categories as $cat): ?>
            <option value="<?= $cat['id'] ?>"
                <?= (isset($_GET['category_id']) && $_GET['category_id'] == $cat['id']) ? 'selected' : '' ?>>
                <?= $cat['name'] ?>
            </option>
        <?php endforeach; ?>
    </select>

    <select name="price">
        <option value="">-- Giá --</option>
        <option value="free" <?= ($_GET['price'] ?? '') == 'free' ? 'selected' : '' ?>>Miễn phí</option>
        <option value="paid" <?= ($_GET['price'] ?? '') == 'paid' ? 'selected' : '' ?>>Có phí</option>
    </select>

    <button type="submit">Tìm kiếm</button>
</form>

<hr>

<h3>Kết quả tìm kiếm</h3>

<?php if (empty($courses)): ?>
    <p>Không tìm thấy khóa học nào phù hợp.</p>
<?php else: ?>
    <ul>
        <?php foreach ($courses as $course): ?>
            <li>
                <strong><?= $course['title'] ?></strong><br>
                Giảng viên: <?= $course['instructor_name'] ?><br>
                Danh mục: <?= $course['category_name'] ?><br>
                Giá:
                <?php if ($course['price'] == 0): ?>
                    Miễn phí
                <?php else: ?>
                    <?= $course['price'] ?>₫
                <?php endif; ?>
                <br>

                <a href="index.php?controller=course&action=detail&id=<?= $course['id'] ?>">
                    Xem chi tiết
                </a>
            </li>
            <hr>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>
