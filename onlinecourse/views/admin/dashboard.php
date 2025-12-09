<?php include __DIR__ . "/../layouts/header.php"; ?>
<?php include __DIR__ . "/../layouts/sidebar.php"; ?>

<!-- Premium Dashboard Styles -->
<style>
    body {
        background: #f5f7fa;
    }

    .dashboard-title {
        font-size: 26px;
        font-weight: 700;
        color: #2d3436;
        margin-bottom: 25px;
    }

    .stat-card {
        border-radius: 20px;
        padding: 24px;
        background: white;
        box-shadow: 0 6px 18px rgba(0,0,0,0.08);
        transition: 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card:hover {
        transform: translateY(-7px);
        box-shadow: 0 10px 26px rgba(0,0,0,0.12);
    }

    .stat-icon {
        position: absolute;
        right: 20px;
        bottom: 20px;
        font-size: 70px;
        color: rgba(0,0,0,0.06);
        transition: 0.3s ease;
    }

    .stat-card:hover .stat-icon {
        color: rgba(0,0,0,0.1);
    }

    .stat-title {
        font-size: 18px;
        font-weight: 600;
        color: #636e72;
    }

    .stat-value {
        font-size: 38px;
        font-weight: 700;
        color: #2d3436;
        margin-top: 5px;
    }

    .stat-btn {
        margin-top: 12px;
        padding: 6px 14px;
        border-radius: 10px;
        font-weight: 600;
        font-size: 14px;
    }

    /* Gradient Border Accent */
    .stat-card.accent-blue::before,
    .stat-card.accent-green::before,
    .stat-card.accent-orange::before {
        content: "";
        position: absolute;
        inset: 0;
        border-radius: 20px;
        padding: 2px;
        background: var(--gradient);
        -webkit-mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
        -webkit-mask-composite: xor;
        mask-composite: exclude;
        pointer-events: none;
    }

    .accent-blue { --gradient: linear-gradient(135deg, #4facfe, #00f2fe); }
    .accent-green { --gradient: linear-gradient(135deg, #43e97b, #38f9d7); }
    .accent-orange { --gradient: linear-gradient(135deg, #f6d365, #fda085); }
</style>

<div class="content">  
<div class="container mt-4">

    <h2 class="dashboard-title">📊 Dashboard Quản Trị</h2>

    <div class="row g-4">

        <!-- Người dùng -->
        <div class="col-md-4">
            <div class="stat-card accent-blue">
                <div class="stat-title">Người dùng</div>
                <div class="stat-value"><?= $userCount ?></div>
                <a href="index.php?controller=admin&action=users" class="btn btn-outline-primary stat-btn">
                    Quản lý
                </a>
                <i class="bi bi-people-fill stat-icon"></i>
            </div>
        </div>

        <!-- Khóa học -->
        <div class="col-md-4">
            <div class="stat-card accent-green">
                <div class="stat-title">Khóa học</div>
                <div class="stat-value"><?= $courseCount ?></div>
                <a href="index.php?controller=admin&action=approveCourses" class="btn btn-outline-success stat-btn">
                    Duyệt khóa học
                </a>
                <i class="bi bi-journal-bookmark-fill stat-icon"></i>
            </div>
        </div>

        <!-- Chờ duyệt -->
        <div class="col-md-4">
            <div class="stat-card accent-orange">
                <div class="stat-title">Khóa học chờ duyệt</div>
                <div class="stat-value"><?= $pendingCourses ?></div>
                <a href="index.php?controller=admin&action=pendingCourses" class="btn btn-outline-warning stat-btn">
                    Xem danh sách
                </a>
                <i class="bi bi-hourglass-split stat-icon"></i>
            </div>
        </div>

    </div>
</div>
</div>
<?php include __DIR__ . "/../layouts/footer.php"; ?>
