<?php
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

$FLAG=false;
$email = $_SESSION[ 'form_data' ][ 'email' ];
$str = $_SESSION[ 'form_data' ]['password'];
$password = crypt($str, 'salt');
$firstName = $_SESSION[ 'form_data' ][ 'firstName' ];
$middleName = $_SESSION[ 'form_data' ][ 'middleName' ];
$lastName = $_SESSION[ 'form_data' ][ 'lastName' ];
$phone = $_SESSION[ 'form_data' ][ 'phone' ];
$dob = $_SESSION[ 'form_data' ][ 'dob' ];
$gender = $_SESSION[ 'form_data' ][ 'gender' ];
$sqlUsers = "INSERT INTO users ( email, password, phone, first_name, middle_name,
        last_name, dob, gender ) 
        VALUES ( '$email', '$password', '$phone', '$firstName', '$middleName',
        '$lastName', '$dob', '$gender' )";
if ($conn->query($sqlUsers) === true) {
    $last_id = $conn->insert_id;
    $FLAG = true;
}

if ($last_id==0) {
    echo "Email Id already registered";
} else {
    $currentStreet = $_SESSION[ 'form_data' ][ 'cStreet' ];
    $curentCity = $_SESSION[ 'form_data' ][ 'cCity' ];
    $currentState = $_SESSION[ 'form_data' ][ 'cState' ];
    $currentCountry = $_SESSION[ 'form_data' ][ 'cCountry' ];
    $sqlCurrentAddress = "INSERT INTO address ( user_id, street, state, city,
                          country, type ) VALUES ( '$last_id', '$currentStreet',
                         '$currentState', '$curentCity',
                         '$currentCountry', 'current' )";
    if ($conn->query($sqlCurrentAddress) === true) {
        $FLAG = true;
    }
    $permanentStreet = $_SESSION[ 'form_data' ][ 'pStreet' ];
    $permanentCity = $_SESSION[ 'form_data' ][ 'pCity' ];

    $permanentState = $_SESSION[ 'form_data' ][ 'pState' ];
    $permanentCountry = $_SESSION[ 'form_data' ][ 'pCountry' ];

    $sqlPermanentAddress = "INSERT INTO address ( user_id, street, state, city, country, type )
                          VALUES ( '$last_id', '$permanentStreet', '$permanentState', '$permanentCity', 
                         '$permanentCountry', 'permanent' )";

    if ($conn->query($sqlPermanentAddress) === true) {
        $FLAG = true;
    }
    $interestLength = count($_SESSION[ 'form_data' ][ 'interests' ]);
    $i = 0;
    $interest = "";

    while ($i < $interestLength-1) {
        $interest .= $_SESSION[ 'form_data' ][ 'interests' ][$i].',' ;
        $i++;
    }
    $interest .= $_SESSION[ 'form_data' ][ 'interests' ][$interestLength-1];
     
    $sqlInterest = "INSERT INTO interest ( user_id, name )
                     VALUES ( '$last_id', '$interest' )";



    if ($conn->query($sqlInterest) === true) {
         $FLAG = true;
    }
    if ($FLAG == false) {
        echo "Data not inserted";
    } else {
        $_SESSION['login']['id'] = $last_id;
        header("Location: dashboard.php");
    }
    

}

$conn->close();
