<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

// Use "require_once" to load the files needed for the class

require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/../models/PostModel.php";

class PostsDatabase extends Database
{
    private $table_name = "Posts";
    private $id_name = "post_id";

    // Get one post by using the inherited function getOneRowByIdFromTable
    public function getOne($post_id)
    {
        $result = $this->getOneRowByIdFromTable($this->table_name, "id", $post_id);

        $post = $result->fetch_object();

        return $post;
    }


    // Get all posts by using the inherited function getAllRowsFromTable
    public function getAll()
    {
        $result = $this->getAllRowsFromTable($this->table_name);

        $posts = [];

        while ($post = $result->fetch_object()) {
            $posts[] = $post;
        }

        return $posts;
    }

    // Create one by creating a query and using the inherited $this->conn 
    public function getAllPostsSortedByLikes($user_id)
    {
        $user = new UsersDatabase();

        $query = "SELECT * FROM posts WHERE user_id != ? ORDER BY likes DESC LIMIT 10;";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("i", $user_id);

        $stmt->execute();

        $result = $stmt->get_result();

        $posts = [];

        while ($post = $result->fetch_object()) {
            $post->user = $user->getOne($post->user_id);
            $posts[] = $post;
        }

        return $posts;
    }

    // Create one by creating a query and using the inherited $this->conn 
    public function getAllPostsOfFollowing($user_id)
    {
        $user = new UsersDatabase();
        $follower = new FollowersDatabase();

        $following = $follower->getAllFollowingById($user_id);
        $following_ids = array_column($following, 'following_id');
        $sqlFormat = '(' . implode(', ', $following_ids) . ')';

        $query = "SELECT * FROM posts WHERE user_id IN ". $sqlFormat . "ORDER BY 1 DESC;";

        $stmt = $this->conn->prepare($query);

        $stmt->execute();

        $result = $stmt->get_result();

        $posts = [];

        while ($post = $result->fetch_object()) {
            $post->user = $user->getOne($post->user_id);
            $posts[] = $post;
        }

        return $posts;
    }

    // Get all posts by using the inherited function getAllRowsFromTable
    public function getAllPostsByUserId($user_id)
    {
        $query = "SELECT * FROM posts WHERE user_id=?;";

        $stmt = $this->conn->prepare($query);
        
        $stmt->bind_param("i", $user_id);

        $stmt->execute();

        $result = $stmt->get_result();

        $posts = [];

        while ($post = $result->fetch_object()) {
            $posts[] = $post;
        }

        return $posts;
    }

    // Create one by creating a query and using the inherited $this->conn 
    public function insert(PostModel $post)
    {
        $query = "INSERT INTO posts (title, content, likes, user_id, location) VALUES (?, ?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("ssiis", $post->title, $post->content, $post->likes, $post->user_id, $post->location);

        $success = $stmt->execute();

        return $success;
    }

    // Update one by creating a query and using the inherited $this->conn 
    public function updateById($post_id, PostModel $post)
    {
        $query = "UPDATE posts SET title=?, content=?, user_id=?, location=? WHERE id=?;";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("ssisi", $post->title, $post->content, $post->user_id, $post->location, $post_id);

        $success = $stmt->execute();

        return $success;
    }

     // Update one by creating a query and using the inherited $this->conn 
     public function updateLikesById($post_id, PostModel $post)
     {
         $query = "UPDATE posts SET likes=? WHERE id=?;";
 
         $stmt = $this->conn->prepare($query);
 
         $stmt->bind_param("ii", $post->likes, $post_id);
 
         $success = $stmt->execute();
 
         return $success;
     }
 

    // Delete one post by using the inherited function deleteOneRowByIdFromTable
    public function deleteById($post_id)
    {
        $success = $this->deleteOneRowByIdFromTable($this->table_name, "id", $post_id);

        return $success;
    }

    // Delete one post by using the inherited function deleteOneRowByIdFromTable
    public function deleteByUserId($post_id)
    {
       
    }
}
