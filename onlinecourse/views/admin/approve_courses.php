<?php include "views/layouts/header.php"; ?>

<div class="container mt-4">
    <h2>Khóa học chờ duyệt</h2>
    <hr>

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>ID</th>
                <th>Tên khóa học</th>
                <th>Giảng viên</th>
                <th>Ngày tạo</th>
                <th>Duyệt</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($pending as $course): ?>
                <tr>
                    <td><?= $course['id'] ?></td>
                    <td><?= $course['title'] ?></td>
                    <td><?= $course['instructor_id'] ?></td>
                    <td><?= $course['created_at'] ?></td>

                    <td>
                        <a href="index.php?controller=admin&action=approve&id=<?= $course['id'] ?>"
                           class="btn btn-success btn-sm">Duyệt</a>

                        <a href="index.php?controller=admin&action=reject&id=<?= $course['id'] ?>"
                           class="btn btn-danger btn-sm">Từ chối</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

</div>

<?php include "views/layouts/footer.php"; ?>
