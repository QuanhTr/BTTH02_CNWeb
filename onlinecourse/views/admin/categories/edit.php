<h2>Sửa danh mục</h2>

<form method="post" action="index.php?controller=category&action=update">
    <input type="hidden" name="id" value="<?= $category['id'] ?>">

    <label>Tên danh mục:</label><br>
    <input type="text" name="name" value="<?= $category['name'] ?>" required><br><br>

    <label>Mô tả:</label><br>
    <textarea name="description"><?= $category['description'] ?></textarea><br><br>

    <button type="submit">Cập nhật</button>
</form>
