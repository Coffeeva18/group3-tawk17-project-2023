<?php

$page_title = "BlaBlaJU";

require_once __DIR__ . "/../../Template.php";

Template::header("Profile");

?>

<section class="pro-head">
    <h1 class="user-n"><?= $this->user->username ?></h1>
    <div class="pro-f">
        <div class="wrap-f">
            <h3>Total Post</h3>
            <p><?= count($this->model) ?></p>
        </div>
    </div>
</section>
<section class="pro-nav">
    <ul>All Posts</ul>
    <ul><a href="<?= $this->home ?>/posts/new">New Posts</a></ul>
</section>
<section class="all-post">
    <?php foreach ($this->model as $post) : ?>
        <div class="cards">
            <div class="top-post">
                <h3 class="head-card"><?= $this->user->username ?></h3>
                <h5 class="title-card"><?= $post->title ?></h5>
                <p class="s">2 April 2023 <time>12:00</time> </p>
                <a href="<?= $this->home ?>/weather/<?= $post->location ?>"><?= $post->location ?></a>
            </div>
            <p><?= $post->content ?></p>
            <form action="<?= $this->home ?>/posts/<?= $post->id ?>/delete" method="post">
            <div class="bot-post">
                    <p class="like"><?= $post->likes ?> Likes</p>
                    <a class="comment" href="<?= $this->home ?>/posts/<?= $post->id ?>">Comments</a></p>
                    <a class="btn-post" href="<?= $this->home ?>/posts/<?= $post->id ?>/edit">Edit</a>
                    <input type="submit" value="Delete" class="btn-post">
                </div>
            </form>
        </div>
    <?php endforeach; ?>
</section>

<?php Template::footer(); ?>