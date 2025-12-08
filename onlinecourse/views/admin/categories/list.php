<h2>Danh sách danh mục</h2>

<a href="index.php?controller=category&action=create" class="btn btn-success">
    + Thêm danh mục
</a>

<table border="1" cellpadding="10" style="margin-top:20px;">
    <tr>
        <th>ID</th>
        <th>Tên danh mục</th>
        <th>Mô tả</th>
        <th>Thao tác</th>
    </tr>

    <?php foreach ($categories as $c): ?>
        <tr>
            <td><?= $c['id'] ?></td>
            <td><?= $c['name'] ?></td>
            <td><?= $c['description'] ?></td>
            <td>
                <a href="index.php?controller=category&action=edit&id=<?= $c['id'] ?>">Sửa</a> |
                <a href="index.php?controller=category&action=delete&id=<?= $c['id'] ?>" 
                   onclick="return confirm('Bạn chắc chắn muốn xóa?')">Xóa</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
