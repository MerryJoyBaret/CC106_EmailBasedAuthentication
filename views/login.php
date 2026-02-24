<?php
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
</form>
<p>Don't have an account? <a href="/php-email-auth/index.php?action=register">Register here</a>.</p>
<?php include 'templates/footer.php'; ?>
