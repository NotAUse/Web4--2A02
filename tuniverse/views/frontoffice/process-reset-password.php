<?php

$token = $_POST["token"];
$token_hash = hash("sha256", $token);

// Include your database connection (update DSN, username, and password as needed)
try {
    $pdo = new PDO("mysql:host=localhost;dbname=login_db;charset=utf8mb4", "root", "");
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Query to fetch the user with the given reset token
$sql = "SELECT * FROM user WHERE reset_token_hash = :token_hash";
$stmt = $pdo->prepare($sql);
$stmt->bindParam(':token_hash', $token_hash);

$stmt->execute();
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if ($user === false) {
    die("Token not found.");
}

if (strtotime($user["reset_token_expires_at"]) <= time()) {
    die("Token has expired.");
}

// Password validations
if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters.");
}

if (!preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter.");
}

if (!preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number.");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match.");
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

// Update the user's password and clear the reset token
$sql = "UPDATE user
        SET password_hash = :password_hash,
            reset_token_hash = NULL,
            reset_token_expires_at = NULL
        WHERE id = :id";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':password_hash', $password_hash);
$stmt->bindParam(':id', $user["id"]);

$stmt->execute();

echo "Password updated. You can now log in.";
