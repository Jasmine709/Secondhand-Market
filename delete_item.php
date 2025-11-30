<?php
session_start();
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}

require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = (int) $_POST['id'];

    $stmt = $pdo->prepare("SELECT user_id, image_url FROM items WHERE id = ?");
    $stmt->execute([$id]);
    $item = $stmt->fetch();

    if ($item) {
        $isOwner = $_SESSION['user_id'] == $item['user_id'];
        $isAdmin = !empty($_SESSION['user']['is_admin']);
        if (!$isOwner && !$isAdmin) {
            die('Unauthorized: You are not allowed to delete this item.');
        }

        if (!empty($item['image_url']) && file_exists($item['image_url'])) {
            unlink($item['image_url']);
        }

        $stmt = $pdo->prepare("DELETE FROM items WHERE id = ?");
        $stmt->execute([$id]);
    }
}

header("Location: index.php");
exit;
