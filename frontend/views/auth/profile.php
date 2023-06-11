<?php

$page_title = "BlaBlaJU";

require_once __DIR__ . "/../../Template.php";

Template::header("Profile", $this->model["error"]);

?>

<section class="pro-head">
    <h1 class="user-n">User_name</h1>
    <div class="pro-f">
        <div class="wrap-f">
            <h3>Follower</h3>
            <p>3</p>
        </div>
        <div class="wrap-f">
            <h3>Following</h3>
            <p>3</p>
        </div>
        <div class="wrap-f">
            <h3>Total Post</h3>
            <p>3</p>
        </div>
    </div>
</section>
<section class="pro-nav">
    <ul>All Posts</ul>
    <ul><a href="<?= $this->home ?>/posts/new">New Posts</a></ul>
</section>
<section class="all-post">
    <div class="cards">
        <div class="top-post">
            <h3 class="head-card">User_name</h3>
            <p class="s">2 April 2023 <time>12:00</time> </p>
        </div>
        <p>Just had the most amazing meal at a new restaurant in town. The flavors were out of this world! Highly recommend trying it out if you're a foodie like me.</p>
        <div class="bot-post">
            <p class="like">3 Likes</p>
            <a class="comment" href="">3 Comments</a></p>
            <button class="btn-post">Edit</button>
            <button class="btn-post">Delete</button>
        </div>
    </div>
    <div class="cards">
        <div class="top-post">
            <h3 class="head-card">User_name</h3>
            <p class="s">2 April 2023 <time>12:00</time> </p>
        </div>
        <p>Spent the entire day binge-watching my favorite TV show. I can't believe I finished the entire season in one sitting. Time well spent!</p>
        <div class="bot-post">
            <p class="like">3 Likes</p>
            <a class="comment" href="">3 Comments</a></p>
            <button class="btn-post">Edit</button>
            <button class="btn-post">Delete</button>
        </div>
    </div>
    <div class="cards">
        <div class="top-post">
            <h3 class="head-card">User_name</h3>
            <p class="s">2 April 2023 <time>12:00</time> </p>
        </div>
        <p>Finally completed my first novel after months of hard work and countless revisions. It's a surreal feeling to see my words in print. Excited to share it with the world!</p>
        <div class="bot-post">
            <p class="like">3 Likes</p>
            <a class="comment" href="">3 Comments</a></p>
            <button class="btn-post">Edit</button>
            <button class="btn-post">Delete</button>
        </div>
    </div>
    <div class="cards">
        <div class="top-post">
            <h3 class="head-card">User_name</h3>
            <p class="s">2 April 2023 <time>12:00</time> </p>
        </div>
        <p>Just returned from a solo hiking trip in the mountains. The views were breathtaking, and the sense of solitude was truly rejuvenating. Nature has a way of healing the soul.</p>
        <div class="bot-post">
            <p class="like">3 Likes</p>
            <a class="comment" href="">3 Comments</a></p>
            <button class="btn-post">Edit</button>
            <button class="btn-post">Delete</button>
        </div>
    </div>
</section>

<?php Template::footer(); ?>
