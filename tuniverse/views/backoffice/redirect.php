<?php

require  "../frontoffice/vendor/autoload.php";

$client = new Google\Client;

$client->setClientId("312004188757-2d47i8bsta5u0fa881ftq9n1a9nenpe3.apps.googleusercontent.com");
$client->setClientSecret("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");
$client->setRedirectUri("https://localhost/tun2/views/backoffice/redirect.php");

if ( ! isset($_GET["code"])) {

    exit("Login failed");

}

$token = $client->fetchAccessTokenWithAuthCode($_GET["code"]);

$client->setAccessToken($token["access_token"]);

$oauth = new Google\Service\Oauth2($client);

$userinfo = $oauth->userinfo->get();

var_dump(
    $userinfo->email,
    $userinfo->familyName,
    $userinfo->givenName,
    $userinfo->name
);