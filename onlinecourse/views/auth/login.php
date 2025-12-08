<?php include "views/layouts/header.php"; ?>
<h2>Login</h2>
<?php if(isset($error)) echo "<div class='alert alert-danger'>$error</div>"; ?>
<form method="POST">
  <div class="mb-3">
    <label>Username or Email</label>
    <input type="text" name="username_email" class="form-control" required>
  </div>
  <div class="mb-3">
    <label>Password</label>
    <input type="password" name="password" class="form-control" required>
  </div>
  <button type="submit" class="btn btn-primary">Login</button>
</form>
<p class="mt-3">No account? <a href="index.php?controller=auth&action=register">Register</a></p>
<?php include "views/layouts/footer.php"; ?>
