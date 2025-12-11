<?php include __DIR__ . "/../../layouts/header.php"; ?>
<?php include __DIR__ . "/../../layouts/sidebar.php"; ?>

<style>
.content-wrapper {
    margin-left: 260px;
    padding: 30px;
    background: #f4f6f9;
    min-height: 100vh;
}
.card-custom {
    border-radius: 14px;
    border: none;
    box-shadow: 0 3px 12px rgba(0,0,0,0.08);
}
.table-hover tbody tr:hover {
    background: #f1f1f1;
    transition: 0.2s;
}
.badge-role {
    padding: 6px 10px;
    border-radius: 10px;
}
.action-btn {
    padding: 4px 8px;
}
.search-input {
    width: 300px;
}
</style>

<div class="content-wrapper">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h3 class="fw-bold text-primary">
            <i class="fas fa-users me-2"></i>Quản lý người dùng
        </h3>

        <input id="searchInput" type="text" class="form-control search-input" placeholder="🔍 Tìm theo tên hoặc email...">
    </div>

    <div class="card card-custom p-3">

        <table class="table table-bordered table-striped table-hover align-middle" id="userTable">
            <thead class="table-dark">
                <tr>
                    <th width="60">ID</th>
                    <th>Họ tên</th>
                    <th>Email</th>
                    <th width="150">Vai trò</th>
                    <th width="120">Trạng thái</th>
                    <th width="160">Hành động</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($users as $u): ?>
                <tr>
                    <td><?= $u['id'] ?></td>

                    <td>
                        <i class="fas fa-user-circle text-secondary"></i>
                        <strong><?= $u['fullname'] ?></strong>
                    </td>

                    <td><?= $u['email'] ?></td>

                    <td>
                        <?php if ($u['role'] == 2): ?>
                            <span class="badge bg-danger badge-role">Quản trị</span>
                        <?php elseif ($u['role'] == 1): ?>
                            <span class="badge bg-primary badge-role">Giảng viên</span>
                        <?php else: ?>
                            <span class="badge bg-success badge-role">Học viên</span>
                        <?php endif; ?>
                    </td>

                    <td>
                        <?php if ($u['active'] == 1): ?>
                            <span class="badge bg-success">Hoạt động</span>
                        <?php else: ?>
                            <span class="badge bg-secondary">Bị khóa</span>
                        <?php endif; ?>
                    </td>

                    <td>

                        <!-- Xem chi tiết -->
                        <a href="index.php?controller=admin&action=userDetail&id=<?= $u['id'] ?>" 
                           class="btn btn-sm btn-info text-white action-btn">
                            <i class="fas fa-eye"></i>
                        </a>

                        <!-- Đổi role -->
                        <form action="index.php?controller=admin&action=changeRole" method="POST" class="d-inline">
                            <input type="hidden" name="id" value="<?= $u['id'] ?>">
                            <select name="role" class="form-select form-select-sm d-inline" style="width: 90px;"
                                    onchange="this.form.submit()">
                                <option value="0" <?= $u['role']==0?"selected":"" ?>>HV</option>
                                <option value="1" <?= $u['role']==1?"selected":"" ?>>GV</option>
                                <option value="2" <?= $u['role']==2?"selected":"" ?>>QT</option>
                            </select>
                        </form>

                        <!-- Bật/tắt hoạt động -->
                        <form action="index.php?controller=admin&action=toggleActive" method="POST" class="d-inline">
                            <input type="hidden" name="id" value="<?= $u['id'] ?>">
                            <button class="btn btn-sm <?= $u['active']? 'btn-danger':'btn-success' ?> action-btn">
                                <?= $u['active']? 'Khóa':'Mở' ?>
                            </button>
                        </form>

                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

    </div>

</div>

<script>
// Tìm kiếm real-time
document.getElementById('searchInput').addEventListener('keyup', function() {
    let value = this.value.toLowerCase();
    document.querySelectorAll('#userTable tbody tr').forEach(row => {
        row.style.display = row.innerText.toLowerCase().includes(value) ? '' : 'none';
    });
});
</script>

<?php include __DIR__ . "/../../layouts/footer.php"; ?>
