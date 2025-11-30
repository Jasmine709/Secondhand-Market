<?php
require 'db.php';
$stmt = $pdo->query("SELECT id, username, email, created_at FROM users ORDER BY created_at DESC");
$users = $stmt->fetchAll();
?>

<h1>Registered Users</h1>
<table border="1" cellpadding="8">
    <tr>
        <th>ID</th><th>Username</th><th>Email</th><th>Created At</th>
    </tr>
    <?php foreach ($users as $u): ?>
        <tr>
            <td><?= $u['id'] ?></td>
            <td><?= htmlspecialchars($u['username']) ?></td>
            <td><?= htmlspecialchars($u['email']) ?></td>
            <td><?= $u['created_at'] ?></td>
        </tr>
    <?php endforeach; ?>
</table>
