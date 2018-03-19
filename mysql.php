<?php
ini_set('display_errors', '1');
session_start();
$servername = "localhost";
$username = "root";
$password = "mindfire";
$databaseName="myDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $databaseName);

// Check connection
if ($conn->connect_error) {
    die( "Connection failed: " . $conn->connect_error );
}

$last_id=0;
$flag=false;
$sqlUsers = $conn->prepare("INSERT INTO users ( email, password, phone, first_name, middle_name, last_name, dob, gender ) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
$sqlUsers->bind_param("ssbsssss", $_SESSION[ 'form_data' ][ 'email' ], crypt($_SESSION[ 'form_data' ]['password'], 'salt'), $_SESSION[ 'form_data' ][ 'phone' ], $_SESSION[ 'form_data' ][ 'firstName' ], $_SESSION[ 'form_data' ][ 'middleName' ], $_SESSION[ 'form_data' ][ 'lastName' ], $_SESSION[ 'form_data' ][ 'dob' ], $_SESSION[ 'form_data' ][ 'gender' ]);

if ($sqlUsers->execute()) {
    $last_id = $conn->insert_id;
    $flag = true;
}

if ($last_id==0) {
    $_SESSION['popup'] = "Email Id already registered";
    header("Location: index.php");
} else {
    $sqlCurrentAddress = $conn->prepare("INSERT INTO address ( user_id, street, state, city,country, type ) VALUES (?, ?, ?, ?, ?, ?)");

    $current = "current";
   
    $sqlCurrentAddress->bind_param("isssss", $last_id, $_SESSION[ 'form_data' ][ 'cStreet' ], $_SESSION[ 'form_data' ][ 'cCity' ], $_SESSION[ 'form_data' ][ 'cState' ], $_SESSION[ 'form_data' ][ 'cCountry' ], $current);
    if ($sqlCurrentAddress->execute()) {
        $flag = true;
    }

    $sqlPermanentAddress = $conn->prepare("INSERT INTO address ( user_id, street, state, city, country, type )VALUES (?, ?, ?, ?, ?, ?)");
    $sqlPermanentAddress->bind_param("isssss", $last_id, $_SESSION[ 'form_data' ][ 'pStreet' ], $_SESSION[ 'form_data' ][ 'pCity' ], $_SESSION[ 'form_data' ][ 'pState' ], $_SESSION[ 'form_data' ][ 'pCountry' ], "permanent");

    if ($sqlPermanentAddress->execute()) {
        $flag = true;
    }

    $interestLength = count($_SESSION[ 'form_data' ][ 'interests' ]);
    $i = 0;
    $interest = "";

    while ($i < $interestLength-1) {
        $interest .= $_SESSION[ 'form_data' ][ 'interests' ][$i].',' ;
        $i++;
    }
    $interest .= $_SESSION[ 'form_data' ][ 'interests' ][$interestLength-1];
     
    $sqlInterest = $conn->prepare("INSERT INTO interest ( user_id, name ) VALUES ( '$last_id', '$interest' )");



    if ($sqlInterest->execute()) {
         $flag = true;
    }
    if ($flag == false) {
        $_SESSION['popup'] .= "Data not inserted";
        header("Location: index.php");
    } else {
        $_SESSION['login']['id'] = $last_id;
        header("Location: dashboard.php");
    }
    

}

$conn->close();
