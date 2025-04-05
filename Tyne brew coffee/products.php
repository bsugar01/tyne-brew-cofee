<?php
// Include the database connection
include 'connection.php';

// Fetch products from the database
$sql = "SELECT * FROM product";

//it helps to execute the query and store the result
$result = $conn->query($sql);

//an empty array to store prodts
$products=[];

if ($result->num_rows > 0) {
    echo '<div class="products-container">';
    while ($row = $result->fetch_assoc()) {
       $products[]=$row;
    }
  
} 

// Close the database connection
$conn->close();
?>
