<?php

$page_title = "BlaBlaJU";

require_once __DIR__ . "/../../Template.php";

Template::header("Posts");

?>

<section class="home-head">
    <h1 class="home-h">Share your thought<br>and join community!</h1>
    <ul class="create-h"><a href="<?= $this->home ?>/posts/new">Create Post</a></ul>
</section>
<section class="all-post-home">
    <h2 class="post-h">Posts</h2>
    <?php foreach ($this->model as $post) : ?>
        <div class="cards-h">
        <div class="top-post">
            <h3 class="head-card"><?= $post->user_id ?></h3>
            <h5 class="title-card"><?= $post->title ?></h5>
            <p class="s">2 April 2023 <time>12:00</time> </p>
            <a href="<?= $this->home ?>/weather/<?= $post->location ?>"><?= $post->location ?></a>
        </div>
        <p><?= $post->content ?></p>
        <form action="<?= $this->home ?>/posts/<?= $post->id ?>/delete" method="post">
        <div class="bot-post">
            <p class="like"><?= $post->likes ?> Likes</p>
            <p><a class="comment" href="<?= $this->home ?>/posts/<?= $post->id ?>">Comments</a></p>
            <input type="submit" value="Delete" class="btn-post"/>
        </div>
        </form>
        <form action="<?= $this->home ?>/auth/<?= $post->user_id ?>/delete" method="post">
            <input type="submit" value="Delete User" class="de-user"/>
        </form>
    </div>
    <?php endforeach; ?>
</section>

<?php Template::footer(); ?>