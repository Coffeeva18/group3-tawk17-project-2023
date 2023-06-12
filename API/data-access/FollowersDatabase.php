<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

// Use "require_once" to load the files needed for the class

require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/../models/FollowerModel.php";

class FollowersDatabase extends Database
{
    private $table_name = "followers";
    private $id_name = "id";

    // Get one follower by using the inherited function getOneRowByIdFromTable
    public function getOne($follower_id)
    {
        $result = $this->getOneRowByIdFromTable($this->table_name, $this->id_name, $follower_id);

        $follower = $result->fetch_object();

        return $follower;
    }

    
    // Get one follower by using the inherited function getOneRowByIdFromTable
    public function getAllFollowingById($user_id)
    {
        $query = "SELECT following_id FROM followers WHERE follower_id = ?;";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("i", $user_id);

        $stmt->execute();

        $result = $stmt->get_result();

        $following = [];

        while ($follow = $result->fetch_object()) {
            $following[] = $follow;
        }

        return $following;
    }

     // Get one follower by using the inherited function getOneRowByIdFromTable
     public function getAllFollowersById($user_id)
     {
         $query = "SELECT follower_id FROM followers WHERE following_id = ?;";
 
         $stmt = $this->conn->prepare($query);
 
         $stmt->bind_param("i", $user_id);
 
         $stmt->execute();
 
         $result = $stmt->get_result();
 
         $followers = [];
 
         while ($follow = $result->fetch_object()) {
             $followers[] = $follow;
         }
 
         return $followers;
     }

    // Create one by creating a query and using the inherited $this->conn 
    public function insert(FollowerModel $follower)
    {
        $query = "INSERT INTO followers (following_id, follower_id, ) VALUES (?, ?";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("ii", $follower->following_id, $follower->follower_id);

        $success = $stmt->execute();

        return $success;
    }

    // Update one by creating a query and using the inherited $this->conn 
    public function updateById($follower_id, FollowerModel $follower)
    {
        $query = "UPDATE followers SET following_id=?, follower_id=?, password=? WHERE id=?;";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("sssi", $follower->following_id, $follower->follower_id);

        $success = $stmt->execute();

        return $success;
    }

    // Delete one follower by using the inherited function deleteOneRowByIdFromTable
    public function deleteById($follower_id)
    {
        $success = $this->deleteOneRowByIdFromTable($this->table_name, $this->id_name, $follower_id);

        return $success;
    }
}
