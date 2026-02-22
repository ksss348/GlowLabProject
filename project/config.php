<?php

// Database connection settings
$host = 'localhost';
$user = 'root';
$pass = '';
$db   = 'skincare_shop'; // Ensure this matches your phpMyAdmin database name

// 1. Connection for home.php (MySQLi style)
$conn = mysqli_connect($host, $user, $pass, $db) or die('Connection failed');

// 2. Connection for product.php (PDO style)
// We keep this here so both types of pages work
try {
    $dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    // If PDO fails, we don't necessarily want to kill the whole script 
    // unless the page specifically requires it.
}

?>