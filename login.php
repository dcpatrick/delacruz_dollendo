<?php
session_start();

$adminUser = "admin";
$adminPass = "admin123";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = $_POST['username'] ?? '';
    $password = $_POST['password'] ?? '';

    if ($username === $adminUser && $password === $adminPass) {
        $_SESSION['username'] = $username;
        header("Location: homepage.php");
        exit;
    } else {
        // Redirect back to login.html with error parameter
        header("Location: login.html?error=1");
        exit;
    }
} else {
    // If accessed without POST, redirect to login form
    header("Location: login.html");
    exit;
}
?>
