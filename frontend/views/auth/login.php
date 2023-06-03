<?php // http://localhost/group3-tawk17-project-2023
$page_title = "BlaBlaJU";

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <title><?= $page_title ?></title>
</head>

<body>
    <header>
        <h1><?= $page_title ?></h1>
    </header>

<form action="action_page.php" method="post">

  <div class="container">
    <label for="uname"><b>Email</b></label>
    <input type="text" placeholder="Enter Username" name="uname" required>

    <label for="psw"><b>Password</b></label>
    <input type="password" placeholder="Enter Password" name="psw" required>

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

</body>

</html>