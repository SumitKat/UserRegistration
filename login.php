<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "mindfire";
$databaseName="myDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $databaseName);

if ($conn->connect_error) {
    die( "Connection failed: " . $conn->connect_error );
}
if (!empty($_SESSION['login'])) {
    header("Location: dashboard.php");
} else {
    $emailErr = $passErr = "";
    $email = $pass = "";
    $flag = false;

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST["loginEmail"])) {
            $emailErr = "Email can't be empty";
            $flag = true;
        } else {
            $email =testInput($_POST["loginEmail"]);
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $emailErr = "Enter a valid Email";
                $flag = true;
            }
        }

        if (empty($_POST["loginPassword"])) {
            $passErr="Password can't be empty";
            $flag = true;
        } else {
            $pass = testInput($_POST["loginPassword"]);
            if (strlen($pass)<6 || (!preg_match("/[a-z]/", $pass))||(!preg_match("/[A-Z]/", $pass))||(!preg_match("/[0-9]/", $pass))) {
                    $passErr = "Enter a Valid Password";
                    $flag = true;
            }
        }
    }

    if ($flag == false) {
        $sql = $conn->prepare("SELECT id,first_name, last_name, password FROM  users WHERE email = '$email' LIMIT 1");
        if (!$sql->execute()) {
            $passErr = "Invalid email id or Password";
        } else {
            $sql->bind_result($id, $firstName, $lastName, $password);
            $sql->fetch();
            if ($password == crypt(hash('sha256', $pass), 'salt')) {
                $_SESSION['login']['id'] = $id;
                $_SESSION['login']['firstName'] = $firstName;
                $_SESSION['login']['lastName'] = $lastName;
                header("Location: dashboard.php");
            }
                        
        }

    }
}

function testInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
require_once ('views/loginview.php');
