<?php
session_start();
require_once('../config/config.php');
require_once('../api/dbquery.php');
if ((!isset($_GET['email']))||(!isset($_GET['token']))) {
    header("Location: ../index.php");
    exit();
} else {
    $email = $_GET['email'];
    $token = $_GET['token'];
    $conn = new mysqli(SERVER_NAME, USER_NAME, PASSWORD, DATABASE_NAME);

    $sql =new DbQuery();
    $array[0] = 'id';
    $array[1] = 'token';
    $array[2] = 'valid';
    
    $row = $sql->select('user', $array, 'email', $email);
    
    $dbToken = $row['token'];
    $dbValid = $row['valid'];
    $id = $row['id'];

    if ($dbToken != $token || $dbValid != 'F') {
        echo "User not verified!! Please register again";
    } else {
        $update = new DbQuery();
        $up = [];
        $up['token'] = "NULL";
        $up['valid'] = "T";
        $update->update('user', $up, 'id', $id);
        $_SESSION['login']['id'] = $id;
        header("Location: ../model/dashboard.php");
    }
}
