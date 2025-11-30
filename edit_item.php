<?php
session_start();
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
require 'db.php';

$id = $_GET['id'] ?? null;
if (!$id) die('Invalid item ID.');

$stmt = $pdo->prepare("SELECT * FROM items WHERE id = ?");
$stmt->execute([$id]);
$item = $stmt->fetch();
if (!$item) die('Item not found.');

$isOwner = $_SESSION['user_id'] == $item['user_id'];
$isAdmin = !empty($_SESSION['user']['is_admin']);
if (!$isOwner && !$isAdmin) die('Unauthorized.');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $image_url = $_POST['image_url'] ?? $item['image_url'];

    $stmt = $pdo->prepare("UPDATE items SET title=?, description=?, price=?, image_url=? WHERE id=?");
    $stmt->execute([$title, $description, $price, $image_url, $id]);
    header("Location: item.php?id=" . $id);
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Edit Item</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h2>Edit Item</h2>
    <form method="post">
        <label>Title:</label>
        <input name="title" value="<?= htmlspecialchars($item['title']) ?>" required>
        <label>Description:</label>
        <textarea name="description" required><?= htmlspecialchars($item['description']) ?></textarea>
        <label>Price:</label>
        <input type="number" name="price" step="0.01" value="<?= $item['price'] ?>" required>
        <label>Image URL:</label>
        <input name="image_url" value="<?= htmlspecialchars($item['image_url']) ?>">
        <button type="submit" class="button">Update</button>
    </form>
    <p><a href="index.php">← Back</a></p>
</div>
</body>
</html>
