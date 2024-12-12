<?php
require_once('db.php');

// Add new book to database
function addBook($title, $author, $publication_date, $isbn13, $description, $cover_image) {
    $db = getDBConnection();
    $stmt = $db->prepare("INSERT INTO books (title, author, publication_date, isbn13, description, cover_image) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->execute([$title, $author, $publication_date, $isbn13, $description, $cover_image]);
}

// Get all books in stock
function getBooksInStock() {
    $db = getDBConnection();
    $stmt = $db->prepare("SELECT * FROM books WHERE stock_quantity > 0");
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Update stock quantity
function updateBookStock($book_id, $quantity) {
    $db = getDBConnection();
    $stmt = $db->prepare("UPDATE books SET stock_quantity = ? WHERE id = ?");
    $stmt->execute([$quantity, $book_id]);
}

function addToCart($book_id, $quantity) {
  // Ensure session is started
  if (!isset($_SESSION['cart'])) {
      $_SESSION['cart'] = [];
  }

  // Fetch book details from the database
  $db = getDBConnection();
  $stmt = $db->prepare("SELECT id, title, cover_image, price FROM books WHERE id = :book_id");
  $stmt->execute(['book_id' => $book_id]);
  $book = $stmt->fetch(PDO::FETCH_ASSOC);

  // Check if book already in cart
  if (isset($_SESSION['cart'][$book_id])) {
      // Increment quantity if the book is already in the cart
      $_SESSION['cart'][$book_id]['quantity'] += $quantity;
  } else {
      // Otherwise, add the book to the cart
      $_SESSION['cart'][$book_id] = [
          'name' => $book['title'],
          'cover_image' => $book['cover_image'],
          'price' => $book['price'],
          'quantity' => $quantity
      ];
  }
}

function updateCart($book_id, $new_quantity) {
  if (isset($_SESSION['cart'][$book_id])) {
      // Update the quantity
      $_SESSION['cart'][$book_id]['quantity'] = $new_quantity;
  }
}

function removeFromCart($book_id) {
  if (isset($_SESSION['cart'][$book_id])) {
      // Remove the book from the cart
      unset($_SESSION['cart'][$book_id]);
  }
}

?>
