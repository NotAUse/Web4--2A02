<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        // Include the database connection
        $pdo = require __DIR__ . "/database.php";

        // Prepare the SQL statement with a placeholder
        $sql = "SELECT * FROM user WHERE email = :email";

        // Prepare the statement
        $stmt = $pdo->prepare($sql);

        // Bind the email parameter to prevent SQL injection
        $stmt->bindParam(':email', $_POST["email"]);

        // Execute the statement
        $stmt->execute();

        // Fetch the user record
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($user) {
            // Verify the password
            if (password_verify($_POST["password"], $user["password_hash"])) {
                session_start();

                // Regenerate session ID for security
                session_regenerate_id();

                // Store user ID in the session
                $_SESSION["user_id"] = $user["id"];

                // Redirect to the homepage
                header("Location: profile.html");
                exit;
            }
        }

        // If no user is found or the password is incorrect
        $is_invalid = true;
    } catch (PDOException $e) {
        // Handle database errors
        die("Database error: " . $e->getMessage());
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style.css">
</head>
<body>

    <h1>Login</h1>

    <?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>

    <form method="post">
        <label for="email">Email</label>
        <input type="email" name="email" id="email"
               value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">

        <label for="password">Password</label>
        <input type="password" name="password" id="password">

        <button>Log in</button>
    </form>
    <a href="forgot_password.php">Forgot password ?</a>

</body>
</html>
