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

    // Get all comments by using the inherited function getAllRowsFromTable
    public function getAllComments($post_id)
    {
        $user = new UsersDatabase();

        $query = "SELECT * FROM comments WHERE post_id=?;";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("i", $post_id);

        $stmt->execute();

        $result = $stmt->get_result();

        $comments = [];

        while ($comment = $result->fetch_object()) {
            $comment->user = $user->getOne($comment->user_id);
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
        $success = $this->deleteOneRowByIdFromTable($this->table_name, "id", $comment_id);

        return $success;
    }
}
