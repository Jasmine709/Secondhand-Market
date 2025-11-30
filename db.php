<?php
$host = getenv('DB_HOST') ?: 'marketdb.c0cth7e4562m.us-east-1.rds.amazonaws.com';
$db   = getenv('DB_NAME') ?: 'marketdb';
$user = getenv('DB_USER') ?: 'admin';
$pass = getenv('DB_PASS') ?: 'Passpass123';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=$charset";
$options = [
    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES utf8mb4"
];

try {
    $pdo = new PDO($dsn, $user, $pass, $options);
} catch (\PDOException $e) {
    throw new \PDOException($e->getMessage(), (int)$e->getCode());
}
?>
