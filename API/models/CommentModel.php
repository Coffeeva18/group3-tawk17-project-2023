<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

// Model class for comment-table in database

class CommentModel{
    public $content; 
    public $post_id; 
    public $user_id;
}
