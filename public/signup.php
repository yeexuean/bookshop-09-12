<?php
require_once('../includes/db.php');
require_once('../includes/auth.php');
header('Content-Type: application/json');

// Handle POST request for user sign-up
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    // Validate input fields
    if (isset($data['username']) && isset($data['password']) && isset($data['role'])) {
        $username = $data['username'];
        $password = $data['password'];
        $role = $data['role']; // role can be 'admin' or 'user'

        // Validate password (minimum 6 characters for example)
        if (strlen($password) < 6) {
            echo json_encode(["message" => "Password must be at least 6 characters long"]);
            exit();
        }

        // Check if username already exists
        $db = getDBConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE username = :username");
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            echo json_encode(["message" => "Username already exists"]);
            exit();
        }

        // Hash the password before storing
        $hashed_password = password_hash($password, PASSWORD_BCRYPT);

        // Insert new user into the database
        $stmt = $db->prepare("INSERT INTO users (username, password, role) VALUES (?, ?, ?)");
        $stmt->execute([$username, $hashed_password, $role]);

        // Return success response
        echo json_encode(["message" => "User registered successfully"]);
    } else {
        echo json_encode(["message" => "Missing required fields"]);
    }
}
?>
