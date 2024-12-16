<?php

require __DIR__ . "/vendor/autoload.php";

$client = new Google\Client;

$client->setClientId("312004188757-2d47i8bsta5u0fa881ftq9n1a9nenpe3.apps.googleusercontent.com");
$client->setClientSecret("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");
$client->setRedirectUri("https://localhost/tun2/views/redirect.php");

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