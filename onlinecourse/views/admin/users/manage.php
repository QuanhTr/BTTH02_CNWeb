<?php include __DIR__ . "/../../layouts/header.php"; ?>
<?php include __DIR__ . "/../../layouts/sidebar.php"; ?>

<section class="admin-users">
    <h2>Quản lý người dùng</h2>

    <form method="GET" action="index.php">
        <input type="hidden" name="controller" value="admin">
        <input type="hidden" name="action" value="users">
        <input type="text" name="keyword" placeholder="Tìm username hoặc email" value="<?= htmlspecialchars($_GET['keyword'] ?? '') ?>">
        <button type="submit">Tìm</button>
    </form>

    <table border="1" cellpadding="6" cellspacing="0">
        <tr>
            <th>ID</th><th>Username</th><th>Email</th><th>Role</th><th>Active</th><th>Hành động</th>
        </tr>
        <?php foreach($users as $u): ?>
            <tr>
                <td><?= $u['id'] ?></td>
                <td><?= htmlspecialchars($u['username']) ?></td>
                <td><?= htmlspecialchars($u['email']) ?></td>
                <td>
                    <form method="POST" action="index.php?controller=admin&action=changeRole">
                        <input type="hidden" name="id" value="<?= $u['id'] ?>">
                        <select name="role" onchange="this.form.submit()">
                            <option value="0" <?= $u['role']==0 ? 'selected' : '' ?>>Student</option>
                            <option value="1" <?= $u['role']==1 ? 'selected' : '' ?>>Instructor</option>
                            <option value="2" <?= $u['role']==2 ? 'selected' : '' ?>>Admin</option>
                        </select>
                    </form>
                </td>
                <td><?= isset($u['active']) && $u['active'] ? 'Yes' : 'No' ?></td>
                <td>
                    <a href="index.php?controller=admin&action=toggleUser&id=<?= $u['id'] ?>">Bật/Tắt</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</section>

<?php include __DIR__ . "/../../layouts/footer.php"; ?>
