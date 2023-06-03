<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

// Model class for post-table in database

class PostModel{
    public $title; 
    public $content; 
    public $likes;
    public $user_id;
}
