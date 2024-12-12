<?php
include('../includes/functions.php');

header("Access-Control-Allow-Origin: http://127.0.0.1:5500");
// header("Access-Control-Allow-Origin: http://127.0.0.1:5501");
header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
header("Access-Control-Allow-Headers: Content-Type, Authorization");
header("Access-Control-Allow-Credentials: true");
header('Content-Type: application/json');

$books = getBooksInStock();
echo json_encode($books);
?>
