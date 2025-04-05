<?php
session_start();
include 'db.php';

// Check if the user is logged in
if (!isset($_SESSION['users_id'])) {
    echo "Please log in to view your order history.";
    exit;
}

// Get the logged-in user's ID
$users_id = $_SESSION['users_id'];

// Fetch orders with product details including images
$sql = "
    SELECT oi.order_info, oi.order_id, oi.product_id, oi.price, p.name, p.flavour, p.image_url
    FROM order_info oi
    JOIN product p ON oi.product_id = p.product_id
    WHERE oi.order_id IN (
        SELECT order_id FROM orders WHERE users_id = :users_id
    )
    ORDER BY oi.order_info ASC
";
$stmt = $pdo->prepare($sql);
$stmt->execute(['users_id' => $users_id]);
$orders = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order History</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <h1>Your Order History</h1>

    <?php if (count($orders) > 0): ?>
        <table>
            <thead>
                <tr>
                    <th>Order Info ID</th>
                    <th>Order ID</th>
                    <th>Product Name</th>
                    <th>Flavour</th>
                    <th>Image</th>
                    <th>Price</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($orders as $order): ?>
                    <tr>
                        <td><?= htmlspecialchars($order['order_info']) ?></td>
                        <td><?= htmlspecialchars($order['order_id']) ?></td>
                        <td><?= htmlspecialchars($order['name']) ?></td>
                        <td><?= htmlspecialchars($order['flavour']) ?></td>
                        <td>
                            <img src="<?= htmlspecialchars($order['image_url']) ?>" alt="<?= htmlspecialchars($order['name']) ?>" width="100">
                        </td>
                        <td>£<?= number_format($order['price'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>You have no order history.</p>
    <?php endif; ?>
</body>
</html>
