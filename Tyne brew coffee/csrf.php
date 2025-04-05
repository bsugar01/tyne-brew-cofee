<?php
session_start();
 
// Function to generate a CSRF token
function generate_token() {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}
 
// Function to validate CSRF token
function validate_token($token) {
    if ($token === $_SESSION['csrf_token']) {
        return true;
    }
    return false;
}
?>
