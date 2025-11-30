<?php
session_start();
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item_id = $_POST['item_id'] ?? null;
    $content = trim($_POST['content'] ?? '');
    $username = $_SESSION['user']['username'] ?? null;

    if ($item_id && $username && $content) {
        $stmt = $pdo->prepare("INSERT INTO comments (item_id, username, content) VALUES (?, ?, ?)");
        $stmt->execute([$item_id, $username, $content]);

        header("Location: item.php?id=" . urlencode($item_id));
        exit;
    } else {
        die("Missing required fields.");
    }
} else {
    die("Invalid request.");
}
