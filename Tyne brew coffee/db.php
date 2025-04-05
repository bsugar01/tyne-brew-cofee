<?php
$host = 'localhost';  // Database host
$dbname = 'tyne';  // Your database name
$username = 'root';   // Default username in XAMPP
$password = '';       // Default password is empty in XAMPP
 
try {
    $pdo = new PDO("mysql:host=localhost;dbname=tyne", "root", "");
    // Set the PDO error mode to exception
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
