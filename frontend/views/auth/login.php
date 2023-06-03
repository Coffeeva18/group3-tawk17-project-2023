<?php // http://localhost/group3-tawk17-project-2023
$page_title = "BlaBlaJU";

require_once __DIR__ . "/../../Template.php";

Template::header("Register user", $this->model["error"]);
?>

<form action=<?= $this->home ?>/auth/login method="post">

  <div class="container">
    <label for="uname"><b>Email</b></label>
    <input type="text" placeholder="Enter Username" name="username" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password" required>

    <button type="submit">Login</button>
    <label>
      <input type="checkbox" checked="checked" name="remember"> Remember me
    </label>
  </div>

  <div class="clearfix">
      <button class=red type="button" class="cancelbtn">Cancel</button>
      <button class=black type="button" class="signupbtn">Forgot password?</button>
    </div>
</form>

<?php Template::footer(); ?>
