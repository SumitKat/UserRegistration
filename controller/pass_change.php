<?php
session_start();
require_once("../config/config.php");
require_once('../api/dbquery.php');
$conn = new mysqli(SERVER_NAME, USER_NAME, PASSWORD, DATABASE_NAME);

// Check connection
if ($conn->connect_error) {
    die( "Connection failed: " . $conn->connect_error );
}

$pass = $_POST['pass_change1'];
$repass = $_POST['pass_change2'];

if ($pass === $repass) {
    $sql = new DbQuery();
    $update = [];
    $pass =hash('sha256', $pass);
    $update['password'] = $pass;
    $update['token'] = null;
    $sql->update('user', $update, 'email', $_SESSION['email']);
    var_dump($sql);
    header("Location: ../model/dashboard.php");
} else {
    echo "Something went wrong, Please try again!!";
}
