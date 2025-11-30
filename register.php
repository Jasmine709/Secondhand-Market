<?php
require 'db.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$username, $email]);

    if ($stmt->fetch()) {
        echo "<script>alert('Username or email already registered.');window.history.back();</script>";
    } else {
        $hash = $password;  
        $stmt = $pdo->prepare("INSERT INTO users (username, email, password_hash, is_admin) VALUES (?, ?, ?, 0)");
        $stmt->execute([$username, $email, $hash]);
        echo "<script>alert('Registration successful! You can now login.');window.location.href='login.php';</script>";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Register</h2>
    <form method="POST">
        <label>Username:</label>
        <input name="username" required>
        <label>Email:</label>
        <input type="email" name="email" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <button type="submit" class="button">Register</button>
    </form>
    <p><a href="index.php">← Back to Marketplace</a></p>
</div>
</body>
</html>
