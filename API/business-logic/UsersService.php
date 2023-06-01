<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../data-access/UsersDatabase.php";

class UsersService {

    // Get one user by creating a database object 
    // from data-access layer and calling its getOne function.
    public static function getUserById($id) {
        $users_database = new UsersDatabase();

        $user = $users_database->getOne($id);

        // If you need to remove or hide data that shouldn't
        // be shown in the API response you can do that here
        // An example of data to hide is users password hash 
        // or other secret/sensitive data that shouldn't be 
        // exposed to users calling the API

        return $user;
    }

    //This function is to check if the login of a user
    public static function loginUser($username, $password) {
        $users_database = new UsersDatabase();
        
        $user = $users_database->getUserByUsername($username);

        //Here we are checking if the username exists in our database
        if (!$user) {
            return false;
        }

        //Here we are checking if the password are the same
        $password_matches = password_verify($password, $user->password_hash);
        if ($password_matches == false) {
            return false;
        }

        return $user;
    }

    public static function getUserByUsername($username)
    {
        $users_database = new UsersDatabase();

        $user = $users_database->getUserByUsername($username);

        return $user;
    }

    // Save a user to the database by creating a database object 
    // from data-access layer and calling its insert function.
    public static function registerUser(UserModel $user, $password) {
        $users_database = new UsersDatabase();

        $existing_user = $users_database->getUserByUsername($user->username);

        // Check if user exists
        if ($existing_user) {
            // Username exists
            return false;
        }

        // Hash the password securely
        $password_hash = password_hash($password, PASSWORD_DEFAULT);

        // Set the password hash in the user object
        $user->password = $password_hash;

        // Insert the user into the database
        $success = $users_database->insert($user);

        return $success;
    }

    // Update the user in the database by creating a database object 
    // from data-access layer and calling its update function.
    public static function updateUserById($user_id, UserModel $user){
        $users_database = new UsersDatabase();

        // If you need to validate data or control what 
        // gets saved to the database you can do that here.
        // This makes sure all input from any presentation
        // layer will be validated and handled the same way.

        $success = $users_database->updateById($user_id, $user);

        return $success;
    }

    // Delete the user from the database by creating a database object 
    // from data-access layer and calling its delete function.
    public static function deleteUserById($user_id){
        $users_database = new UsersDatabase();

        // If you need to validate data or control what 
        // gets deleted from the database you can do that here.
        // This makes sure all input from any presentation
        // layer will be validated and handled the same way.

        $success = $users_database->deleteById($user_id);

        return $success;
    }
}

