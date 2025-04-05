<?php
session_start();
include 'db.php'; // Include your database connection file

// Fetch all orders from the orders and order_info tables
$sql = "
    SELECT o.order_id, o.users_id, oi.order_info, oi.product_id, oi.price, p.name, p.flavour, p.image_url 
    FROM orders o
    JOIN order_info oi ON o.order_id = oi.order_id
    JOIN product p ON oi.product_id = p.product_id
    ORDER BY o.order_id DESC
";
$stmt = $pdo->prepare($sql);
$stmt->execute();
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Orders</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <center><h1 class="">Admin Order Management</h1></center>

    <!-- Styled Button for Manage Product -->
    <center>
        <a href="admin.php">
            <button class="manage-product-btn">Manage Product</button>
        </a>
    </center><br>
    
    <?php if (count($orders) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Product Name</th>
                    <th>Flavour</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= htmlspecialchars($order['order_id']) ?></td>
                        <td><?= htmlspecialchars($order['users_id']) ?></td>
                        <td><?= htmlspecialchars($order['name']) ?></td>
                        <td><?= htmlspecialchars($order['flavour']) ?></td>
                        <td><img src="<?= htmlspecialchars($order['image_url']) ?>" alt="<?= htmlspecialchars($order['name']) ?>" width="100"></td>
                        <td>£<?= number_format($order['price'], 2) ?></td>
                        <td>
                            <a href="delete_order.php?id=<?= $order['order_id'] ?>" onclick="return confirm('Are you sure you want to delete this order?')">Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No orders found.</p>
    <?php endif; ?>
</body>
</html>
