<?php
session_start(); // Start session to access cart data

// Check if the product ID is provided
if (isset($_GET['product_id'])) {
    $product_id = intval($_GET['product_id']); // Get the product ID securely

    // Check if the cart exists in the session
    if (isset($_SESSION['basket'])) {
        // Remove the item from the cart
        unset($_SESSION['basket'][$product_id]);
    }
}

// Redirect back to the cart page
header('Location: cart.php'); // Replace 'cart.php' with the page displaying your cart
exit();
?>
