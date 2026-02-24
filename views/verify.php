<?php
$title = 'Verify Email';
include 'templates/header.php';
?>
<h1>Verify Your Email</h1>
<?php if (isset($message)) echo "<p>$message</p>"; ?>
<p>Please check your email and click the verification link to activate your account and log in automatically.</p>
<p>If you did not receive the email, <a href="/php-email-auth/index.php?action=register">try registering again</a>.</p>
<?php include 'templates/footer.php'; ?>
