<?php
// ini_set('display_errors', 1);
session_start();
$last_id=0;

//including all the required files
require_once("../config/config.php");
require_once('../api/dbquery.php');
require_once("../PHPMailer/src/PHPMailer.php");
require_once("../PHPMailer/src/Exception.php");
require_once("../PHPMailer/src/SMTP.php");
use PHPMailer\PHPMailer\PHPMailer;

$conn = new mysqli(SERVER_NAME, USER_NAME, PASSWORD, DATABASE_NAME);

// Check connection
if ($conn->connect_error) {
    die( "Connection failed: " . $conn->connect_error );
}

//Generating a random token
$token = "qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM1234567890!@";
$token = str_shuffle($token);
$token = substr($token, 0, 15);

$usr = new DbQuery();
$array=[];
$array['email'] = $_POST['loginEmail'];
$array['password'] = hash('sha256', $_POST['loginPassword']);
$array['phone'] = $_POST['phone'];
$array['name'] = $_POST['name'];
$array['dob'] = $_POST['dob'];
$array['gender'] = $_POST['gender'];
$array['token'] = $token;
$usr->insert('user', $array);
$last_id = $usr->exec();

$add=new DbQuery();
 
$address = [];
$address['user_id'] = $last_id;
$address['street'] = $_POST['street'];
$address['state'] = $_POST['state'];
$address['city'] = $_POST['city'];
$address['country'] = $_POST['country'];

//call to insert function of DbQuery Class
$add -> insert('address', $address);
$add -> exec();

$interestLength = count($_POST[ 'interests' ]);
$i = 0;
$interest = "";

while ($i < $interestLength-1) {
    $interest .= $_POST[ 'interests' ][$i].',' ;
    $i++;
}
$interest .= $_POST[ 'interests' ][$interestLength-1];
$email = $_POST['loginEmail'];
$int = new DbQuery();
$intrst = [];
$intrst['user_id'] = $last_id;
$intrst['interest'] = $interest;

//call to insert function of DbQuery Class
$int -> insert('interest', $intrst);
$int -> exec();

//Setting up mail, it's propeties and it's methods
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
$mail->Subject = "Please verify your email address";
$mail->isHTML(true);
$mail->Body = "
Please Click on the link below<br></br>

<a href = 'http://172.16.8.221/interactive/controller/email_verify.php?email=$email&token=$token'>Click Here</a>
";

//sending mail after the user registers
if ($mail->send()) {
    echo "You have been registered please check your email";
} else {
    echo "Something went wrong Please try again";
}
$conn->close();
