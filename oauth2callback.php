<?php
session_start();
require 'vendor/autoload.php';

$client = new Google_Client();
$client->setClientId('473555843877-qtf9n6pdui46d2v86gtamoiub22rt2lb.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/php-email-auth/oauth2callback.php');
$client->addScope("email");
$client->addScope("profile");

if (isset($_GET['code'])) {
    $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
    if (!isset($token['error'])) {
        $client->setAccessToken($token['access_token']);
        $google_oauth = new Google_Service_Oauth2($client);
        $google_account_info = $google_oauth->userinfo->get();
        $_SESSION['user'] = $google_account_info->email;
        $_SESSION['email'] = $google_account_info->email;
        $_SESSION['name'] = $google_account_info->name;
        header('Location: index.php?action=home&loggedin=1');
        exit();
    } else {
        echo "Error logging in with Google.";
    }
} else {
    header('Location: index.php');
    exit();
}
?>
