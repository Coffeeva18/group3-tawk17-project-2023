<?php

$page_title = "BlaBlaJU";

require_once __DIR__ . "/../../Template.php";

Template::header("Comments Of Posts");

?>

<section class="select-p">
        <div class="cards">
            <div class="top-post">
                <h3 class="head-card"><?= $this->model["user"]->username ?></h3>
                <h5 class="title-card"><?= $this->model["post"]->title ?></h5>
                <p class="s">2 April 2023 <time>12:00</time> </p>
            </div>
            <p><?= $this->model["post"]->content ?></p>
            <div class="bot-post">
                <p class="like"> <?= $this->model["post"]->likes ?> likes</p>
            </div>
        </div>
</section>

<section>
    <div class="cards">
        <form action="<?= $this->home ?>/comments/" method="post">
            <h2 class="head-card">Post a new comment</h2>
            <h3 class="head-card"><?= $this->user->username ?></h3>
            <input type="hidden" name="post_id" value="<?= $this->model["post"]->id ?>">
            <input type="text" name="content" placeholder="Content">
            <button type="submit" class="comment" value="submit">Send</button>
        </form>
    </div>
</section>

<section class="cards">
    <?php foreach ($this->model["comments"] as $comment) : ?>
        <div class="comment-p">
            <h3 class="head-card"><?= $comment->user->username ?></h3>
            <p><?=$comment->content ?></p>

            <?php if ($this->user->id === $comment->user_id) : ?>
                <form action="<?= $this->home ?>/comments/<?= $comment->id ?>/delete" method="post">
                    <input type="submit" value="Delete" class="btn-post">
                </form>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>
</section>


<?php Template::footer(); ?>
