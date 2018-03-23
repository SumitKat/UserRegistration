<?php
session_start();
ini_set('display_errors', '1');

if (empty($_SESSION['login'])) {
    header("Location: login.php");
}

require_once('databaseCredentials.php');

// Create connection

$conn = new mysqli($servername, $username, $password, $databaseName);

// Check connection
if ($conn->connect_error) {
    die( "Connection failed: " . $conn->connect_error );
}

$id =$_SESSION['login']['id'];
$userInfo = "SELECT  first_name, last_name, middle_name, email, phone, dob, gender FROM  users WHERE id = '$id' LIMIT 1";
$result = $conn->query($userInfo);
  
if ($result->num_rows == 0) {
    header("Location: login.php");
} else {
    $row = $result->fetch_assoc();
    $firstName = $row['first_name'];
    $lastName = $row['last_name'];
    $email = $row['email'];
    $middleName = $row['middle_name'];
    $phone = $row['phone'];
    $dob = $row['dob'];
    $gender = $row['gender'];
}

$userInterests = "SELECT name FROM interest WHERE user_id ='$id' LIMIT 1";
$resultInterest = $conn->query($userInterests);
$rowInterest = $resultInterest->fetch_assoc();
$interest = $rowInterest['name'];


$userPermanentAddress = "SELECT  street, city, country, state FROM address 
                         WHERE user_id = '$id' AND type = 'permanent'";
$resultPermanentAddress = $conn->query($userPermanentAddress);
$rowPermanentAddress = $resultPermanentAddress->fetch_assoc();
$pCity = $rowPermanentAddress['city'];
$pStreet = $rowPermanentAddress['street'];
$pState = $rowPermanentAddress['state'];
$pCountry = $rowPermanentAddress['country'];



$userCurrentAddress = "SELECT  street, city, country, state FROM address 
                         WHERE user_id = '$id' AND type = 'current'";
$resultCurrentAddress = $conn->query($userCurrentAddress);
$rowCurrentAddress = $resultCurrentAddress->fetch_assoc();
$cCity = $rowCurrentAddress['city'];
$cStreet = $rowCurrentAddress['street'];
$cState = $rowCurrentAddress['state'];
$cCountry = $rowCurrentAddress['country'];

require('dashboardview.php');
