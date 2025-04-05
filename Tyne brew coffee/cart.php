<?php
session_start();  // Start the session to access session data

// Calculate total price
$total_price = 0;
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Shrikhand">
    <link href="https://fonts.googleapis.com/css2?family=Bitter:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Your Basket</title>
</head>
<body>
   <nav>
      <div class="logo"><img src="image/logo2.png" alt="logo"></div>
      <ul>
         <li><a href="home.php">Home</a></li>
         <li><a href="aboutus.php">About us</a></li>
         <li><a href="login.php"><i class="fa-solid fa-user"></i></a></li>
         <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
      </ul>
   </nav>

   <div class="container">
    <style>
        td, th {
            border: 0px;
            border-collapse: collapse;
            padding: 10px 30px 20px 40px;
        }
        th {
            background: purple;
            color: white;
        }
        .basket-total {
            margin-top: 20%;
            text-align: center;
        }
    </style>

    <table style="width:100%">
        <tr>
            <th>Image</th>
            <th>Product</th>
            <th>Flavour</th>
            <th>Price</th>
            <th>Quantity</th>
            <th>Total</th>
            <th>Action</th>
        </tr>
        <?php
        // Check if the basket is set and is an array
        if (isset($_SESSION['basket']) && is_array($_SESSION['basket']) && count($_SESSION['basket']) > 0) {
            foreach ($_SESSION['basket'] as $product_id => $product) {
                $total_price += $product['price'] * $product['quantity'];
        ?>
        <tr>
       <td><img src="<?= htmlspecialchars($product['image_url']) ?>" 
             
             style="width: 100px; height: auto;"></td>
            <td><?= htmlspecialchars($product['name']) ?></td>
            <td><?= htmlspecialchars($product['flavour']) ?></td>
            <td>£<?= number_format($product['price'], 2) ?></td>
            <td><?= htmlspecialchars($product['quantity']) ?></td>
            <td>£<?= number_format($product['price'] * $product['quantity'], 2) ?></td>
            <td>
                <!-- Link to remove item from cart -->
                <a href="remove.php?product_id=<?= urlencode($product_id) ?>" class="remove">Remove</a>
            </td>
        </tr>
        <?php
            }
        } else { // If the basket is empty, display this row
        ?>
        <tr>
            <td colspan="6" style="text-align: center;">Your basket is empty.</td>
        </tr>
        <?php
        }
        ?>
    </table>

    <div class="basket-total">
        <p>Total: £<?= number_format($total_price, 2) ?></p>
        <!-- Link to proceed to checkout -->
        <?php if ($total_price > 0) { ?>
            <a href="checkout.php" class="checkout-button">Checkout</a>
        <?php } ?>
    </div>
   </div>
<br><br>
   <footer>
      <div class="fot">
         <h3>Hours</h3>
         <p>Monday-Friday</p>
         <p>10AM-6PM</p>
      </div>
      <div class="fot">
         <h3>Tyne Brew Coffee</h3>
         <p>708 Grey Street <br>Newcastle</p>
         <p>tynebrew@gmail.com</p>
      </div>
   </footer>
</body>
</html>
