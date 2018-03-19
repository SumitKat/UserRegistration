<? php
$servername = "localhost";
$username = "root";
$password = "mindfire";
$databaseName="myDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $databaseName);

if ($conn->connect_error) {
    die( "Connection failed: " . $conn->connect_error );
}