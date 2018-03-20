<?php
session_start();
require_once('jquery_index_view.php');
require_once('config.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli($servername, $username, $password, $databaseName);
    if ($conn->connect_error) {
        die( "Connection failed: " . $conn->connect_error );
    }
    $email =$_POST['email'];
    $sql = "SELECT * from users where email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        // header("Location : login.php");
    } else {
        echo "Email Id already registered";
    }
}
