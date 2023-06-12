<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

require_once __DIR__ . "/../ControllerBase.php";


class AdminController extends ControllerBase
{

    public function handleRequest($request_info)
    {
        // GET: /frontend/admin/posts
        if ($this->path_count == 3 && $this->path_parts[2] == "posts") {
            $this->showPosts();
        }

        // GET: /frontend/admin/users
        else if ($this->path_count == 3 && $this->path_parts[2] == "users") {
            $this->viewPage("admin/adminProfile");
        }

        // Show "404 not found" if the path is invalid
        else {
            $this->notFound();
        }
    }

    private function showPosts() {
        $this->requireAuth(["admin"]);

        $posts = PostsService::getAllPosts();
        $this->model = $posts;

        $this->viewPage("admin/adminHome");
    }
}
