<?php

$page_title = "BlaBlaJU";

require_once __DIR__ . "/../../Template.php";

Template::header("Home", $this->model["error"]);

?>

<section class="home-head">
    <h1 class="home-h">Share your thought<br>and join community!</h1>
    <ul class="create-h"><a href="<?= $this->home ?>/posts/new">Create Post</a></ul>
</section>
<section class="all-post-home">
    <h2 class="post-h">Popular Post</h2>
    <div class="cards-h">
        <div class="top-post">
            <h3 class="head-card">User_name</h3>
            <p class="s">2 April 2023 <time>12:00</time> </p>
        </div>
        <p>Just had the most amazing meal at a new restaurant in town. The flavors were out of this world! Highly recommend trying it out if you're a foodie like me.</p>
        <div class="bot-post">
            <p class="like">3 Likes</p>
            <a class="comment" href="">3 Comments</a></p>
            <button class="btn-post">Follow</button>
        </div>
    </div>
    <div class="cards-h">
        <div class="top-post">
            <h3 class="head-card">User_name</h3>
            <p class="s">2 April 2023 <time>12:00</time> </p>
        </div>
        <p>Spent the entire day binge-watching my favorite TV show. I can't believe I finished the entire season in one sitting. Time well spent!</p>
        <div class="bot-post">
            <p class="like">3 Likes</p>
            <a class="comment" href="">3 Comments</a></p>
            <button class="btn-post">Follow</button>
        </div>
    </div>
    <div class="cards-h">
        <div class="top-post">
            <h3 class="head-card">User_name</h3>
            <p class="s">2 April 2023 <time>12:00</time> </p>
        </div>
        <p>Finally completed my first novel after months of hard work and countless revisions. It's a surreal feeling to see my words in print. Excited to share it with the world!</p>
        <div class="bot-post">
            <p class="like">3 Likes</p>
            <a class="comment" href="">3 Comments</a></p>
            <button class="btn-post">Follow</button>
        </div>
    </div>
    <div class="cards-h">
        <div class="top-post">
            <h3 class="head-card">User_name</h3>
            <p class="s">2 April 2023 <time>12:00</time> </p>
        </div>
        <p>Just returned from a solo hiking trip in the mountains. The views were breathtaking, and the sense of solitude was truly rejuvenating. Nature has a way of healing the soul.</p>
        <div class="bot-post">
            <p class="like">3 Likes</p>
            <a class="comment" href="">3 Comments</a></p>
            <button class="btn-post">Follow</button>
        </div>
    </div>
    <div class="more"><a href="">More...</a></div>
</section>

<section class="all-post-home">
    <h2 class="post-h">Catch up with people you followed!</h2>
    <div class="cards-h">
        <div class="top-post">
            <h3 class="head-card">User_name</h3>
            <p class="s">2 April 2023 <time>12:00</time> </p>
        </div>
        <p>Just had the most amazing meal at a new restaurant in town. The flavors were out of this world! Highly recommend trying it out if you're a foodie like me.</p>
        <div class="bot-post">
            <p class="like">3 Likes</p>
            <a class="comment" href="">3 Comments</a></p>
            <button class="btn-post">Follow</button>
        </div>
    </div>
    <div class="cards-h">
        <div class="top-post">
            <h3 class="head-card">User_name</h3>
            <p class="s">2 April 2023 <time>12:00</time> </p>
        </div>
        <p>Spent the entire day binge-watching my favorite TV show. I can't believe I finished the entire season in one sitting. Time well spent!</p>
        <div class="bot-post">
            <p class="like">3 Likes</p>
            <a class="comment" href="">3 Comments</a></p>
            <button class="btn-post">Follow</button>
        </div>
    </div>
    <div class="cards-h">
        <div class="top-post">
            <h3 class="head-card">User_name</h3>
            <p class="s">2 April 2023 <time>12:00</time> </p>
        </div>
        <p>Finally completed my first novel after months of hard work and countless revisions. It's a surreal feeling to see my words in print. Excited to share it with the world!</p>
        <div class="bot-post">
            <p class="like">3 Likes</p>
            <a class="comment" href="">3 Comments</a></p>
            <button class="btn-post">Follow</button>
        </div>
    </div>
    <div class="cards-h">
        <div class="top-post">
            <h3 class="head-card">User_name</h3>
            <p class="s">2 April 2023 <time>12:00</time> </p>
        </div>
        <p>Just returned from a solo hiking trip in the mountains. The views were breathtaking, and the sense of solitude was truly rejuvenating. Nature has a way of healing the soul.</p>
        <div class="bot-post">
            <p class="like">3 Likes</p>
            <a class="comment" href="">3 Comments</a></p>
            <button class="btn-post">Follow</button>
        </div>
    </div>
    <div class="more"><a href="">More...</a></div>
</section>

<?php Template::footer(); ?>
