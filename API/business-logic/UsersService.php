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
        $password_matches = password_verify($password, $user->password);
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

    public static function generateJsonWebToken(UserModel $user)
    {
        // Set the JWT header and payload with the user ID and username
        $header = json_encode([
            "alg" => "HS256",
            "typ" => "JWT"
        ]);

        $payload = json_encode([
            "user_id" => $user->id,
            "username" => $user->username,
            "role" => $user->role,
            "iss" => APPLICATION_NAME,
            "aud" => APPLICATION_NAME,
            "exp" => time() + 3600, // set to expire in 1 hour
            "iat" => time(),
            "nbf" => time()
        ]);

        // Encode Header to Base64Url String
        $encoded_header = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($header));

        // Encode Payload to Base64Url String
        $encoded_payload = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($payload));

        // Create the JWT signature using the HMAC-SHA256 algorithm and a secret key
        $signature = hash_hmac("sha256", "$encoded_header.$encoded_payload", JWT_SECRET, true);

        // Encode Signature to Base64Url String
        $encoded_signature = str_replace(['+', '/', '='], ['-', '_', ''], base64_encode($signature));

        // Combine the encoded header, payload, and signature into a JWT token string
        $token = "$encoded_header.$encoded_payload.$encoded_signature";

        // Return the token
        return $token;
    }


    public static function validateToken($token)
    {
        // Split the token into header, payload, and signature strings
        list($encoded_header, $encoded_payload, $encoded_signature) = explode(".", $token);

        // Decode the header and payload from base64 strings to JSON objects
        $header = json_decode(base64_decode($encoded_header));
        $payload = json_decode(base64_decode($encoded_payload));


        // Verify that the JWT header specifies the expected algorithm and token type
        if ($header->alg !== "HS256" || $header->typ !== "JWT") {
            return false;
        }

        // Calculate the expected signature using the HMAC-SHA256 algorithm and the secret key
        $expected_signature = base64_encode(hash_hmac("sha256", "$encoded_header.$encoded_payload", JWT_SECRET, true));
        
        // Encode Signature to Base64Url String
        $expected_signature = str_replace(['+', '/', '='], ['-', '_', ''], $expected_signature);

        // Verify that the actual signature matches the expected signature
        if ($encoded_signature !== $expected_signature) {
            return false;
        }

        // Verify that the token has not expired
        $expiration_time = $payload->exp;
        if (time() > $expiration_time) {
            return false;
        }

        // If all checks pass, return payload to indicate that the token is valid
        return $payload;
    }
}

