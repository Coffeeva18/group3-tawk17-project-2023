<?php // http://localhost/group3-tawk17-project-2023
$page_title = "BlaBlaJU";

require_once __DIR__ . "/../../Template.php";

Template::header("Register user", $this->model["error"]);
?>

    <form name="signUp" action=<?= $this->home ?>/auth/signup method="post" style="border:1px solid #ccc">
  <div class="container">
    <h1>Sign Up</h1>
    <p>Please fill in this form to create an account.</p>
    <hr>

    <label for="email"><b>Email</b></label>
    <input type="text" placeholder="Enter Email" name="email" id="email" required>

    <label for="username"><b>Username</b></label>
    <input type="text" placeholder="Enter Username" name="username" id="username" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="password"  id="psw" required>

    <label for="psw-repeat"><b>Repeat Password</b></label>
    <input type="password" placeholder="Repeat Password" name="confirm_password" id="psw-repeat" required>

    <p>By creating an account you agree to our <a href="#" style="color:dodgerblue">Terms & Privacy</a>.</p>

    <div class="clearfix">
      <button class="signupbtn"><a href="<?= $this->home ?>/auth/login">Log In</a></button>
      <button type="submit" class="signupbtn" value="submit">Sign Up</button>
    </div>
  </div>
</form>

<?php Template::footer(); ?>
