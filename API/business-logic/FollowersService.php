<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../data-access/FollowersDatabase.php";

class FollowersService{

    // Get one follower by creating a database object 
    // from data-access layer and calling its getOne function.
    public static function getFollowerById($id){
        $followers_database = new FollowersDatabase();

        $follower = $followers_database->getOne($id);

        // If you need to remove or hide data that shouldn't
        // be shown in the API response you can do that here
        // An example of data to hide is followers password hash 
        // or other secret/sensitive data that shouldn't be 
        // exposed to followers calling the API

        return $follower;
    }

    // Get one follower by creating a database object 
    // from data-access layer and calling its getOne function.
    public static function getFollowingById($id){
        $followers_database = new FollowersDatabase();

        $following = $followers_database->getAllFollowingById($id);

        return $following;
    }

     // Get one follower by creating a database object 
    // from data-access layer and calling its getOne function.
    public static function getFollowersById($id){
        $followers_database = new FollowersDatabase();

        $followers = $followers_database->getAllFollowersById($id);

        return $followers;
    }

    // Save a follower to the database by creating a database object 
    // from data-access layer and calling its insert function.
    public static function saveFollower(FollowerModel $follower){
        $followers_database = new FollowersDatabase();

        // If you need to validate data or control what 
        // gets saved to the database you can do that here.
        // This makes sure all input from any presentation
        // layer will be validated and handled the same way.

        $success = $followers_database->insert($follower);

        return $success;
    }

    // Update the follower in the database by creating a database object 
    // from data-access layer and calling its update function.
    public static function updateFollowerById($follower_id, FollowerModel $follower){
        $followers_database = new FollowersDatabase();

        // If you need to validate data or control what 
        // gets saved to the database you can do that here.
        // This makes sure all input from any presentation
        // layer will be validated and handled the same way.

        $success = $followers_database->updateById($follower_id, $follower);

        return $success;
    }

    // Delete the follower from the database by creating a database object 
    // from data-access layer and calling its delete function.
    public static function deleteFollowerById($follower_id){
        $followers_database = new FollowersDatabase();

        // If you need to validate data or control what 
        // gets deleted from the database you can do that here.
        // This makes sure all input from any presentation
        // layer will be validated and handled the same way.

        $success = $followers_database->deleteById($follower_id);

        return $success;
    }
}

