<?php


include('db.php');
include('csrf.php');
?>

 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
    <title>Login</title>
 </head>
 <body class="con">
     <div class="login-box">
        <h2>Login</h2>
    <form method="POST" action="login.php">
    <input type="text" name="username" placeholder="Username" required>
    <input type="password" name="password" placeholder="Password" required>
    <input type="hidden" name="csrf_token" value="<?php echo generate_token(); ?>">
    <button type="submit" class="login-button">Login</button>
    </form>
 <div class="signup">
        <span clas="signup"> Dont have an account?
        <label for="check"><a href="register.php">Signup</a></label>
    </span>
</div>

</div>




 </body>
 </html>

<?php
 
 if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || !validate_token($_POST['csrf_token'])) {
        die('Invalid CSRF token.');
    }
 
    $username = htmlspecialchars(trim($_POST['username']));

    $password = $_POST['password'];
 
    // Prepare SQL query to prevent SQL injection
    $sql = "SELECT * FROM users WHERE username = :username";
    $stmt = $pdo->prepare($sql);
    $stmt->bindParam(':username', $username);
    $stmt->execute();
 
    // Check if user exists and password matches
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($user && password_verify($password, $user['password'])) {
        // Set session for user
        $_SESSION['users_id'] = $user['users_id']; // Store user ID
        $_SESSION['username'] = $user['username']; // Store username
        $_SESSION['role'] = $user['role']; // Store role (user or admin)

        // Redirect to appropriate page based on role
        if ($_SESSION['role'] === 'admin') {
            header('Location: admin.php');  // Admin dashboard
        } else {
            header('Location: member.php');  // Regular user page
        }
        exit;
    } else {
        echo 'Invalid username or password.';
    }
}

?>
