<?php
session_start();
require_once('../config.php');
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli(SERVER_NAME, USER_NAME, PASSWORD, DATABASE_NAME);
    if ($conn->connect_error) {
        die( "Connection failed: " . $conn->connect_error );
    }
    $email =$_POST['email'];
    $sql = "SELECT * from users where email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        $error->email = "";
        echo json_encode($error);
    } else {
        $error->email = "Email Id already registered";
        echo json_encode($error);
    }
}
