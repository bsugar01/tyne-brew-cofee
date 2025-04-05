<?php
session_start();
include 'db.php'; // Start the session to access session data
require_once 'Order.php';

// Check if user is logged in (if session variable user_id is not set, redirect to login page)
if (!isset($_SESSION['users_id'])) {
    // If not logged in, show an error message
    echo "<p style='color: red;'>You must be logged in to proceed to checkout.</p>";
    echo "<a href='login.php'>Login to proceed</a>";
    exit; // Stop the checkout process
}

//Process order
$totalPrice = 0;

foreach($_SESSION['basket'] as $item)
{
    $totalPrice += $item['price'] * $item['quantity'];
}

$userID = $_SESSION['users_id'];

try
{
    $query = $pdo->prepare("INSERT INTO orders (users_id, total_price) VALUES ('$userID', '$totalPrice')");
    $query->execute();
}
catch(PDOException $e)
{
    echo "Error: " . $e;
}


$lastID = $pdo->lastInsertId();

try
{
    for($i = 0; $i < count($_SESSION['basket']); $i++)
    {
        $productID = $_SESSION['basket'][$i]['id'];
        $price = $_SESSION['basket'][$i]['quantity'] * $_SESSION['basket'][$i]['price'];

        //echo "Last ID: " . $lastID . ", product ID: " . $productID . ", price: " . $price;

        $query = $pdo->prepare("INSERT into order_info (order_id, product_id, price) VALUES ('$lastID', '$productID', '$price')");
        $query->execute();
    }
}
catch(PDOException $e)
{
    echo "Error: " . $e;
}

// If user is log in clear the basket
if (isset($_SESSION['basket'])){
    unset($_SESSION['basket']);  //clear basket
}


// If user is logged in, display order confirmation message

echo "<h1>Your order has been made. Thanks for shopping with us!</h1>";


?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Confirmation</title>
    <link rel="stylesheet" href="styles.css">
    
</head>
<body class="confirm">
    <p class="wow">
    
    </p>

    <button class="mem"><a href="member.php">back to home</a></button>
</body>
</html>