<?php
session_start();

// Check if cart exists in session
if (isset($_SESSION['cart'])) {
    echo json_encode($_SESSION['cart']);
} else {
    echo json_encode(["message" => "Cart is empty"]);
}
?>
