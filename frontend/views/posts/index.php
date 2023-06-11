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
    <h2 class="post-h">Popular Post</h2>
    <?php foreach ($this->model["popular_posts"] as $post) : ?>
        <div class="cards-h">
        <div class="top-post">
            <h3 class="head-card"><?= $post->user->username ?></h3>
            <h5 class="title-card"><?= $post->title ?></h5>
            <p class="s">2 April 2023 <time>12:00</time> </p>
            <a href="<?= $this->home ?>/weather/<?= $post->location ?>"><?= $post->location ?></a>
        </div>
        <p><?= $post->content ?></p>
        <div class="bot-post">
            <p class="like"><?= $post->likes ?> Likes</p>
            <a class="comment" href="<?= $this->home ?>/posts/<?= $post->id ?>">Comments</a></p>
            <?php if(!in_array($post->user_id,  array_column($this->user->following, 'following_id'))) : ?>
                <button class="btn-post">Follow</button>
            <?php else : ?>
                <button class="btn-post">Followed</button>
            <?php endif; ?>
        </div>
    </div>
    <?php endforeach; ?>
</section>

<section class="all-post-home">
    <h2 class="post-h">Catch up with people you followed!</h2>
    <?php foreach ($this->model["following_posts"] as $post) : ?>
        <div class="cards-h">
            <div class="top-post">
                <h3 class="head-card"><?= $post->user->username ?></h3>
                <h5 class="title-card"><?= $post->title ?></h5>
                <p class="s">2 April 2023 <time>12:00</time> </p>
                <a href="<?= $this->home ?>/weather/<?= $post->location ?>"><?= $post->location ?></a>
            </div>
            <p><?= $post->content ?></p>
            <div class="bot-post">
                <p class="like"><?= $post->likes ?> Likes</p>
                <a class="comment" href="<?= $this->home ?>/posts/<?= $post->id ?>">Comments</a></p>
                <button class="btn-post">Followed</button>
            </div>
        </div>
    <?php endforeach; ?>
</section>

<?php Template::footer(); ?>
