<?php
require_once __DIR__ . '/../models/User.php';
class AuthController {
 private $userModel;
 public function __construct($conn) {
 $this->userModel = new User($conn);
 }
 public function register($email, $password) {
 return $this->userModel->register($email, $password);
 }
 public function verify($code) {
 $result = $this->userModel->verify($code);
 if (is_array($result)) {
  // Account verified, but don't log in yet
  header("Location: index.php?action=login&verified=1");
  exit();
 }
 return $result; // error message
 }
 public function login($email, $password) {
 $result = $this->userModel->login($email, $password);
 if (is_array($result)) {
 $_SESSION['user'] = $result['email'];
 $_SESSION['name'] = isset($result['name']) ? $result['name'] : $result['email'];
 header("Location: index.php?action=home&loggedin=1");
 exit();
 }
 return $result;
 }
 public function logout() {
 session_destroy();
 header("Location: index.php?action=login");
 exit();
 }
}
?>