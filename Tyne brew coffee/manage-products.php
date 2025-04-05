<?php
session_start();

// Include the database connection
include('db.php');

// Check if user is logged in as admin
//if (!isset($_SESSION['users_id']) || $_SESSION['user_role'] != 'admin') {
    //header('Location: login.php');
    //exit;
//}

// Fetch products from the database
try {
    $stmt = $pdo->query("SELECT * FROM product");  // Query to fetch all products
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);  // Fetch products as associative array
} catch (PDOException $e) {
    echo "Error fetching products: " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Products</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Manage Products</h1>
    
    <table border="1">
        <thead>
            <tr>
                <th>Product Name</th>
                <th>Price</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php if (!empty($product)) { 
                foreach ($products as $product) { ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td>£<?php echo number_format($product['price'], 2); ?></td>
                        <td>
                            <!-- Action buttons for edit, delete -->
                            <a href="edit-product.php?id=<?php echo $product['id']; ?>">Edit</a> | 
                            <a href="delete-product.php?id=<?php echo $product['id']; ?>" onclick="return confirm('Are you sure?')">Delete</a>
                        </td>
                    </tr>
            <?php } } else { ?>
                <tr>
                    <td colspan="3">No products available</td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    <br>
    <button><a href="add-product.php">Add New Product</a></button>
</body>
</html>
