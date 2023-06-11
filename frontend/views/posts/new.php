<?php
require_once __DIR__ . "/../../Template.php";

Template::header("New Post");
?>

<form action="<?= $this->home ?>/posts" method="post">
    <input type="text" name="title" placeholder="Post title"> <br>
    <input type="text" name="content" placeholder="Content"> <br>
    <input type="text" name="location" placeholder="Jonkoping"> <br>

    <?php if ($this->user->role === "admin") : ?>
        <input type="number" name="user_id" placeholder="User ID"> <br>
    <?php endif; ?>

    <input type="submit" value="Save" class="btn">
</form>

<?php Template::footer(); ?>