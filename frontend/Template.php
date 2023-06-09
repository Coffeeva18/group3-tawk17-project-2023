<?php

class Template
{
    public static function header($title, $error = false)
    {
        $home_path = getHomePath();
        $user = getUser();
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta http-equiv="X-UA-Compatible" content="IE=edge">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?= $title ?> - Blablaju </title>

            <link rel="stylesheet" href="<?= $home_path ?>/assets/css/style.css">

            <script src="<?= $home_path ?>/assets/js/script.js"></script>
        </head>

        <body>
            <nav class="nav-bg">
                <a href="<?= $home_path ?>/posts">Posts</a>
                <a href="<?= $home_path ?>/posts">About Us</a>
                
                
                <?php if ($user) : ?>
                    <a href="<?= $home_path ?>/auth/profile">Profile</a>
                    <form name="signUp" action=<?= $home_path ?>/auth/logout method="post">
                        <button type="submit" class="logout" value="submit">Disconnect</button>
                    </form>
                <?php else : ?>
                    <a href="<?= $home_path ?>/auth/login">Log in</a>
                <?php endif; ?>
            </nav>

            <h1><?= $title; ?></h1>


            <main>

                <?php if ($error) : ?>
                    <div class="error">
                        <p><?= $error ?></p>
                    </div>
                <?php endif; ?>

            <?php }



        public static function footer()
        {
            ?>
            </main>
            <footer>
                Copyright 2025
            </footer>
        </body>

        </html>
<?php }
    }
