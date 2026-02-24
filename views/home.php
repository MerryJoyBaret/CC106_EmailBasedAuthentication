<?php
$title = 'Home';
include 'templates/header.php';
?>
<h1>Welcome to PHP Email Authentication</h1>
<?php if (isset($message)) echo "<p>$message</p>"; ?>
<p>This is a simple PHP application demonstrating email-based user authentication.</p>
<p><a href="/php-email-auth/index.php?action=logout">Logout</a></p>
<?php include 'templates/footer.php'; ?>
