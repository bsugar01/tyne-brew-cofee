<?php
session_start();
include 'db.php'; 

// Check if product ID is provided
if (!isset($_GET['id'])) {
    die("Product ID is required.");
}

$product_id = $_GET['id'];

// Fetch product details
try {
    $stmt = $pdo->prepare("SELECT * FROM product WHERE product_id = ?");
    $stmt->execute([$product_id]);
    $product = $stmt->fetch(PDO::FETCH_ASSOC);

    if (!$product) {
        die("Product not found.");
    }
} catch (PDOException $e) {
    echo "Error fetching product: " . $e->getMessage();
    exit;
}

// Handle form submission for editing product
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $flavour = $_POST['flavour'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image_url = $_POST['image_url'];

    try {
        $stmt = $pdo->prepare("UPDATE product SET name = ?, flavour = ?, price = ?, quantity = ?, image_url = ? WHERE product_id = ?");
        $stmt->execute([$name, $flavour, $price, $quantity, $image_url, $product_id]);

        echo "Product updated successfully.";
        header("Location: admin.php"); // Redirect back to admin dashboard
        exit;
    } catch (PDOException $e) {
        echo "Error updating product: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="ed">


<div class="ee">            
    <h1>Edit Product</h1>
    <form method="POST">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($product['name']); ?>" required><br><br>

        <label for="flavour">Flavour:</label><br>
        <input type="text" id="flavour" name="flavour" value="<?php echo htmlspecialchars($product['flavour']); ?>" required><br><br>

        <label for="price">Price:</label><br>
        <input type="text" id="price" name="price" value="<?php echo htmlspecialchars($product['price']); ?>" required><br><br>

        <label for="quantity">Quantity:</label><br>
        <input type="text" id="quantity" name="quantity" value="<?php echo htmlspecialchars($product['quantity']); ?>" required><br><br>

        <label for="image_url">Image URL:</label><br>
        <input type="text" id="image_url" name="image_url" value="<?php echo htmlspecialchars($product['image_url']); ?>" required><br><br>

        <button type="submit">Update Product</button>
    </form>
</div>
</body>
</html>
