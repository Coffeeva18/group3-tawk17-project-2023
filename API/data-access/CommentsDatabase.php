<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

// Use "require_once" to load the files needed for the class

require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/../models/CommentModel.php";

class CommentsDatabase extends Database
{
    private $table_name = "Comments";
    private $id_name = "comment_id";

    // Get one comment by using the inherited function getOneRowByIdFromTable
    public function getOne($comment_id)
    {
        $result = $this->getOneRowByIdFromTable($this->table_name, $this->id_name, $comment_id);

        $comment = $result->fetch_object();

        return $comment;
    }


    // Get all comments by using the inherited function getAllRowsFromTable
    public function getAll()
    {
        $result = $this->getAllRowsFromTable($this->table_name);

        $comments = [];

        while ($comment = $result->fetch_object()) {
            $comments[] = $comment;
        }

        return $comments;
    }

    // Create one by creating a query and using the inherited $this->conn 
    public function insert(CommentModel $comment)
    {
        $query = "INSERT INTO comments (content, user_id, post_id) VALUES (?, ?, ?)";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("sii", $comment->content, $comment->user_id, $comment->post_id);

        $success = $stmt->execute();

        return $success;
    }

   
    // Delete one comment by using the inherited function deleteOneRowByIdFromTable
    public function deleteById($comment_id)
    {
        $success = $this->deleteOneRowByIdFromTable($this->table_name, $this->id_name, $comment_id);

        return $success;
    }
}
