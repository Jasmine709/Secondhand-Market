<?php  
require 'db.php';
session_start();

$stmt = $pdo->query("SELECT id, title, description, price, image_url, created_at, user_id FROM items ORDER BY created_at DESC");
$items = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Marketplace</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<div class="navbar">
    <?php if (!empty($_SESSION['user'])): ?>
        <span style="margin-right: 20px;">Welcome, <?= htmlspecialchars($_SESSION['user']['username']) ?></span>
        <a href="logout.php">Logout</a> |
        <a href="submit_item.php">Post Item</a> |
        <a href="my_items.php">My Items</a>
    <?php else: ?>
        <a href="login.php">Login</a> |
        <a href="register.php">Register</a>
    <?php endif; ?>
</div>

<div class="container">
    <h1>Marketplace Items</h1>
    <?php foreach ($items as $item): ?>
        <div class="item-card">
            <?php if (!empty($item['image_url'])): ?>
                <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="Item Image">
            <?php endif; ?>
            <div class="item-card-content">
                <h3><a href="item.php?id=<?= $item['id'] ?>"><?= htmlspecialchars($item['title']) ?></a></h3>
                <p><strong>Price:</strong> $<?= number_format($item['price'], 2) ?></p>
                <p><?= htmlspecialchars($item['description']) ?></p>
                <small>Posted on: <?= $item['created_at'] ?></small>
                <?php
                $isOwner = isset($_SESSION['user']) && $_SESSION['user']['id'] == $item['user_id'];
                $isAdmin = isset($_SESSION['user']) && !empty($_SESSION['user']['is_admin']);
                ?>
                <?php if ($isOwner || $isAdmin): ?>
                    <form action="delete_item.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');" style="margin-top: 10px;">
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <button type="submit" class="button delete-btn">Delete</button>
                    </form>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
</body>
</html>
