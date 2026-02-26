<?php
// Check if user is logged in
if (!isset($_SESSION['user'])) {
    header("Location: ../index.php?action=login");
    exit();
}
$title = 'Home';
include 'templates/header.php';
?>
<h1>PHP Email Authentication</h1>
<?php if (isset($message)) echo "<p>$message</p>"; ?>
<h2>Welcome, <?php echo isset($_SESSION['name']) ? $_SESSION['name'] : $_SESSION['user']; ?>!</h2>
<p>Email: <?php echo $_SESSION['user']; ?></p>
<p>This is a simple PHP application demonstrating email-based user authentication.</p>
<p><a href="/php-email-auth/index.php?action=logout">Logout</a></p>
<?php include 'templates/footer.php'; ?>