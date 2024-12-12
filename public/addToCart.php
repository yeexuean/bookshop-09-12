<?php
include('../includes/functions.php');
session_start();

// Get book ID and quantity from request
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['book_id'], $data['quantity'])) {
    $book_id = $data['book_id'];
    $quantity = $data['quantity'];

    // Call the function to add the book to the cart
    addToCart($book_id, $quantity);
    echo json_encode(["message" => "Book added to cart successfully"]);
} else {
    echo json_encode(["message" => "Invalid input"]);
}
?>
