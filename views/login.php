<?php
require 'vendor/autoload.php';

// redirect if already logged in
if (isset($_SESSION['user'])) {
    header("Location: http://localhost/php-email-auth/index.php");
exit;
}

// Google client configuration
$client = new Google_Client();
$client->setClientId('473555843877-qtf9n6pdui46d2v86gtamoiub22rt2lb.apps.googleusercontent.com');
$client->setClientSecret('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');
$client->setRedirectUri('http://localhost/php-email-auth/oauth2callback.php');
$client->addScope("email");
$client->addScope("profile");

$login_url = $client->createAuthUrl();

$title = 'Login';
include 'templates/header.php';
?>
<h1>Login</h1>
<?php if (isset($message)) echo "<p>$message</p>"; ?>
<form action="/php-email-auth/index.php?action=login" method="post">
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <button type="submit">Login</button>
    <a href="<?php echo $login_url; ?>">
    <img src="https://developers.google.com/identity/images/btn_google_signin_dark_normal_web.png" alt="Sign in with Google">
</a>
</form>
<p>Don't have an account? <a href="/php-email-auth/index.php?action=register">Register here</a>.</p>


<?php include 'templates/footer.php'; ?>