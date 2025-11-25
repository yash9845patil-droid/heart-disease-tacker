<?php
// config.php
$dbHost = 'localhost';
$dbName = 'heart_db';
$dbUser = 'root';
$dbPass = ''; // set to your MySQL password

try {
    $pdo = new PDO("mysql:host=$dbHost;dbname=$dbName;charset=utf8mb4", $dbUser, $dbPass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
    ]);
} catch (PDOException $e) {
    die("Database connection failed: " . $e->getMessage());
}
