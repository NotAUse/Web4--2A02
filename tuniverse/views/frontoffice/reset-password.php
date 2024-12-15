<?php

$token = $_GET["token"];
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

?>
<!DOCTYPE html>
<html>
<head>
    <title>Reset Password</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>

    <h1>Reset Password</h1>

    <form method="post" action="process-reset-password.php">

        <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

        <label for="password">New password</label>
        <input type="password" id="password" name="password" required>

        <label for="password_confirmation">Repeat password</label>
        <input type="password" id="password_confirmation" name="password_confirmation" required>

        <button>Send</button>
    </form>

</body>
</html>
