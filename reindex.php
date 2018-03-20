<?php
session_start();
require_once('reindex_view.php');
require_once('config.php');
$passErr;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $conn = new mysqli($servername, $username, $password, $databaseName);
    if ($conn->connect_error) {
        die( "Connection failed: " . $conn->connect_error );
    }
    $email =$_POST['loginEmail'];
    $sql = "SELECT * from users where email = '$email'";
    $result = $conn->query($sql);
    if ($result->num_rows == 0) {
        // header("Location : login.php");
    } else {
        $_SESSION['emailErr'] = "Email Id already registered";
    }
}
