<?php
session_start();
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require 'db.php';
$user_id = $_SESSION['user_id'];

$stmt = $pdo->prepare("SELECT * FROM items WHERE user_id = ? ORDER BY created_at DESC");
$stmt->execute([$user_id]);
$items = $stmt->fetchAll();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>My Items</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="container">
    <h1>My Posted Items</h1>
    <p><a href="index.php">← Back to Marketplace</a></p>

    <?php if (empty($items)): ?>
        <p>You have not posted any items yet.</p>
    <?php else: ?>
        <?php foreach ($items as $item): ?>
            <div class="item-card">
                <?php if (!empty($item['image_url'])): ?>
                    <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="Item Image">
                <?php endif; ?>
                <div class="item-card-content">
                    <h3><?= htmlspecialchars($item['title']) ?></h3>
                    <p><strong>Description:</strong> <?= htmlspecialchars($item['description']) ?></p>
                    <p><strong>Price:</strong> $<?= number_format($item['price'], 2) ?></p>
                    <small>Posted on: <?= $item['created_at'] ?></small><br>
                    <a href="item.php?id=<?= $item['id'] ?>" class="button">View</a>
                    <a href="edit_item.php?id=<?= $item['id'] ?>" class="button">Edit</a>
                    <form action="delete_item.php" method="POST" onsubmit="return confirm('Are you sure you want to delete this item?');" style="display:inline;">
                        <input type="hidden" name="id" value="<?= $item['id'] ?>">
                        <button type="submit" class="button delete-btn">Delete</button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
</body>
</html>
