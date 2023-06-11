<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../data-access/PostsDatabase.php";

class PostsService{

    // Get one post by creating a database object 
    // from data-access layer and calling its getOne function.
    public static function getPostById($id){
        $posts_database = new PostsDatabase();

        $post = $posts_database->getOne($id);

        // If you need to remove or hide data that shouldn't
        // be shown in the API response you can do that here
        // An example of data to hide is users password hash 
        // or other secret/sensitive data that shouldn't be 
        // exposed to users calling the API

        return $post;
    }

    // Get all posts by creating a database object 
    // from data-access layer and calling its getAll function.
    public static function getAllPosts(){
        $posts_database = new PostsDatabase();

        $posts = $posts_database->getAll();

        // If you need to remove or hide data that shouldn't
        // be shown in the API response you can do that here
        // An example of data to hide is users password hash 
        // or other secret/sensitive data that shouldn't be 
        // exposed to users calling the API

        return $posts;
    }

    public static function getPopularPosts($user_id){
        $posts_database = new PostsDatabase();

        $posts = $posts_database->getAllPostsSortedByLikes($user_id);

        return $posts;
    }

    public static function getFollowingPosts($user_id){
        $posts_database = new PostsDatabase();

        $posts = $posts_database->getAllPostsOfFollowing($user_id);

        // If you need to remove or hide data that shouldn't
        // be shown in the API response you can do that here
        // An example of data to hide is users password hash 
        // or other secret/sensitive data that shouldn't be 
        // exposed to users calling the API

        return $posts;
    }

     // Get all posts by creating a database object 
    // from data-access layer and calling its getAll function.
    public static function getPostsByUser($user_id){
        $posts_database = new PostsDatabase();

        $posts = $posts_database->getAllPostsByUserId($user_id);

        // If you need to remove or hide data that shouldn't
        // be shown in the API response you can do that here
        // An example of data to hide is users password hash 
        // or other secret/sensitive data that shouldn't be 
        // exposed to users calling the API

        return $posts;
    }

    // Save a post to the database by creating a database object 
    // from data-access layer and calling its insert function.
    public static function savePost(PostModel $post){
        $posts_database = new PostsDatabase();

        // If you need to validate data or control what 
        // gets saved to the database you can do that here.
        // This makes sure all input from any presentation
        // layer will be validated and handled the same way.

        $success = $posts_database->insert($post);

        return $success;
    }

    // Update the post in the database by creating a database object 
    // from data-access layer and calling its update function.
    public static function updatePostById($post_id, PostModel $post){
        $posts_database = new PostsDatabase();

        // If you need to validate data or control what 
        // gets saved to the database you can do that here.
        // This makes sure all input from any presentation
        // layer will be validated and handled the same way.

        $success = $posts_database->updateById($post_id, $post);

        return $success;
    }

    // Delete the post from the database by creating a database object 
    // from data-access layer and calling its delete function.
    public static function deletePostById($post_id){
        $posts_database = new PostsDatabase();

        // If you need to validate data or control what 
        // gets deleted from the database you can do that here.
        // This makes sure all input from any presentation
        // layer will be validated and handled the same way.

        $success = $posts_database->deleteById($post_id);

        return $success;
    }

     // Delete the post from the database by creating a database object 
    // from data-access layer and calling its delete function.
    public static function deletePostByUserId($post_id){
        $posts_database = new PostsDatabase();

        // If you need to validate data or control what 
        // gets deleted from the database you can do that here.
        // This makes sure all input from any presentation
        // layer will be validated and handled the same way.

        $success = $posts_database->deleteByUserId($post_id);

        return $success;
    }
}