<?php

// Check for a defined constant or specific file inclusion
if (!defined('MY_APP') && basename($_SERVER['PHP_SELF']) == basename(__FILE__)) {
    die('This file cannot be accessed directly.');
}

// Model class for user-table in database

class UserModel{
    public $id;
    public $username; 
    public $email; 
    public $password;
    public $role;
}
