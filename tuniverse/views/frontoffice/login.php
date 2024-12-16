<?php

$is_invalid = false;

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    try {
        
        // Include the database connection
        $pdo = require_once(__DIR__ . '/../../config/database.php');

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
    <script src="https://www.google.com/recaptcha/api.js" async defer></script>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

   



    <form method="post">
    <h1>Login</h1>
        <label for="email">Email</label>
        <input  name="email" id="email"
               value="<?= htmlspecialchars($_POST["email"] ?? "") ?>">

        <label for="password">Password</label>
        <input type="password" name="password" id="password">
        <div class="g-recaptcha" data-sitekey="6Ld9rJQqAAAAACEyb2gVAnfrctnWsIUoJSnmEfUW"></div>
        

        <button>Log in</button>
        
        <?php if ($is_invalid): ?>
        <em>Invalid login</em>
    <?php endif; ?>
        <a href="forgot_password.php">Forgot password ?</a>
        <a href="../backoffice/login_admin.php">login as admin ?</a>
    </form>


    <a href="index.php"> back to homepage</a>
        <form>
        

    

</body>
</html>
<?php

require __DIR__ . "/vendor/autoload.php";

$client = new Google\Client;

$client->setClientId("312004188757-2d47i8bsta5u0fa881ftq9n1a9nenpe3.apps.googleusercontent.com");
$client->setClientSecret("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");
$client->setRedirectUri("https://localhost/tun2/views/backoffice/redirect.php");

$client->addScope("email");
$client->addScope("profile");

$url = $client->createAuthUrl();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Google Login Example</title>
</head>
<body>

    <a href="<?= $url ?>">Sign in with Google</a>

</body>
</html>


