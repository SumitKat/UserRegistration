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
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
} 

$userInfo = new mysqli($servername,$username,$password, )


$sql="CREATE DATABASE myUser";

if($conn->query($sql))
{
	echo 'Database created successfully';
}
else
{
	echo'error creating database'.$conn->conn_error;
}


$sql="CREATE TABLE Users (
id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY, 
firstname VARCHAR(30) NOT NULL,
lastname VARCHAR(30) NOT NULL,
email VARCHAR(50),
dob DATE
)";



if($conn->query($sql)===TRUE)
{
	echo "table created successfully";
}
else
{
	echo ("Error in creating table" .$conn->conn_error);
}

 
 $email=$_SESSION['form_data']['email'];
 $str=$_SESSION['form_data']['password'];
 $password=crypt($str,'salt');

 $firstName=$_SESSION[form_data][firstName];
 $lastName=$_SESSION[form_data][lastName];

 $sqlLogin = "INSERT INTO Login (email,password) 
       VALUES('$email','$password')";

 if ($conn->query($sqlLogin) === TRUE) {
 	echo "Data inserted";
 }
 else {
 	echo "Error in inserting data".$conn->conn_error;
 }

 

$conn->close();
?>