<?php
require 'db.php';
session_start();

$item_id = $_GET['id'] ?? null;
if (!$item_id) die("Item ID is missing.");

$stmt = $pdo->prepare("SELECT * FROM items WHERE id = ?");
$stmt->execute([$item_id]);
$item = $stmt->fetch();
if (!$item) die("Item not found.");

$comment_stmt = $pdo->prepare("SELECT * FROM comments WHERE item_id = ? ORDER BY created_at DESC");
$comment_stmt->execute([$item_id]);
$comments = $comment_stmt->fetchAll();

$isOwner = isset($_SESSION['user']) && $_SESSION['user']['id'] == $item['user_id'];
$isAdmin = isset($_SESSION['user']) && !empty($_SESSION['user']['is_admin']);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($item['title']) ?></title>
    <link rel="stylesheet" href="style.css">
    <style>
        .comment {
            background: #fff9fc;
            border-left: 4px solid #ffb3d9;
            margin-top: 20px;
            padding: 12px 16px;
            border-radius: 6px;
            position: relative;
        }

        .comment strong {
            color: #cc0077;
        }

        .comment small {
            position: absolute;
            top: 12px;
            right: 16px;
            color: #999;
            font-size: 13px;
        }

        .comment p {
            margin-top: 8px;
            margin-bottom: 8px;
        }
    </style>
</head>
<body>
<div class="container">
    <div class="item-card">
        <?php if ($item['image_url']): ?>
            <img src="<?= htmlspecialchars($item['image_url']) ?>" alt="Image">
        <?php endif; ?>
        <div class="item-card-content">
            <h2><?= htmlspecialchars($item['title']) ?></h2>
            <p><strong>Description:</strong> <?= htmlspecialchars($item['description']) ?></p>
            <p><strong>Price:</strong> $<?= number_format($item['price'], 2) ?></p>
            <p><small>Posted on: <?= $item['created_at'] ?></small></p>
            <?php if ($isOwner || $isAdmin): ?>
                <p><a href="edit_item.php?id=<?= $item['id'] ?>" class="button">Edit</a></p>
            <?php endif; ?>
        </div>
    </div>

    <h2>Comments</h2>
    <?php foreach ($comments as $comment): ?>
        <div class="comment">
            <strong><?= htmlspecialchars($comment['username']) ?>:</strong>
            <p><?= nl2br(htmlspecialchars($comment['content'])) ?></p>
            <small><?= $comment['created_at'] ?></small>
            <?php if ($isAdmin): ?>
                <br><a href="delete_comment.php?id=<?= $comment['id'] ?>&item_id=<?= $item_id ?>" class="button delete-btn">Delete</a>
            <?php endif; ?>
        </div>
    <?php endforeach; ?>

    <?php if (isset($_SESSION['user'])): ?>
        <h3>Add a Comment</h3>
        <form action="submit_comment.php" method="POST">
            <input type="hidden" name="item_id" value="<?= $item_id ?>">
            <textarea name="content" placeholder="Write your comment..." required></textarea><br>
            <button type="submit" class="button">Submit Comment</button>
        </form>
    <?php else: ?>
        <p><a href="login.php">Login</a> to comment.</p>
    <?php endif; ?>

    <p><a href="index.php">← Back to Marketplace</a></p>
</div>
</body>
</html>
