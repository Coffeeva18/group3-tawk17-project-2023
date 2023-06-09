<?php

$page_title = "BlaBlaJU";

require_once __DIR__ . "/../../Template.php";

Template::header("Profile", $this->model["error"]);

?>

<section class="index-intro">
    <div class="index-intro-bg">
        <div class="wrapper">
            <div class="index-intro-c1">
                <div class="video"></div>
                <p>aaaaa</p>
            </div>
            <div class="index-intro-c2">
                <h2>AAAA</h2>
            </div>
        </div>

        <a href="<?= $this->home ?>/posts/new">New Posts</a>

        <table></table>
    </div>
</section>

<?php Template::footer(); ?>
