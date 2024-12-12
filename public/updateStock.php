<?php
include('../includes/functions.php');
include('../includes/auth.php');
header('Content-Type: application/json');

if (isAdmin() && $_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = json_decode(file_get_contents('php://input'), true);

    if (isset($data['book_id'], $data['stock_quantity'])) {
        $book_id = $data['book_id'];
        $stock_quantity = $data['stock_quantity'];

        updateBookStock($book_id, $stock_quantity);
        echo json_encode(["message" => "Stock updated successfully"]);
    } else {
        echo json_encode(["message" => "Missing required fields"]);
    }
} else {
    echo json_encode(["message" => "Unauthorized"]);
}
?>
