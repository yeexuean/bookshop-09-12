<?php
header("Access-Control-Allow-Origin: http://127.0.0.1:5500");
header("Access-Control-Allow-Origin: http://127.0.0.1:5501");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

// Start the session
// session_start();

// Function to check if the session_id belongs to an admin
function verifyRole($sessionId) {
  // Regenerate the session ID if needed to prevent session fixation attacks
  session_id($sessionId);
  session_start();

  // Check if the session is valid and the user is logged in
  if (isset($_SESSION['user_id']) && isset($_SESSION['role'])) {
      // Verify if the role is "admin"
      if ($_SESSION['role'] === 'admin') {
          return [
              'status' => 'success',
              'message' => 'User is an admin.',
          ];
      } else {
          return [
              'status' => 'error',
              'message' => 'User is not an admin.',
          ];
      }
  } else {
      return [
          'status' => 'error',
          'message' => 'Invalid session or user not logged in.',
      ];
  }
}


// Read the input data (assuming it's JSON)
$inputData = json_decode(file_get_contents('php://input'), true);

// Validate the input data
if (!isset($inputData['session_id'])) {
    echo json_encode([
        'status' => 'error',
        'message' => 'Missing session_id in request body.',
    ]);
    exit;
}

// Get the session_id from the request
$sessionId = $inputData['session_id'];

// Verify the session role
$response = verifyRole($sessionId);

// Send the response as JSON
echo json_encode($response);

?>
