<h2>Danh sách khóa học</h2>
<?php if($_SESSION['role']==1): ?>
<a href="index.php?controller=course&action=create">Tạo khóa học mới</a>
<?php endif; ?>
<table border="1" cellpadding="5">
<tr>
    <th>Title</th>
    <th>Instructor</th>
    <th>Price</th>
    <th>Actions</th>
</tr>
<?php foreach($courses as $course): ?>
<tr>
    <td><?php echo $course['title']; ?></td>
    <td><?php echo $course['instructor_name']; ?></td>
    <td><?php echo $course['price']; ?></td>
    <td>
        <a href="index.php?controller=course&action=detail&id=<?php echo $course['id']; ?>">Detail</a>
        <?php if($_SESSION['role']==1): ?>
        | <a href="index.php?controller=course&action=edit&id=<?php echo $course['id']; ?>">Edit</a>
        | <a href="index.php?controller=course&action=delete&id=<?php echo $course['id']; ?>">Delete</a>
        <?php endif; ?>
        <?php if($_SESSION['role']==0): ?>
        | <a href="index.php?controller=enrollment&action=enroll&course_id=<?php echo $course['id']; ?>">Enroll</a>
        <?php endif; ?>
    </td>
</tr>
<?php endforeach; ?>
</table>
