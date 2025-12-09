<?php include __DIR__ . "/../../layouts/header.php"; ?>
<?php include __DIR__ . "/../../layouts/sidebar.php"; ?>

<div class="container mt-4">
    <h2>Quản lý người dùng</h2>
    <hr>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Họ tên</th>
                <th>Email</th>
                <th>Vai trò</th>
                <th>Trạng thái</th>
                <th>Hành động</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($users as $u): ?>
                <tr>
                    <td><?= $u['id'] ?></td>
                    <td><?= $u['fullname'] ?></td>
                    <td><?= $u['email'] ?></td>
                    <td>
                        <?php
                        echo ($u['role'] == 2) ? "Quản trị" :
                             ($u['role'] == 1 ? "Giảng viên" : "Học viên");
                        ?>
                    </td>

                    <td>
                        <?= $u['active'] ? "<span class='badge bg-success'>Hoạt động</span>" :
                                           "<span class='badge bg-secondary'>Vô hiệu</span>" ?>
                    </td>

                    <td>
                        <a href="index.php?controller=admin&action=toggleUser&id=<?= $u['id'] ?>" 
                           class="btn btn-sm btn-warning">
                           Đổi trạng thái
                        </a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>


<?php include __DIR__ . "/../../layouts/footer.php"; ?>
