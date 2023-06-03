<?php

class Template
{
    public static function header($title, $error = false)
    {
        $home_path = getHomePath();
?>
        <!DOCTYPE html>
        <html lang="en">

        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title><?= $title ?> - Multitier Shop</title>

            <link rel="stylesheet" href="<?= $home_path ?>/assets/css/style.css">

           
        </head>

        <body>
            <header>
                <h1>PROUT</h1>
            </header>

            <nav>
            </nav>

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
                Copyright 2023
            </footer>
        </body>

        </html>
<?php }
    }
