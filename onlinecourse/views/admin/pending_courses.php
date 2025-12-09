<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <title>Khóa học chờ duyệt</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            padding: 20px;
            background: #f4f4f4;
        }
        h2 {
            text-align: center;
            margin-bottom: 20px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            background: #fff;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        th {
            background: #007BFF;
            color: #fff;
        }
        tr:nth-child(even) {
            background: #f9f9f9;
        }
        a.button {
            padding: 5px 10px;
            background: green;
            color: #fff;
            text-decoration: none;
            border-radius: 4px;
        }
        a.button.reject {
            background: red;
        }
    </style>
</head>
<body>

<h2>Danh sách khóa học đang chờ duyệt</h2>

<?php if(!empty($pendingCourses)): ?>
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Tiêu đề</th>
                <th>Tác giả</th>
                <th>Ngày tạo</th>
                <th>Hành động</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach($pendingCourses as $course): ?>
                <tr>
                    <td><?= $course['id'] ?></td>
                    <td><?= htmlspecialchars($course['title']) ?></td>
                    <td><?= htmlspecialchars($course['author']) ?></td>
                    <td><?= $course['created_at'] ?></td>
                    <td>
                        <a class="button" href="index.php?controller=admin&action=approve&id=<?= $course['id'] ?>">Duyệt</a>
                        <a class="button reject" href="index.php?controller=admin&action=reject&id=<?= $course['id'] ?>">Từ chối</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
<?php else: ?>
    <p style="text-align:center;">Hiện không có khóa học nào đang chờ duyệt.</p>
<?php endif; ?>

</body>
</html>
