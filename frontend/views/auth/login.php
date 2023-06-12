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

    <button class="signupbtn" type="submit">Login</button>

    <div class="clearfix">
    <button class="signupbtn"><a href="<?= $this->home ?>/auth/signup">Sign Up</a></button>
    </div>
  </div>
</form>

<?php Template::footer(); ?>
