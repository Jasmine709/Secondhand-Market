<?php
require 'db.php';
session_start();
$error = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $identifier = $_POST['identifier'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT id, username, password_hash, is_admin FROM users WHERE username = ? OR email = ?");
    $stmt->execute([$identifier, $identifier]);
    $user = $stmt->fetch();

    if ($user && $password === $user['password_hash']) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user'] = [
            'id' => $user['id'],
            'username' => $user['username'],
            'is_admin' => $user['is_admin']
        ];
        header('Location: index.php');
        exit();
    } else {
        $error = 'Invalid login credentials.';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Login</h2>
    <form method="POST">
        <label>Username or Email:</label>
        <input name="identifier" required>
        <label>Password:</label>
        <input type="password" name="password" required>
        <button type="submit" class="button">Login</button>
    </form>
    <p style="color:red;"><?= $error ?></p>
    <p>Don't have an account? <a href="register.php">Register here</a>.</p>
    <p><a href="index.php">← Back to Marketplace</a></p>
</div>
</body>
</html>
