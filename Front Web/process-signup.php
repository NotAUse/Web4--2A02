<?php

// Input validation
if (empty($_POST["name"])) {
    die("Name is required");
}



if (strlen($_POST["password"]) < 8) {
    die("Password must be at least 8 characters");
}

if (!preg_match("/[a-z]/i", $_POST["password"])) {
    die("Password must contain at least one letter");
}

if (!preg_match("/[0-9]/", $_POST["password"])) {
    die("Password must contain at least one number");
}

if ($_POST["password"] !== $_POST["password_confirmation"]) {
    die("Passwords must match");
}

// Hash the password
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

// Include the database connection
require_once __DIR__ . "/database.php";

try {
    // Prepare SQL query
    $sql = "INSERT INTO user (name, email, password_hash) VALUES (:name, :email, :password_hash)";
    
    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':name', $_POST["name"]);
    $stmt->bindParam(':email', $_POST["email"]);
    $stmt->bindParam(':password_hash', $password_hash);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: profile.html");
        exit;
    } else {
        die("Failed to execute the query.");
    }
} catch (PDOException $e) {
    // Check for duplicate email
    if ($e->getCode() == 23000) { // SQLSTATE 23000 indicates a unique constraint violation
        die("Email already taken");
    } else {
        die("Database error: " . $e->getMessage());
    }
}
?>
