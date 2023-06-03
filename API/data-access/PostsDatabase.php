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
        $result = $this->getOneRowByIdFromTable($this->table_name, $this->id_name, $post_id);

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
    public function insert(PostModel $post)
    {
        $query = "INSERT INTO posts (title, content, likes, user_id) VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("ssii", $post->title, $post->content, $post->likes, $post->user_id );

        $success = $stmt->execute();

        return $success;
    }

    // Update one by creating a query and using the inherited $this->conn 
    public function updateById($post_id, PostModel $post)
    {
        $query = "UPDATE posts SET title=?, content=?, likes=?, user_id=? WHERE id=?;";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("ssii", $post->title, $post->content, $post->likes, $post->user_id);

        $success = $stmt->execute();

        return $success;
    }

    // Delete one post by using the inherited function deleteOneRowByIdFromTable
    public function deleteById($post_id)
    {
        $success = $this->deleteOneRowByIdFromTable($this->table_name, $this->id_name, $post_id);

        return $success;
    }
}
