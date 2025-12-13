<?php include "views/layouts/header.php"; ?>

<div class="container mt-4">
    <h2>Danh mục khóa học</h2>
    <hr>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên danh mục</th>
                <th>Hành động</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($categories as $c): ?>
                <tr>
                    <td><?= $c['id'] ?></td>
                    <td><?= $c['name'] ?></td>
                    <td>
                        <a href="index.php?controller=admin&action=deleteCategory&id=<?= $c['id'] ?>"
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Bạn chắc chắn xóa?');">
                           Xóa
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<?php include "views/layouts/footer.php"; ?>
