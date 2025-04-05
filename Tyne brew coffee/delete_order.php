<?php
session_start();
include 'db.php'; // Include your database connection file

// Check if the user is logged in as an admin

if (isset($_GET['id'])) {
    $order_id = $_GET['id'];
    
    // Delete the order from the order_info and orders tables
    $sql = "DELETE FROM order_info WHERE order_id = :order_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['order_id' => $order_id]);
    
    $sql = "DELETE FROM orders WHERE order_id = :order_id";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(['order_id' => $order_id]);
    
    echo "Order deleted successfully.";
    header('Location: adminorder.php');
} else {
    echo "No order ID specified.";
    exit;
}
?>
