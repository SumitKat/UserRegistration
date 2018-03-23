<?php
session_start();
$emailErr = $passErr = "";
$email = $pass = "";
if (!empty($_SESSION['login'])) {
    header("Location: dashboard.php");
} else {
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
    require_once('databaseCredentials.php');
    // Create connection
    $conn = new mysqli($servername, $username, $password, $databaseName);

    // Check connection
    if ($conn->connect_error) {
        die( "Connection failed: " . $conn->connect_error );
    }
    // Encrypt password
    $random = crypt($pass, 'salt');
    $sql = "SELECT id,first_name, last_name, password FROM  users WHERE email = '$email'AND password = '$random' LIMIT 1";
    $result = $conn->query($sql);
    //check if password and email doesn't match up
    if ($result->num_rows == 0) {
        $passErr = "Invalid email id or Password";
        if ($email=="") {
            var_dump('expression');
            $passErr = "";
        }
    } else {
        $row = $result->fetch_assoc();
        if ($row['password'] == crypt($pass, 'salt')) {
            $_SESSION['login']['id'] = $row['id'];
            $_SESSION['login']['firstName'] = $row['first_name'];
            $_SESSION['login']['lastName'] = $row['last_name'];
            header("Location: dashboard.php");
        }
                    
    }


}
//prevention from xss
function testInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

require ('loginview.php');
