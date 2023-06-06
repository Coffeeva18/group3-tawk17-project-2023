<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Document</title>
        <link href="http://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0">
        <link rel="stylesheet" href="style.css">
    </head>
    <body>
        <header>
            <nav>
                <div>
                    <h3>BRAND NAME</h3>
                    <ul class="menu-main">
                        <li><a href="index.php">HOME</a></li>
                        <li><a href="#">PROFILE</a></li>
                        <li><a href="#">Sing In</a></li>
                    </ul>
                </div>
                <ul class="menu-member">
                    <?php
                    if(isset($_SESSION["userid"]))
                    {
                        ?>
                        <li><a href="#"><?php echo $_SESSION["useruid"]; ?></a></li>
                        <li><a href="includes/logout.inc.php" class="header-login-a">LOGOUT</a></li>
                        <?php
                    }
                    else
                    {
                        ?>
                        <li><a href="#">SIGN UP</a></li>
                        <li><a href="#" class="header-login-a">LOGIN</a></li>
                        <?php
                    }
                    ?>
                </ul>
            </nav>
        </header>
    </body>
</html>