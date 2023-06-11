<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}


require_once __DIR__ . "/../ControllerBase.php";
require_once __DIR__ . "/../../API/business-logic/UsersService.php";

// Class for handling requests to "home/Auth"

class AuthController extends ControllerBase
{

    public function handleRequest()
    {

        // Check for POST method before checking any of the GET-routes
        if ($this->method == "POST") {
            $this->handlePost();
        }

        // GET: /home/auth/login
        if ($this->path_count == 3 && $this->path_parts[2] == "login") {
            $this->showLoginForm();
        }

        // GET: /home/auth/signup
        if ($this->path_count == 3 && $this->path_parts[2] == "signup") {
            $this->showRegisterForm();
        }

        // GET: /home/auth/profile
        if ($this->path_count == 3 && $this->path_parts[2] == "profile") {
            $this->showProfilePage();
        }

        // GET: /home/auth/main
        if ($this->path_count == 3 && $this->path_parts[2] == "main") {
            $this->showMainPage();
        }

        // GET: /home/auth/comment
        if ($this->path_count == 3 && $this->path_parts[2] == "comment") {
            $this->showCommentPage();
        }

        // Show "404 not found" if the path is invalid
        else {
            $this->notFound();
        }
    }



    private function showLoginForm()
    {
        // Shows the view file auth/login.php
        $this->viewPage("auth/login");
    }

    private function showRegisterForm()
    {
        // Shows the view file auth/register.php
        $this->viewPage("auth/signup");
    }

    private function showProfilePage()
    {
        $this->requireAuth();

        if ($this->user->role === "admin") {
            $posts = PostsService::getAllPosts();
        } else {
            $posts = PostsService::getPostsByUser($this->user->id);
        }

        // $this->model is used for sending data to the view
        $this->model = $posts;

        // Shows the view file auth/register.php
        $this->viewPage("auth/profile");
    }

    private function showMainPage()
    {
        // Shows the view file auth/register.php
        $this->viewPage("auth/main");
    }

    private function showCommentPage()
    {
        // Shows the view file auth/register.php
        $this->viewPage("auth/comment");
    }


    // handle all post requests in one place
    private function handlePost()
    {
        // POST: /home/auth/login
        if ($this->path_count == 3 && $this->path_parts[2] == "login") {
            $this->loginUser();
        }

        // POST: /home/auth/register
        else if ($this->path_count == 3 && $this->path_parts[2] == "signup") {
            $this->registerUser();
        }

        // POST: /home/auth/logout
        else if ($this->path_count == 3 && $this->path_parts[2] == "logout") {
            $this->logoutUser();
        }

        // POST: /home/auth/1/delete
        else if ($this->path_count == 4 && $this->path_parts[3] == "delete") {
            $this->deleteUser();
        }


        // Show "404 not found" if the path is invalid
        else {
            $this->notFound();
        }
    }


    private function loginUser()
    {
        $username = $this->body["username"];
        $password = $this->body["password"];

        $user = UsersService::loginUser($username, $password);

        if ($user === false) {
            $this->model["error"] = "Invalid credentials";
            $this->viewPage("auth/login");
        }

        $_SESSION["user"] = $user;

        $this->redirect($this->home . "/auth/profile");
    }


    private function registerUser()
    {
        $user = new UserModel();

        $user->username = $this->body["username"];
        $user->email = $this->body["email"];
        $password = $this->body["password"];
        $confirm_password = $this->body["confirm_password"];
        $user->role = "user";

        if ($password !== $confirm_password) {
            $this->model["error"] == "Passwords don't match";
            $this->viewPage("auth/signup");
        }

        $existing_user = UsersService::getUserByUsername($user->username);
        
        if ($existing_user) {
            $this->model["error"] == "Username already in use";
            $this->viewPage("auth/signup");
        }
        
        $success = UsersService::registerUser($user, $password);

        if ($success) {
            $this->redirect($this->home . "/auth/login");
        } else {
            $this->model["error"] == "Error registering user";
            $this->viewPage("auth/signup");
        }
    }


    private function logoutUser()
    {
        session_destroy();

        $this->redirect($this->home . "/auth/login");
    }

    private function deleteUser()
    {
        UsersService::deleteUserById($this->path_parts[2]);

        $this->redirect($this->home . "/admin/posts");
    }
}