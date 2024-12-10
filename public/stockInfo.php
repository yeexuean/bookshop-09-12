<?php 
include('../includes/functions.php');
header('Content-Type: application/json');

$books = getBooksInStock();
echo json_encode($books);
?>