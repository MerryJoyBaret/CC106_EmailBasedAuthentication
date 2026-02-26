<?php
$title = 'Register';
include 'templates/header.php';
?>
<h1>Register</h1>
<form action="/php-email-auth/index.php?action=register" method="post">
    <div class="form-group">
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>
    </div>
    <div class="form-group">
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>
    </div>
    <button type="submit">Register</button>
</form>
<p>Already have an account? <a href="/php-email-auth/index.php?action=login">Login here</a>.</p>
<?php include 'templates/footer.php'; ?>

