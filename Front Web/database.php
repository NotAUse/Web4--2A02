<?php

$host = "localhost";         // Replace with your host
$dbname = "login_db";        // Replace with your database name
$username = "root";          // Replace with your database username
$password = "";              // Replace with your database password

try {
    // Create a new PDO instance
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

    // Set PDO attributes to handle errors and exceptions
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);

    return $pdo; // Return the PDO connection
} catch (PDOException $e) {
    // Handle connection errors
    die("Connection error: " . $e->getMessage());
}
?>
