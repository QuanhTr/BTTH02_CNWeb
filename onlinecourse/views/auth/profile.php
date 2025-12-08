<?php include "views/layouts/header.php"; ?>
<h2>Profile</h2>
<table class="table table-bordered">
<tr><th>Fullname</th><td><?php echo $user['fullname']; ?></td></tr>
<tr><th>Username</th><td><?php echo $user['username']; ?></td></tr>
<tr><th>Email</th><td><?php echo $user['email']; ?></td></tr>
<tr><th>Role</th>
<td>
<?php 
switch($user['role']){
    case 0: echo "Student"; break;
    case 1: echo "Instructor"; break;
    case 2: echo "Admin"; break;
}
?>
</td></tr>
</table>
<?php include "views/layouts/footer.php"; ?>
