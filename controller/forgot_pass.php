<?php
session_start();
require_once("../PHPMailer/src/PHPMailer.php");
require_once("../PHPMailer/src/Exception.php");
require_once("../PHPMailer/src/SMTP.php");
require_once("../api/dbquery.php");
require_once("../config/config.php");
ini_set('display_errors', 1);
use PHPMailer\PHPMailer\PHPMailer;

$token = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890!@";
$token = str_shuffle($token);
$token = substr($token, 0, 15);

$email = $_POST['forgotEmail'];
$_SESSION['email'] = $email;
$mail = new PHPMailer(true);
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl';
$mail->Host = "smtp.gmail.com";
$mail->Port = 465; // or 587
$mail->Username = "kathayat.sumit123@gmail.com";
$mail->Password = "Hello@123";
$mail->setFrom("kathayat.sumit123@gmail.com", "MindFire Solutions", 0);
$mail->addAddress($email);
$mail->Subject = "Password Reset";
$mail->isHTML(true);
$mail->Body = "
Forgot Your Password?? Let's get you a new one:<br></br>

<a href = 'http://172.16.8.221/interactive/view/pass_change.php?email=$email&token=$token'>Click Here</a>
";
if ($mail->send()) {
    echo "Password reset mail sent. Please check your email";
} else {
    echo "Something went wrong Please try again";
}
