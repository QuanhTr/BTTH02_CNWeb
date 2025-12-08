<?php include __DIR__ . "/../layouts/header.php"; ?>
<?php include __DIR__ . "/../layouts/sidebar.php"; ?>

<section>
    <h2>Admin Dashboard</h2>

    <div class="stats">
        <div>Total Users: <?= $totalUsers ?></div>
        <div>Total Courses: <?= $totalCourses ?></div>
        <div>Total Enrollments: <?= $totalEnrollments ?></div>
    </div>

    <h3>Top Course</h3>
    <?php if($topCourse): ?>
        <div><?= htmlspecialchars($topCourse['title']) ?> — <?= $topCourse['total'] ?> enrollments</div>
    <?php else: ?>
        <div>No data</div>
    <?php endif; ?>

</section>

<?php include __DIR__ . "/../layouts/footer.php"; ?>
