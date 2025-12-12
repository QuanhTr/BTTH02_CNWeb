<h2>Chào mừng <?= $_SESSION['fullname'] ?>!</h2>

<div class="container">
    <h3>Thông tin sinh viên</h3>

    <ul>
        <li><strong>Email:</strong> <?= $_SESSION['email'] ?></li>
        <li><strong>Vai trò:</strong> Student</li>
    </ul>

    <hr>

    <a href="index.php?controller=course&action=index">🎓 Xem danh sách khóa học</a><br>
    <a href="index.php?controller=student&action=myCourses">📘 Khóa học của tôi</a>
</div>
