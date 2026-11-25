<?php
declare(strict_types=1);
session_start();

$host = 'localhost';
$dbname = 'school_bus_tracking';
$dbuser = 'root';
$dbpass = ''; // Default XAMPP MySQL password is usually empty.

try {
    $pdo = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8mb4",
        $dbuser,
        $dbpass,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
         PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
    );
} catch (PDOException $e) {
    die('Database connection failed. Check that MySQL is running and database/schema.sql was imported. Details: '
        . htmlspecialchars($e->getMessage()));
}

function e($value): string {
    return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8');
}
