<?php include "views/layouts/header.php"; ?>
<h2>Register</h2>
<form method="POST">
  <div class="mb-3">
    <label>Fullname</label>
    <input type="text" name="fullname" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Username</label>
    <input type="text" name="username" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Email</label>
    <input type="email" name="email" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Password</label>
    <input type="password" name="password" class="form-control" required>
  </div>
  <button type="submit" class="btn btn-success">Register</button>
</form>
<p class="mt-3">Already have an account? <a href="index.php?controller=auth&action=login">Login</a></p>
<?php include "views/layouts/footer.php"; ?>
