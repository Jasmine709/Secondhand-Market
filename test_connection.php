<?php
$host = 'marketdb.c0cth7e4562m.us-east-1.rds.amazonaws.com';
$db   = 'marketdb';
$user = 'admin';
$pass = 'Passpass123'; // make sure this is correct
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
    echo "✅ Connection to AWS RDS succeeded.";
} catch (\PDOException $e) {
    echo "❌ Connection failed: " . $e->getMessage();
}
?>
