<?php
session_start();
include 'db.php'; // Include database connection

// Handle adding a product
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $flavour = $_POST['flavour'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image_url = $_POST['image_url'];

    try {
        $stmt = $pdo->prepare("INSERT INTO product (name, flavour, price, quantity, image_url) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$name, $flavour, $price, $quantity, $image_url]);
        header("Location: admin.php");
        exit;
    } catch (PDOException $e) {
        echo "Error adding product: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product</title>
    <link rel="stylesheet" href="styles.css">
    
</head>
<body>
 <center> <h3>Add Product</h3></center>
<section class="ad">



    <form  class="add" method="POST" action="">
        <label for="name">Name:</label>
        <input type="text" name="name" required>
        
        <label for="flavour">Flavour:</label>
        <input type="text" name="flavour" required>
        
        <label for="price">Price:</label>
        <input type="number" name="price" required>
        
        <label for="quantity">Quantity:</label>
        <input type="number" name="quantity" required>
        
        <label for="image_url">Image URL:</label>
        <input type="text" name="image_url" required>
        
        <button class="submit-btn" type="submit">Add Product</button>
    </form>

</section>


</body>
</html>
