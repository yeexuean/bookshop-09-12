<?php
include('includes/functions.php');
session_start();

// Get book ID from request
$data = json_decode(file_get_contents('php://input'), true);

if (isset($data['book_id'])) {
    $book_id = $data['book_id'];

    // Call the function to remove the book from the cart
    removeFromCart($book_id);
    echo json_encode(["message" => "Item removed from cart"]);
} else {
    echo json_encode(["message" => "Invalid input"]);
}
?>
