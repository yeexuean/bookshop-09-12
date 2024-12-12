<?php
include('../includes/auth.php');
header("Access-Control-Allow-Origin: http://127.0.0.1:5500");
// header("Access-Control-Allow-Origin: http://127.0.0.1:5501");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Check if user sent a POST request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // $data = json_decode(file_get_contents('php://input'), true);
    // if (isset($data['username']) && isset($data['password'])) {
    //     $username = $data['username'];
    //     $password = $data['password'];

    //     if (login($username, $password)) {
    //         echo json_encode(["message" => "Login successful"]);
    //     } else {
    //         echo json_encode(["message" => "Invalid credentials"]);
    //     }
    // } else {
    //     echo json_encode(["message" => "Username and password are required"]);
    // }
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['username']) && isset($data['password'])) {
        $username = $data['username'];
        $password = $data['password'];

        // Call the modified login function
        $sessionId = login($username, $password);

        /**
         * read from local storage
         */
        //  const sessionId = localStorage.getItem("session_id");

        //  fetch("https://your-backend-api.com/user-data", {
        //      method: "POST",
        //      headers: {
        //          "Content-Type": "application/json"
        //      },
        //      body: JSON.stringify({ session_id: sessionId })
        //  })
        //  .then(response => response.json())
        //  .then(data => {
        //      console.log(data);
        //  })
        //  .catch(error => {
        //      console.error("Error:", error);
        //  });

        if ($sessionId) {
            echo json_encode([
                "message" => "Login successful",
                "session_id" => $sessionId
            ]);
        } else {
            echo json_encode(["message" => "Invalid credentials"]);
        }
    } else {
        echo json_encode(["message" => "Username and password are required"]);
    }
}
?>
