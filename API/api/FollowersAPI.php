<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/RestAPI.php";
require_once __DIR__ . "/../business-logic/FollowersService.php";

// Class for handling requests to "api/Follower"

class FollowersAPI extends RestAPI
{

    // Handles the request by calling the followerropriate member function
    public function handleRequest()
    {

        
        // If there's three parts in the path and the request method is GET
        // it means that the client is requesting "api/Followers/{something}".
        // In our API the last part ({something}) should contain the ID of a 
        // follower and we should respond with the follower of that ID
        if ($this->path_count == 3 && $this->method == "GET") {
            $this->getById($this->path_parts[2]);
        }

        // If theres two parts in the path and the request method is POST 
        // it means that the client is requesting "api/Followers" and we
        // should get ths contents of the body and create a follower.
        else if ($this->path_count == 2 && $this->method == "POST") {
            $this->postOne();
        }

        // If theres two parts in the path and the request method is PUT 
        // it means that the client is requesting "api/Followers/{something}" and we
        // should get the contents of the body and update the follower.
        else if ($this->path_count == 3 && $this->method == "PUT") {
            $this->putOne($this->path_parts[2]);
        } 

        // If theres two parts in the path and the request method is DELETE 
        // it means that the client is requesting "api/Followers/{something}" and we
        // should get the ID from the URL and delete that follower.
        else if ($this->path_count == 3 && $this->method == "DELETE") {
            $this->deleteOne($this->path_parts[2]);
        } 
        
        // If none of our ifs are true, we should respond with "not found"
        else {
            $this->notFound();
        }
    }

    // Gets one and sends it to the client as JSON
    private function getById($id)
    {
        $follower = FollowersService::getFollowerById($id);

        if ($follower) {
            $this->sendJson($follower);
        }
        else {
            $this->notFound();
        }
    }

    // Gets the contents of the body and saves it as a follower by 
    // inserting it in the database.
    private function postOne()
    {
        $follower = new FollowerModel();

        $follower->following_id = $this->body["follower_id"];
        $follower->follower_id = $this->body["following_id"];
    

        $success = FollowersService::saveFollower($follower);

        if($success){
            $this->created();
        }
        else{
            $this->error();
        }
    }

    // Gets the contents of the body and updates the follower
    // by sending it to the DB
    private function putOne($id)
    {
        $follower = new FollowerModel();

        $follower->following_id = $this->body["following"];
        $follower->follower_id = $this->body["followers"];
        
       

        $success = FollowersService::updateFollowerById($id, $follower);

        if($success){
            $this->ok();
        }
        else{
            $this->error();
        }
    }

    // Deletes the follower with the specified ID in the DB
    private function deleteOne($id)
    {
        $follower = FollowersService::getFollowerById($id);

        if($follower == null){
            $this->notFound();
        }

        $success = FollowersService::deleteFollowerById($id);

        if($success){
            $this->noContent();
        }
        else{
            $this->error();
        }
    }
}
