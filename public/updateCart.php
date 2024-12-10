<?php 
include('../includes/functions.php');
session_start();

//get book id and new quantity from request
$data = json_decode(file_get_contents('php;//input'), true);

if (isset($data['book_id'], $data['quantity'])) {
    $book_id = $data['book_id'];
    $quantity = $data['quantity'];

    //call the function to update the book quantity in the cart 
    updateCart($book_id, $quantity); 
    echo json_encode(["message" => "Cart updated successfully"]);
} else {
    echo json_encode(["message" => "Invalid input"]);
}
?>