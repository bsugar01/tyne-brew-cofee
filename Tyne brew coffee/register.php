<?php
include('db.php');
include('csrf.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Validate CSRF token
    if (!isset($_POST['csrf_token']) || !validate_token($_POST['csrf_token'])) {
        die('Invalid CSRF token.');
    }

    // Sanitize and validate inputs
    $username = htmlspecialchars(trim($_POST['username']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword']; // Make sure to get this value from the form
    $error_message = "";

    // Check if password and confirm password match
    if ($password !== $confirmPassword) {
        $error_message = "Passwords do not match.";
    }

    // Check if username already exists in the database
    if (empty($error_message)) {
        $sql = "SELECT * FROM users WHERE username = :username";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':username', $username);
        $stmt->execute();

        if ($stmt->rowCount() > 0) {
            $error_message = "Username already exists. Please choose a different username.";
        }
    }

    // If no error, proceed to register the user
    if (empty($error_message)) {
        // Hash the password before storing it
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Prepare SQL query to insert new user
        $sql = "INSERT INTO users (username, password, email) VALUES (:username, :password, :email)";
        $stmt = $pdo->prepare($sql);

        // Bind parameters
        $stmt->bindParam(':username', $username);
        $stmt->bindParam(':password', $hashed_password);
        $stmt->bindParam(':email', $email);

        if ($stmt->execute()) {
            echo 'Registration successful!';
        } else {
            echo 'Error: Could not register user.';
        }
    }
}
?>

<!-- Registration Form -->

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="styles.css">
  <title>Document</title>
</head>
<body class="con">
  
<div class="login-box">
     <h2>Sign Up</h2>
<br>

      <form method="POST" action="register.php">
        <input type="text" name="username" placeholder="Username" required>
        <input type="email" name="email" placeholder="Enter your email">
        <input type="password" name="password" placeholder="Create a password">
        <input type="password" name="confirmPassword" placeholder="Confirm your password" required>
        <input type="hidden" name="csrf_token" value="<?php echo generate_token(); ?>">
        <button type="submit" class="sign">Signup</button>
      </form>

      <?php if (!empty($error_message)): ?>
        <p class="error-message"><?= $error_message; ?></p>
      <?php endif; ?>
     
      <p> Already have an account? <a href="login.php">Login</a></p>
</div>
  
</body>
</html>

 
<!-- Registration Form -->




