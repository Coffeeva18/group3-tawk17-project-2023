<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/RestAPI.php";
require_once __DIR__ . "/../business-logic/PostsService.php";

// Class for handling requests to "api/Post"

class PostsAPI extends RestAPI
{

    // Handles the request by calling the postropriate member function
    public function handleRequest()
    {

        
        // If theres two parts in the path and the request method is GET 
        // it means that the client is requesting "api/Posts" and
        // we should respond by returning a list of all posts 
        if ($this->method == "GET" && $this->path_count == 2) {
            $this->getAll();
        } 

        // If there's three parts in the path and the request method is GET
        // it means that the client is requesting "api/Posts/{something}".
        // In our API the last part ({something}) should contain the ID of a 
        // post and we should respond with the post of that ID
        else if ($this->path_count == 3 && $this->method == "GET") {
            $this->getById($this->path_parts[2]);
        }

        // If theres two parts in the path and the request method is POST 
        // it means that the client is requesting "api/Posts" and we
        // should get ths contents of the body and create a post.
        else if ($this->path_count == 2 && $this->method == "POST") {
            $this->postOne();
        }

        // If theres two parts in the path and the request method is PUT 
        // it means that the client is requesting "api/Posts/{something}" and we
        // should get the contents of the body and update the post.
        else if ($this->path_count == 3 && $this->method == "PUT") {
            $this->putOne($this->path_parts[2]);
        } 

        // If theres two parts in the path and the request method is DELETE 
        // it means that the client is requesting "api/Posts/{something}" and we
        // should get the ID from the URL and delete that post.
        else if ($this->path_count == 3 && $this->method == "DELETE") {
            $this->deleteOne($this->path_parts[2]);
        } 
        
        // If none of our ifs are true, we should respond with "not found"
        else {
            $this->notFound();
        }
    }

    // Gets all posts and sends them to the client as JSON
    private function getAll()
    {
        $posts = PostsService::getAllPosts();

        $this->sendJson($posts);
    }

    // Gets one and sends it to the client as JSON
    private function getById($id)
    {
        $post = PostsService::getPostById($id);

        if ($post) {
            $this->sendJson($post);
        }
        else {
            $this->notFound();
        }
    }

    // Gets the contents of the body and saves it as a post by 
    // inserting it in the database.
    private function postOne()
    {
        $post = new PostModel();

        $post->title = $this->body["title"];
        $post->content = $this->body["content"];
        $post->likes = $this->body["likes"];
        $post->user_id = $this->body["user_id"];

        $success = PostsService::savePost($post);

        if($success){
            $this->created();
        }
        else{
            $this->error();
        }
    }

    // Gets the contents of the body and updates the post
    // by sending it to the DB
    private function putOne($id)
    {
        $post = new PostModel();

        $post->title = $this->body["post_name"];
        $post->content = $this->body["content"];
        $post->likes = $this->body["likes"];
        $post->user_id = $this->body["user_id"];

        $success = PostsService::updatePostById($id, $post);

        if($success){
            $this->ok();
        }
        else{
            $this->error();
        }
    }

    // Deletes the post with the specified ID in the DB
    private function deleteOne($id)
    {
        $post = PostsService::getPostById($id);

        if($post == null){
            $this->notFound();
        }

        $success = PostsService::deletePostById($id);

        if($success){
            $this->noContent();
        }
        else{
            $this->error();
        }
    }
}
