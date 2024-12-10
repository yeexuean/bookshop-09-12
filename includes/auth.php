<?php

session_start();
require_once('db.php');

//user login 
function login($username, $password) {
    
    $db = getDBConnection();
    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        //regenerate session ID to prevent session fixation attacks
        session_regenerate_id();
        $sessionId = session_id(); //get the current session ID

        //store user information in session 
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        return $sessionId; //return the session ID
    }
    return false;
}

//check if user is login 
function isLogin() {
    return isset($_SESSION['role']);
}

//check if user is admin 
function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}


?>