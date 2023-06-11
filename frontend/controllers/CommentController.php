<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../ControllerBase.php";
require_once __DIR__ . "/../../API/business-logic/CommentsService.php";


class CommentController extends ControllerBase
{

    public function handleRequest()
    {

        // Check for POST method before checking any of the GET-routes
        if ($this->method == "POST") {
            $this->handlePost();
        }

        // Show "404 not found" if the path is invalid
        else {
            $this->notFound();
        }
    }

    // handle all comment requests for comments in one place
    private function handlePost()
    {
        // POST: /home/comments
        if ($this->path_count == 2) {
            $this->createComment();
        }

        // POST: /home/comment/{id}/delete
        else if ($this->path_count == 4 && $this->path_parts[3] == "delete") {
            $this->deleteComment();
        }

        // Show "404 not found" if the path is invalid
        else {
            $this->notFound();
        }
    }


    // Create a comment with data from the URL and body
    private function createComment()
    {
        $this->requireAuth();

        $comment = new CommentModel();

        $comment->content = $this->body["content"];
        $comment->post_id = $this->body["post_id"];

        // Admins can connect any user to the comment
        if($this->user->role === "admin") {
            $comment->user_id = $this->body["user_id"];
        }

        // Regular users can only add comments to themself
        else {
            $comment->user_id = $this->user->id;
        }

        // Save the comment
        $success = CommentsService::saveComment($comment);

        // Redirect or show error based on response from business logic layer
        if ($success) {
            $this->redirect($this->home . "/posts/" . $comment->post_id);
        } else {
            $this->error();
        }
    }

    // Delete a comment with data from the URL
    private function deleteComment()
    {
        // Get ID from the URL
        $id = $this->path_parts[2];

        // Delete the comment
        $success = CommentsService::deleteCommentById($id);

        // Redirect or show error based on response from business logic layer
        if ($success) {
            $this->redirect($this->home . "/posts/");
        } else {
            $this->error();
        }
    }
}