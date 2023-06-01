<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

// Use "require_once" to load the files needed for the class

require_once __DIR__ . "/Database.php";
require_once __DIR__ . "/../models/UserModel.php";

class UsersDatabase extends Database
{
    private $table_name = "users";
    private $id_name = "id";

    // Get one user by using the inherited function getOneRowByIdFromTable
    public function getOne($user_id)
    {
        $result = $this->getOneRowByIdFromTable($this->table_name, $this->id_name, $user_id);

        $user = $result->fetch_object();

        return $user;
    }



    // Create one by creating a query and using the inherited $this->conn 
    public function insert(UserModel $user)
    {
        $query = "INSERT INTO users (username, email, password, admin ) VALUES (?, ?, ?, ?)";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("sssi", $user->username, $user->email, $user->password, $user->admin );

        $success = $stmt->execute();

        return $success;
    }

    // Update one by creating a query and using the inherited $this->conn 
    public function updateById($user_id, UserModel $user)
    {
        $query = "UPDATE users SET username=?, email=?, password=? WHERE id=?;";

        $stmt = $this->conn->prepare($query);

        $stmt->bind_param("sssi", $user->username, $user->email, $user->password, $user_id);

        $success = $stmt->execute();

        return $success;
    }

    // Delete one user by using the inherited function deleteOneRowByIdFromTable
    public function deleteById($user_id)
    {
        $success = $this->deleteOneRowByIdFromTable($this->table_name, $this->id_name, $user_id);

        return $success;
    }
}
