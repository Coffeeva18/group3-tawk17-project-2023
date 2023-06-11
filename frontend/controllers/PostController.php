<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../ControllerBase.php";
require_once __DIR__ . "/../../API/business-logic/PostsService.php";
require_once __DIR__ . "/../../API/business-logic/CommentsService.php";


class PostController extends ControllerBase
{

    public function handleRequest()
    {

        // Check for POST method before checking any of the GET-routes
        if ($this->method == "POST") {
            $this->handlePost();
        }

        // GET: /frontend/posts
        if ($this->path_count == 2) {
            $this->showAll();
        }

        // GET: /home/posts/new
        else if ($this->path_count == 3 && $this->path_parts[2] == "new") {
            $this->showNewPostForm();
        }

        // GET: /home/posts/{id}
        else if ($this->path_count == 3) {
            $this->showOne();
        }

        // GET: /home/posts/{id}/edit
        else if ($this->path_count == 4 && $this->path_parts[3] == "edit") {
            $this->showEditForm();
        }

        // Show "404 not found" if the path is invalid
        else {
            $this->notFound();
        }
    }

    // Gets all posts and shows them in the index view
    private function showAll()
    {
        $this->requireAuth();

        if ($this->user->role === "admin") {
            $posts = PostsService::getAllPosts();
            $this->model = $posts;
        } else {
            $popular_posts = PostsService::getPopularPosts($this->user->id);
            $this->model["popular_posts"] = $popular_posts;
            $following_posts = PostsService::getFollowingPosts($this->user->id);
            $this->model["following_posts"] = $following_posts;
        }

        // $this->model is used for sending data to the view

        $this->viewPage("posts/index");
    }

    // Gets one post and shows the in the single view
    private function showOne()
    {
        $post = $this->getPost();
        $comments = CommentsService::getCommentsByPostId($this->path_parts[2]);
        $user = UsersService::getUserById($post->user_id);
    
        $this->model["post"] = $post;
        $this->model["comments"] = $comments;
        $this->model["user"] = $user;

        // Shows the view file posts/single.php
        $this->viewPage("posts/comment");
    }

    // Gets one and shows it in the edit view
    private function showEditForm()
    {
        //$this->requireAuth(["admin"]);

        // Get the post with the ID from the URL
        $post = $this->getPost();

        // $this->model is used for sending data to the view
        $this->model = $post;

        // Shows the view file posts/edit.php
        $this->viewPage("posts/edit");
    }

    private function showNewPostForm()
    {
        $this->requireAuth();

        // Shows the view file posts/new.php
        $this->viewPage("posts/new");
    }

    // Gets one post based on the id in the url
    private function getPost()
    {
        // Get the post with the specified ID
        $id = $this->path_parts[2];

        $post = PostsService::getPostById($id);

        if (!$post) {
            $this->notFound();
        }

        return $post;
    }


    // handle all post requests for posts in one place
    private function handlePost()
    {
        // POST: /home/posts
        if ($this->path_count == 2) {
            $this->createPost();
        }

        // POST: /home/post/{id}/edit
        else if ($this->path_count == 4 && $this->path_parts[3] == "edit") {
            $this->updatePost();
        }

        // POST: /home/post/{id}/delete
        else if ($this->path_count == 4 && $this->path_parts[3] == "delete") {
            $this->deletePost();
        }

        // Show "404 not found" if the path is invalid
        else {
            $this->notFound();
        }
    }


    // Create a post with data from the URL and body
    private function createPost()
    {
        $this->requireAuth();

        $post = new PostModel();

        $post->title = $this->body["title"];
        $post->content = $this->body["content"];
        $post->location = $this->body["location"];
        $post->likes = 0;

        // Admins can connect any user to the post
        if($this->user->role === "admin") {
            $post->user_id = $this->body["user_id"];
        }

        // Regular users can only add posts to themself
        else {
            $post->user_id = $this->user->id;
        }

        // Save the post
        $success = PostsService::savePost($post);

        // Redirect or show error based on response from business logic layer
        if ($success) {
            $this->redirect($this->home . "/auth/profile");
        } else {
            $this->error();
        }
    }


    // Update a post with data from the URL and body
    private function updatePost()
    {
        $post = new PostModel();

        // Get ID from the URL
        $id = $this->path_parts[2];

        // Get updated properties from the body
        $post->title = $this->body["title"];
        $post->content = $this->body["content"];
        $post->location = $this->body["location"];
        if (isset($this->body["user_id"])) {
            $post->user_id = $this->body["user_id"];
        } else {
            $post->user_id = $this->user->id;
        }

        $success = PostsService::updatePostById($id, $post);

        // Redirect or show error based on response from business logic layer
        if ($success) {
            $this->redirect($this->home . "/auth/profile");
        } else {
            $this->error();
        }
    }


    // Delete a post with data from the URL
    private function deletePost()
    {
        // Get ID from the URL
        $id = $this->path_parts[2];

        // Delete the post
        $success = PostsService::deletePostById($id);

        // Redirect or show error based on response from business logic layer
        if ($success) {
            $this->redirect($this->home . "/auth/profile");
        } else {
            $this->error();
        }
    }
}