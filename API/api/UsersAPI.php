<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/RestAPI.php";
require_once __DIR__ . "/../business-logic/UsersService.php";

// Class for handling requests to "api/User"

class UsersAPI extends RestAPI
{

    // Handles the request by calling the userropriate member function
    public function handleRequest()
    {
        // GET: /api/auth/me
        if ($this->method == "GET" && $this->path_count == 3 && $this->path_parts[2] == "me") {
            $this->getUser();
        }

        // POST: /api/auth/register
        if ($this->method == "POST" && $this->path_count == 3 && $this->path_parts[2] == "register") {
            $this->registerUser();
        }

        // POST: /api/auth/login
        if ($this->method == "POST" && $this->path_count == 3 && $this->path_parts[2] == "login") {
            $this->login();
        }
        
        // If none of our ifs are true, we should respond with "not found"
        else {
            $this->notFound();
        }
    }

    // Gets one and sends it to the client as JSON
    private function getUser()
    {
        $this->requireAuth();

        $this->sendJson($this->user);
    }

    private function login()
    {
        $username = $this->body["username"];
        $test_password = $this->body["password"];

        $user = UsersService::loginUser($username, $test_password);

        if($user == false){
            $this->unauthorized();
        }
        
        $token = UsersService::generateJsonWebToken($user);

        $response = ["access_token" => $token];

        $this->sendJson($response);
    }


    // Gets the contents of the body and saves it as a user by 
    // inserting it in the database.
    private function registerUser()
    {
        $user = new UserModel();

        $user->username = $this->body["username"];
        $user->email = $this->body["email"];
        $user->password = $this->body["password"];
        $user->role = "user";

        $success = UsersService::registerUser($user, $user->password);

        if($success) {
            $this->created();
        }
        else{
            $this->error();
        }
    }

    // Gets the contents of the body and updates the user
    // by sending it to the DB
    private function putOne($id)
    {
        $user = new UserModel();

        $user->username = $this->body["username"];
        $user->email = $this->body["email"];
        $user->password = $this->body["password"];
       

        $success = UsersService::updateUserById($id, $user);

        if($success){
            $this->ok();
        }
        else{
            $this->error();
        }
    }

    // Deletes the user with the specified ID in the DB
    private function deleteOne($id)
    {
        $user = UsersService::getUserById($id);

        if($user == null){
            $this->notFound();
        }

        $success = UsersService::deleteUserById($id);

        if($success){
            $this->noContent();
        }
        else{
            $this->error();
        }
    }
}
