<?php

$email = $_POST["email"];
$token = bin2hex(random_bytes(16));
$token_hash = hash("sha256", $token);
$expiry = date("Y-m-d H:i:s", time() + 60 * 30);

// Include your database connection (update DSN, username, and password as needed)
try {
    $pdo = new PDO("mysql:host=localhost;dbname=tuniverse;charset=utf8mb4", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Connection failed: " . $e->getMessage());
}

// Update reset token in the database
$sql = "UPDATE user
        SET reset_token_hash = :token_hash,
            reset_token_expires_at = :expiry
        WHERE email = :email";

$stmt = $pdo->prepare($sql);
$stmt->bindParam(':token_hash', $token_hash);
$stmt->bindParam(':expiry', $expiry);
$stmt->bindParam(':email', $email);

$stmt->execute();

if ($stmt->rowCount() > 0) {
    // Email setup
    $mail = require __DIR__ . "/mailer.php";

    $mail->setFrom("clash.bouallegue@gmail.com");
    $mail->addAddress($email);
    $mail->Subject = "Password Reset";
    $mail->Body = <<<END

    Click <a href="http://localhost/tun2/views/frontoffice/reset-password.php?token=$token">here</a> 
    to reset your password.

    END;

    try {
        $mail->send();
        echo "Message sent, please check your inbox.";
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer error: ";
    }
} else {
    echo "No user found with this email address.";
}
