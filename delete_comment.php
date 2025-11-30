<?php
require 'db.php';
session_start();

$comment_id = $_GET['id'] ?? null;
$item_id = $_GET['item_id'] ?? null;

if (!$comment_id || !$item_id) {
    die("Missing parameters.");
}

if (empty($_SESSION['user']) || empty($_SESSION['user']['is_admin'])) {
    die("Unauthorized.");
}

try {
    $stmt = $pdo->prepare("DELETE FROM comments WHERE id = ?");
    $stmt->execute([$comment_id]);
    header("Location: item.php?id=" . $item_id);
    exit;
} catch (PDOException $e) {
    die("Error deleting comment: " . $e->getMessage());
}
