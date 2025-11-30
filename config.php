<?php
function connectDB() {
  $host = "localhost"; // 替换为你的 RDS 地址
  $user = "root";      // 替换为你的数据库用户名
  $pass = "";          // 替换为你的密码
  $db   = "market";    // 替换为你的数据库名
  $conn = new mysqli($host, $user, $pass, $db);
  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
  return $conn;
}
?>
