<?php
session_start();

// Prevent caching of redirects and dynamic content
header('Cache-Control: no-cache, no-store, must-revalidate, max-age=0');
header('Pragma: no-cache');
header('Expires: 0');

require_once 'config/db.php';
require_once 'controllers/AuthController.php';
$auth = new AuthController($conn);
$action = $_GET['action'] ?? 'login';
switch ($action) {
 case 'register':
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 $message = $auth->register($_POST['email'], $_POST['password']);
 }
 include 'views/register.php';
 break;
 case 'verify':
 if (isset($_GET['code'])) {
  $code = $_GET['code'];
  $auth->verify($code); // redirects on success
  $message = "Verification failed.";
 }
 include 'views/verify.php';
 break;
 case 'login':
 if (isset($_GET['verified'])) {
 $message = "Account verified. Please log in with your credentials.";
 }
 if ($_SERVER['REQUEST_METHOD'] === 'POST') {
 $message = $auth->login($_POST['email'], $_POST['password']);
 }
 include 'views/login.php';
 break;
 case 'home':
 if (!isset($_SESSION['user'])) {
 header("Location: index.php?action=login");
 }
 if (isset($_GET['loggedin'])) {
 $message = "You are successfully logged in.";
 }
 include 'views/home.php';
 break;
 case 'logout':
 $auth->logout();
 break;
}
?>