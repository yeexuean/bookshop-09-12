<?php
session_start();
require_once('db.php');

// User login
function login($username, $password) {

    $db = getDBConnection();
    $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($password, $user['password'])) {
        // Regenerate session ID to prevent session fixation attacks
        session_regenerate_id();
        $sessionId = session_id(); // Get the current session ID

        // Store user information in session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];

        return $sessionId; // Return the session ID
    }
    return false;
}

// Check if user is login
function isLogin() {
  return isset($_SESSION['role']);
}

// Check if user is admin
function isAdmin() {
    return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
}

function isAdminBySessionId() {
  if (isset($data['session_id'])) {
    // Set the session ID
    session_id($data['session_id']);
    session_start();

    if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
      return isset($_SESSION['role']) && $_SESSION['role'] === 'admin';
    } 
    return false;
  } else {
      return false;
  }
}


// Logout
function logout() {
    session_destroy();
    header("Location: login.php");
}
?>
