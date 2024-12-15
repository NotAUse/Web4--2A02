<?php

// Include the database connection
require_once(__DIR__ . '/../../config/database.php');


try {
    
    // Hash the password
    $password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

    // Prepare SQL query
    $sql = "INSERT INTO user (name, email, password_hash) VALUES (:fullname, :email, :password_hash)";
    
    $stmt = $pdo->prepare($sql);

    // Bind parameters
    $stmt->bindParam(':fullname', $_POST["fullName"]);
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
