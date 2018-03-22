<?php
ini_set('display_errors', '1');
session_start();

//file with constants for DB connection
require_once('../config/config.php');

// Create connection
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli(SERVER_NAME, USER_NAME, PASSWORD, DATABASE_NAME);
}

// Check connection
if ($conn->connect_error) {
    die( "Connection failed: " . $conn->connect_error );
}
$last_id=0;

// prepare statement for insertion to user table
$sqlUsers = $conn->prepare("INSERT INTO user ( email, password, phone, name, dob, gender ) VALUES (?, ?, ?, ?, ?, ?)");

//bind parameters and there type
$sqlUsers->bind_param("ssisss", $_POST['loginEmail'], hash('sha256', $_POST['loginPassword']), $_POST['phone'], $_POST['name'], $_POST['dob'], $_POST['gender']);

//execution of the query
if ($sqlUsers->execute()) {
    $last_id = $conn->insert_id;

    //prepare statement for insertion to address table
    $sqlAddress = $conn->prepare("INSERT INTO address ( user_id, street, state, city,country ) VALUES (?, ?, ?, ?, ?)");

    //bind paramenters and there type
    $sqlAddress->bind_param("issss", $last_id, $_POST['street'], $_POST['state'], $_POST['city'], $_POST['country']);

    //execution of the query
    if ($sqlAddress->execute()) {
        echo "within adddress";
        $interestLength = count($_POST[ 'interests' ]);
        $i = 0;
        $interest = "";

        while ($i < $interestLength-1) {
            $interest .= $_POST[ 'interests' ][$i].',' ;
            $i++;
        }
        $interest .= $_POST[ 'interests' ][$interestLength-1];
         
        $sqlInterest = $conn->prepare("INSERT INTO interest ( user_id, interest ) VALUES ( ?, ? )");
        $sqlInterest->bind_param("is", $last_id, $interest);
        if ($sqlInterest->execute()) {
            echo "within interest";
            header("Location:../view/dashboard.php");
        }
    }
}

$conn->close();
