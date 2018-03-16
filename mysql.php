<?php
session_start();
echo "<pre>";
print_r($_SESSION);
echo "</pre>";
$servername = "localhost";
$username = "root";
$password = "mindfire";
$databaseName="myDB";

// Create connection
$conn = new mysqli($servername, $username, $password,$databaseName);

// Check connection
if ( $conn->connect_error ) {
    die( "Connection failed: " . $conn->connect_error );
} 

// $userInfo = new mysqli($servername,$username,$password, )


// $sql="CREATE DATABASE myUser";

// if($conn->query($sql))
// {
// 	echo 'Database created successfully';
// }
// else
// {
// 	echo'error creating database'.$conn->conn_error;
// }


// $sql="CREATE TABLE Users (
// id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
// firstname VARCHAR(30) NOT NULL,
// lastname VARCHAR(30) NOT NULL,
// email VARCHAR(50),
// dob DATE
// )";



// if($conn->query($sql)===TRUE)
// {
// 	echo "table created successfully";
// }
// else
// {
// 	echo ("Error in creating table" .$conn->conn_error);
// }

 
 $email = $_SESSION[ 'form_data' ][ 'email' ];
 $str = $_SESSION[ 'form_data' ]['password'];
 $password = crypt( $str , 'salt' );
 

 $firstName = $_SESSION[ 'form_data' ][ 'firstName' ];
 $middleName = $_SESSION[ 'form_data' ][ 'middleName' ];
 $lastName = $_SESSION[ 'form_data' ][ 'lastName' ];
 

 $phone = $_SESSION[ 'form_data' ][ 'phone' ];
 $dob = $_SESSION[ 'form_data' ][ 'dob' ];
 $gender = $_SESSION[ 'form_data' ][ 'gender' ];

echo "$phone";
 // echo $email.$password.$firstName.$middleName.$lastName.$phone.$dob.$gender;



 $sqlUsers = "INSERT INTO users ( email, password, phone, first_name, middle_name,
 			  last_name, dob, gender ) 
       		  VALUES ( '$email', '$password', '$phone', '$firstName', '$middleName',
       		  '$lastName', '$dob', '$gender' )";



 if ( $conn->query( $sqlUsers ) === TRUE ) {
 	$last_id = $conn->insert_id;
 	echo "Data inserted";
 }
 else {
 	echo "Error in inserting user data".$conn->conn_error;
 }

 if ( $last_id==0 ) {
 	 echo "Email Id already registered";
 }
 else {
	 $currentStreet = $_SESSION[ 'form_data' ][ 'cStreet' ];
	 $curentCity = $_SESSION[ 'form_data' ][ 'cCity' ];
	 $currentState = $_SESSION[ 'form_data' ][ 'cState' ];
	 $currentCountry = $_SESSION[ 'form_data' ][ 'cCountry' ];



	 $sqlCurrentAddress = "INSERT INTO address ( user_id, street, state, city, country, type )
	 				       VALUES ( '$last_id', '$currentStreet', '$currentState', '$curentCity',
	 				       '$currentCountry', 'current' )";




	 if ( $conn->query( $sqlCurrentAddress ) === TRUE ) {
	 	echo "Current Address Data Inserted";
	 }
	 else {
	 	echo "Error in inserting current address details";
	 }




	 $permanentStreet = $_SESSION[ 'form_data' ][ 'pStreet' ];
	 $permanentCity = $_SESSION[ 'form_data' ][ 'pCity' ];

	 $permanentState = $_SESSION[ 'form_data' ][ 'pState' ];
	 $permanentCountry = $_SESSION[ 'form_data' ][ 'pCountry' ];

	 $sqlPermanentAddress = "INSERT INTO address ( user_id, street, state, city, country, type )
	 				      VALUES ( '$last_id', '$permanentStreet', '$permanentState', '$permanentCity', 
	 				      '$permanentCountry', 'permanent' )";





	 if ( $conn->query( $sqlPermanentAddress) === TRUE ) {
	 	echo "Permanent address data inserted";
	 } 
	 else {
	 	echo "Error in inserting permanent address details";
	 }




	 $interestLength = count( $_SESSION[ 'form_data' ][ 'interests' ] );
	 $i = 0;
	 $interest = "";




	 while( $i < $interestLength-1 ) {
	    $interest .= $_SESSION[ 'form_data' ][ 'interests' ][$i].',' ;
	    $i++;
	 }



	 $interest .= $_SESSION[ 'form_data' ][ 'interests' ][$interestLength-1];
	 
	 $sqlInterest = "INSERT INTO interest ( user_id, name )
	 				 VALUES ( '$last_id', '$interest' )";



	 if ( $conn->query( $sqlInterest) === TRUE ) {
	 	echo "Interest recorded";
	 }
	 else
	 	echo "Error in recording interests";
	 
 }



 $conn->close();
?>