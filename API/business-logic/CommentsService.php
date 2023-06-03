<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../data-access/CommentsDatabase.php";

class CommentsService{

    // Get one comment by creating a database object 
    // from data-access layer and calling its getOne function.
    public static function getCommentById($id){
        $comments_database = new CommentsDatabase();

        $comment = $comments_database->getOne($id);

        // If you need to remove or hide data that shouldn't
        // be shown in the API response you can do that here
        // An example of data to hide is users password hash 
        // or other secret/sensitive data that shouldn't be 
        // exposed to users calling the API

        return $comment;
    }

    // Get all comments by creating a database object 
    // from data-access layer and calling its getAll function.
    public static function getAllComments(){
        $comments_database = new CommentsDatabase();

        $comments = $comments_database->getAll();

        // If you need to remove or hide data that shouldn't
        // be shown in the API response you can do that here
        // An example of data to hide is users password hash 
        // or other secret/sensitive data that shouldn't be 
        // exposed to users calling the API

        return $comments;
    }

    // Save a comment to the database by creating a database object 
    // from data-access layer and calling its insert function.
    public static function saveComment(CommentModel $comment){
        $comments_database = new CommentsDatabase();

        // If you need to validate data or control what 
        // gets saved to the database you can do that here.
        // This makes sure all input from any presentation
        // layer will be validated and handled the same way.

        $success = $comments_database->insert($comment);

        return $success;
    }


    // Delete the comment from the database by creating a database object 
    // from data-access layer and calling its delete function.
    public static function deleteCommentById($comment_id){
        $comments_database = new CommentsDatabase();

        // If you need to validate data or control what 
        // gets deleted from the database you can do that here.
        // This makes sure all input from any presentation
        // layer will be validated and handled the same way.

        $success = $comments_database->deleteById($comment_id);

        return $success;
    }
}

