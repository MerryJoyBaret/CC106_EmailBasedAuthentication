<?php
require __DIR__ . '/../PHPMailer-master/PHPMailer-master/src/PHPMailer.php';
require __DIR__ . '/../PHPMailer-master/PHPMailer-master/src/Exception.php';
require __DIR__ . '/../PHPMailer-master/PHPMailer-master/src/SMTP.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
class User {
 private $conn;
 public function __construct($conn) {
 $this->conn = $conn;
 }

  /* REGISTER USER */
 public function register($email, $password) {
 $stmt = $this->conn->prepare("SELECT id FROM users WHERE email = ?");
 $stmt->bind_param("s", $email);
 $stmt->execute();
 $stmt->store_result();
 if ($stmt->num_rows > 0) {
 return "Email already registered!";
 }
 $stmt->close();
 $hashedPassword = password_hash($password, PASSWORD_BCRYPT);
 $verificationCode = bin2hex(random_bytes(16));
 $stmt = $this->conn->prepare(
 "INSERT INTO users (email, password, verification_code, is_verified)
 VALUES (?, ?, ?, 0)"
 );
 $stmt->bind_param("sss", $email, $hashedPassword, $verificationCode);
 if ($stmt->execute()) {
 $mail = new PHPMailer(true);
 try {
 $mail->isSMTP();
 $mail->Host = 'smtp.gmail.com';
 $mail->SMTPAuth = true;
 $mail->Username = 'merryjoybaret1@gmail.com';
 $mail->Password = 'jjotkdfysqtysbyh';
 $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
 $mail->Port = 587;
 $mail->setFrom('merryjoybaret1@gmail.com', 'Email Auth System');
 $mail->addAddress($email);

$verificationLink = "http://localhost/php-email-auth/index.php?action=verify&code=$verificationCode";
 $mail->isHTML(true);
 $mail->Subject = 'Verify Your Email';
 $mail->Body = "
 <h3>Email Verification</h3>
 <p>Click below to verify your account:</p>
 <a href='$verificationLink'>Verify Account</a>
 ";
 $mail->send();
 return true;
 } catch (Exception $e) {
 return "Mailer Error: {$mail->ErrorInfo}";
 }
 }
 return "Registration failed.";
 }

 /* VERIFY ACCOUNT */
 public function verify($code) {
 $stmt = $this->conn->prepare("SELECT * FROM users WHERE verification_code = ?");
 $stmt->bind_param("s", $code);
 $stmt->execute();
 $result = $stmt->get_result();
 if ($result->num_rows === 1) {
  $user = $result->fetch_assoc();
  $stmt = $this->conn->prepare("UPDATE users SET is_verified = 1, verification_code = NULL WHERE id = ?");
  $stmt->bind_param("i", $user['id']);
  if ($stmt->execute()) {
   return $user;
  } else {
   return "Update failed";
  }
 } else {
  return "Code not found";
 }
 return "No rows";
 }

 /* LOGIN USER */
 public function login($email, $password) {
 $stmt = $this->conn->prepare("SELECT * FROM users WHERE email = ?");
 $stmt->bind_param("s", $email);
 $stmt->execute();
 $result = $stmt->get_result();
 if ($result->num_rows === 1) {
 $user = $result->fetch_assoc();
 if (password_verify($password, $user['password'])) {
 if ($user['is_verified'] == 1) {
 return $user;
 } else {
 return "Please verify your email first.";
 }
 } else {
 return "Incorrect password.";
 }
 }
 return "Email not found.";
 }
}
?>