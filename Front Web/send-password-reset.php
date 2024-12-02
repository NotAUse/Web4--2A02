<?php

$email = $_POST["email"];

// Generate a secure random token
$token = bin2hex(random_bytes(16));

// Hash the token for secure storage
$token_hash = hash("sha256", $token);

// Set the token expiry time (30 minutes from now)
$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

try {
    // Include the database connection
    $pdo = require __DIR__ . "/database.php";

    // Update the user's reset token and expiry time
    $sql = "UPDATE user
            SET reset_token_hash = :token_hash,
                reset_token_expires_at = :expiry
            WHERE email = :email";

    // Prepare the SQL statement
    $stmt = $pdo->prepare($sql);

    // Bind parameters to prevent SQL injection
    $stmt->bindParam(':token_hash', $token_hash);
    $stmt->bindParam(':expiry', $expiry);
    $stmt->bindParam(':email', $email);

    // Execute the statement
    $stmt->execute();

    // Check if any row was updated
    if ($stmt->rowCount() > 0) {
        // Include the mailer script
        $mail = require __DIR__ . "/mailer.php";

        // Configure email settings
        $mail->setFrom("TUNIVERSE@gmail.com");
        $mail->addAddress($email);
        $mail->Subject = "Password Reset";

        // Email body
        $mail->Body = <<<END
        Click <a href="http://example.com/reset-password.php?token=$token">here</a> 
        to reset your password.
        END;

        try {
            // Send the email
            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer error: {$mail->ErrorInfo}";
        }

        echo "Message sent, please check your inbox.";
    } else {
        echo "No user found with that email address.";
    }
} catch (PDOException $e) {
    // Handle database errors
    die("Database error: " . $e->getMessage());
}
?>
