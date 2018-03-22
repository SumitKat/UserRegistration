<?php
session_start();
ini_set('display_errors', '1');

if (empty($_SESSION['login'])) {
    header("Location: login.php");
}

require_once('../config/config.php');

// Create connection

$conn = new mysqli(SERVER_NAME, USER_NAME, PASSWORD, DATABASE_NAME);

// Check connection
if ($conn->connect_error) {
    die( "Connection failed: " . $conn->connect_error );
}

$id =$_SESSION['login']['id'];
//data from  users is extracted
$userInfo = "SELECT name, email, phone, dob, gender FROM  user WHERE id = '$id' LIMIT 1";
$result = $conn->query($userInfo);
// check if query returns no result
if ($result->num_rows == 0) {
    header("Location: login.php");
} else {
    $row = $result->fetch_assoc();
    $name = $row['name'];
    $email = $row['email'];
    $phone = $row['phone'];
    $dob = $row['dob'];
    $gender = $row['gender'];
}
//data from interest table is fetched
$userInterests = "SELECT interest FROM interest WHERE user_id ='$id' LIMIT 1";
$resultInterest = $conn->query($userInterests);
$rowInterest = $resultInterest->fetch_assoc();
$interest = $rowInterest['interest'];
//data about permanent address from address table is fetched
$address = "SELECT  street, city, country, state FROM address 
                         WHERE user_id = '$id'";
$resultAddress = $conn->query($address);
$rowAddress = $resultAddress->fetch_assoc();
$city = $rowAddress['city'];
$street = $rowAddress['street'];
$state = $rowAddress['state'];
$country = $rowAddress['country'];

require('../view/dashboard.php');
