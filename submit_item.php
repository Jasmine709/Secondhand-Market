<?php
session_start();
if (empty($_SESSION['user_id'])) {
    header('Location: login.php');
    exit;
}
require 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $description = $_POST['description'];
    $price = $_POST['price'];
    $imagePath = '';
    $user_id = $_SESSION['user_id'];

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $uploadDir = 'uploads/';
        $filename = uniqid() . '_' . basename($_FILES['image']['name']);
        $targetPath = $uploadDir . $filename;

        if (move_uploaded_file($_FILES['image']['tmp_name'], $targetPath)) {
            $imagePath = $targetPath;
        }
    }

    try {
        $stmt = $pdo->prepare("INSERT INTO items (title, description, price, image_url, user_id) VALUES (?, ?, ?, ?, ?)");
        $stmt->execute([$title, $description, $price, $imagePath, $user_id]);
        header("Location: index.php");
        exit;
    } catch (PDOException $e) {
        die("Error inserting item: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Post New Item</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .form-group {
            margin-bottom: 20px;
        }

        label {
            font-weight: bold;
            display: block;
            margin-bottom: 6px;
            color: #444;
        }

        #filename {
            margin-left: 10px;
            color: #555;
            font-size: 14px;
        }

        .custom-upload-btn {
            background-color: #ffe5f2;
            color: #cc0077;
            border: 1.5px solid #ff80bf;
            padding: 6px 14px;
            border-radius: 24px;
            font-size: 13px;
            font-weight: bold;
            cursor: pointer;
            transition: all 0.2s ease-in-out;
            display: inline-block;
        }

        .custom-upload-btn:hover {
            background-color: #ffd6eb;
            border-color: #ff66aa;
            color: #b3005f;
        }
    </style>
</head>
<body>
<div class="container">
    <h1>Post New Item</h1>
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label>Title:</label>
            <input type="text" name="title" required>
        </div>

        <div class="form-group">
            <label>Description:</label>
            <textarea name="description" rows="5" required></textarea>
        </div>

        <div class="form-group">
            <label>Price:</label>
            <input type="number" step="0.01" name="price" required>
        </div>

        <div class="form-group">
            <label>Upload picture:</label>
            <label for="image" class="custom-upload-btn">Choose File</label>
            <span id="filename">No file selected</span>
            <input type="file" name="image" id="image" accept="image/*" style="display: none;">
        </div>

        <button type="submit">Submit</button>
    </form>

    <p><a href="index.php">← Back to Marketplace</a></p>
</div>

<script>
    const input = document.getElementById('image');
    const filenameDisplay = document.getElementById('filename');

    input.addEventListener('change', function () {
        filenameDisplay.textContent = input.files.length > 0 ? input.files[0].name : 'No file selected';
    });
</script>
</body>
</html>
