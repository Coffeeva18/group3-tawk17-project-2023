<?php
require_once __DIR__ . "/../../Template.php";

Template::header("Edit Post");
?>

<form action="<?= $this->home ?>/posts/<?= $this->model->id ?>/edit" method="post">
    <input type="text" name="title" placeholder="Post title" value="<?=$this->model->title ?>"><br>
    <input type="text" name="content" placeholder="Content" value="<?= $this->model->content ?>"> <br>
    <input type="text" name="location" placeholder="Jonkoping" value="<?=$this->model->location ?>"> <br>

    <?php if ($this->user->role === "admin") : ?>
        <input type="number" name="user_id" placeholder="User ID"> <br>
    <?php endif; ?>

    <input type="submit" value="Save" class="btn">
</form>

<?php Template::footer(); ?>