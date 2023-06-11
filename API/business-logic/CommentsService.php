<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../data-access/CommentsDatabase.php";

class CommentsService{
    public static function getCommentsByPostId($post_id) {
        $comments_database = new CommentsDatabase();

        $posts = $comments_database->getAllComments($post_id);

        return $posts;
    }

    // Save a comment to the database by creating a database object 
    // from data-access layer and calling its insert function.
    public static function saveComment(CommentModel $comment){
        $comments_database = new CommentsDatabase();

        $success = $comments_database->insert($comment);

        return $success;
    }


    // Delete the comment from the database by creating a database object 
    // from data-access layer and calling its delete function.
    public static function deleteCommentById($comment_id){
        $comments_database = new CommentsDatabase();

        $success = $comments_database->deleteById($comment_id);

        return $success;
    }
}
