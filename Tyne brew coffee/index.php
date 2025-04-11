<?php
// Start the session to store basket information
session_start();
include 'db.php';

if(!isset($_SESSION['basket']))
{
   $_SESSION['basket'] = [];
}

// Handle adding product to basket
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['product_id'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    $productFound = false;

   for($i = 0; $i < count($_SESSION['basket']); $i++)
   {
      if($_SESSION['basket'][$i]['id'] === $product_id)
      {
         $_SESSION['basket'][$i]['quantity'] += $quantity;
         $productFound = true;
         break;
      }
   }

   if(!$productFound)
   {
      $_SESSION['basket'][] = 
      [
         'id' => $product_id,
         'name' => $_POST['product_name'],
         'flavour' => $_POST['flavour'],
         'price' => $_POST['price'],
         'image_url' => $_POST['image_url'],
         'quantity' => $quantity
      ];
   }

    // Check if the product already exists in the basket
   //  if (isset($_SESSION['basket'][$product_id])) {
   //      // Increase the quantity if the product is already in the basket
   //      $_SESSION['basket'][$product_id]['quantity'] += $quantity;
   //  } else {
   //      // Add the product to the basket
   //      $_SESSION['basket'][$product_id] = [
   //          'name' => $_POST['product_name'],
   //          'flavour' => $_POST['flavour'],
   //          'price' => $_POST['price'],
   //          'image_url' => $_POST['image_url'],
   //          'quantity' => $quantity,
   //      ];
   //  }
}

///print_r($_SESSION['basket']);

?>





<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Shrikhand">
    <link rel="preconnect" href="https://fonts.googleapis.com">
<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
<link href="https://fonts.googleapis.com/css2?family=Bitter:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">

    <title>Home</title>
</head>
<body>
   <nav>
    <div class="logo"><img src="image/logo2.png" alt="logo" href="home.html"></div>
    <ul>
   
    <li><a href="home.php">Home</a></li>
    <li><a href="aboutus.php">About us</a></li>
    <li><a href="login.php"><i class="fa-solid fa-user"></i></a></li>
    <li><a href="cart.php"><i class="fa-solid fa-cart-shopping"></i></a></li>
    </ul>
    
</ul>
   </nav>
   
<div class="container">
   
   <div class="text">
      <h1>Tyne Brew <br>coffee</h1>
  
   <p>Tyne Brew Coffee is a local gem known for its <br>
     dedication to delivering premium coffee blends crafted<br>
     with passion. Rooted in the heart of the community, <br>
     yne Brew combines quality ingredients with artisanal<br>
     roasting techniques to create distinctive flavors that<br>
     delight coffee lovers. From bold, rich brews to smooth,<br>
     aromatic options, each cup is a testament to their<br>
     commitment to excellence. Tyne Brew isn’t just about<br>
     great coffee; it’s about bringing people together over<br>
     warm, memorable moments, whether at home or on<br>
     the go</p>
     </div>
     <div class="pic">
      <img src="image/barista.png" alt="coffee beans">
     </div>
     </div>

     <section class="products">
    
      <?php
   
      // Query the database
      $sql = "SELECT * FROM product";
      $stmt = $pdo->prepare($sql);
      $stmt->execute();
      $products = $stmt->fetchAll(PDO::FETCH_ASSOC);

      if (count($products) > 0):
          foreach ($products as $product):
      ?>
         

          <ul class="products-details">
         <div class="image-container">
            <a href="<?=strtolower($product['name'])?>.php">
            <img src="<?= $product['image_url'] ?>" alt="<?= $product['name'] ?>">
            <div class="overlay"> More Information</div>
         </a>
          </div>
         
          
      
      <li>
         <h3 class="Coffee-Name"><?= $product['name'] ?></h3>
      </li>
      <li>
         <p class="coffee-falvour"><?= $product['flavour'] ?></p>
      </li>
      <li>
         <p class="price">Price:<?= $product['price'] ?></p>
      </li>
      <li>
      
      </li>

      <form method="POST">
                  <input type="hidden" name="product_id" value="<?= $product['product_id'] ?>">
                  <input type="hidden" name="product_name" value="<?= $product['name'] ?>">
                  <input type="hidden" name="flavour" value="<?= $product['flavour'] ?>">
                  <input type="hidden" name="price" value="<?= $product['price'] ?>">
                  <input type="hidden" name="image_url" value="<?= $product['image_url'] ?>">

                  <div class="quantity-controls">
                     <button type="button" class="decrease">-</button>
                     <input type="number" name="quantity" value="1" min="1" class="quantity-input">
                     <button type="button" class="increase">+</button>
                  </div>

                  <button type="submit">Add to basket</button>
               </form>
    
     
 
      </ul>
    
      <?php endforeach; ?>
      <?php else: ?>
         <p>No products found.</p>
      <?php endif; ?>
   </section>
      
      
         

     </section>
   </main>

     <footer>
      
      <div class="fot">
         <h3>Hours</h3>
         <p>Monday-Friday</p>
         <P>10A-6PM</P>
      </div>

      <div class="fot">
         <h3>Tyne Brew Coffee</h3>
         <p>708 Grey Street 
         <br>Newcastle</p>
         <P>tynebrew@gmail.com</P>
      </div>
      
 

</body>
</html>
