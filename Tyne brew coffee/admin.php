<?php
session_start();







include 'db.php';  

// Fetch all products from the database
try {
    $stmt = $pdo->query("SELECT * FROM product");
    $products = $stmt->fetchAll(PDO::FETCH_ASSOC);
} catch (PDOException $e) {
    echo "Error fetching products: " . $e->getMessage();
}


// Handle editing a product
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['edit_product'])) {
    $product_id = $_POST['product_id'];
    $name = $_POST['name'];
    $flavour = $_POST['flavour'];
    $price = $_POST['price'];
    $quantity = $_POST['quantity'];
    $image_url = $_POST['image_url'];

    try {
        $stmt = $pdo->prepare("UPDATE product SET name = ?, flavour = ?, price = ?, quantity = ?, image_url = ? WHERE product_id = ?");
        $stmt->execute([$name, $flavour, $price, $quantity, $image_url, $product_id]);
        echo "Product updated successfully.";
        header("Location: admin.php");  // Redirect to avoid resubmitting the form
    } catch (PDOException $e) {
        echo "Error updating product: " . $e->getMessage();
    }
}


// Handle deleting a product
if (isset($_GET['delete'])) {
    $product_id = $_GET['delete'];
    
    try {
        $stmt = $pdo->prepare("DELETE FROM product WHERE product_id = ?");
        $stmt->execute([$product_id]);
        echo "Product deleted successfully.";
        header("Location: admin.php");  // Redirect to avoid resubmitting the form
    } catch (PDOException $e) {
        echo "Error deleting product: " . $e->getMessage();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="styles.css">
   

   
</head>
<body>

    <center> <h1 class="admin">Admin Dashboard</h></center>
    
    <a href="logout.php">logout</a>
    <a href="adminorder.php"> Manage order</a>

    
    <!-- Display products -->
    <table>
        <thead>
            <tr>
                <th>Image</th>
                <th>Product ID</th>
                <th>Name</th>
                <th>Flavour</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($products as $product): ?>
            <tr>
                
            <td><img src="<?= htmlspecialchars($product['image_url']) ?>"
            style="width: 100px; height: auto;"></td>
                
                <td><?php echo htmlspecialchars($product['product_id']); ?></td>
                <td><?php echo htmlspecialchars($product['name']); ?></td>
                <td><?php echo htmlspecialchars($product['flavour']); ?></td>
                <td><?php echo htmlspecialchars($product['price']); ?></td>
                <td><?php echo htmlspecialchars($product['quantity']); ?></td>
                <td>
                <a class="b" href="edit.php?  id=<?php echo $product['product_id']; ?> " class="b">
        <button class="edit"><i class="fa-regular fa-pen-to-square"></i>Edit </button>
    
        </ac>
                    <a class="b"href="?delete=<?php echo $product['product_id']; ?>" onclick="return confirm('Are you sure you want to delete this product?')"><button class="del"><i class="fa-solid fa-trash"></i>delete</button></a>
                    
                <a class="b" href="addproduct.php"><button class="add"><i class="fa-solid fa-plus"></i> Add</button></a>

                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    
   
    
</body>
</html>
