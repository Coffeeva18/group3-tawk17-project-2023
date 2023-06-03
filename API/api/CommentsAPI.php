<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/RestAPI.php";
require_once __DIR__ . "/../business-logic/CommentsService.php";

// Class for handling requests to "api/Comment"

class CommentsAPI extends RestAPI
{

    // Handles the request by calling the commentropriate member function
    public function handleRequest()
    {

        
        // If theres two parts in the path and the request method is GET 
        // it means that the client is requesting "api/Comments" and
        // we should respond by returning a list of all comments 
        if ($this->method == "GET" && $this->path_count == 2) {
            $this->getAll();
        } 

        // If there's three parts in the path and the request method is GET
        // it means that the client is requesting "api/Comments/{something}".
        // In our API the last part ({something}) should contain the ID of a 
        // comment and we should respond with the comment of that ID
        else if ($this->path_count == 3 && $this->method == "GET") {
            $this->getById($this->path_parts[2]);
        }

        // If theres two parts in the path and the request method is POST 
        // it means that the client is requesting "api/Comments" and we
        // should get ths contents of the body and create a comment.
        else if ($this->path_count == 2 && $this->method == "POST") {
            $this->postOne();
        }
   
        // If none of our ifs are true, we should respond with "not found"
        else {
            $this->notFound();
        }
    }

    // Gets all comments and sends them to the client as JSON
    private function getAll()
    {
        $comments = CommentsService::getAllComments();

        $this->sendJson($comments);
    }

    // Gets one and sends it to the client as JSON
    private function getById($id)
    {
        $comment = CommentsService::getCommentById($id);

        if ($comment) {
            $this->sendJson($comment);
        }
        else {
            $this->notFound();
        }
    }

    // Gets the contents of the body and saves it as a comment by 
    // inserting it in the database.
    private function postOne()
    {
        $comment = new CommentModel();

        $comment->content = $this->body["content"];
        $comment->post_id = $this->body["post_id"];
        $comment->user_id = $this->body["user_id"];

        $success = CommentsService::saveComment($comment);

        if($success){
            $this->created();
        }
        else{
            $this->error();
        }
    }


    // Deletes the comment with the specified ID in the DB
    private function deleteOne($id)
    {
        $comment = CommentsService::getCommentById($id);

        if($comment == null){
            $this->notFound();
        }

        $success = CommentsService::deleteCommentById($id);

        if($success){
            $this->noContent();
        }
        else{
            $this->error();
        }
    }

}