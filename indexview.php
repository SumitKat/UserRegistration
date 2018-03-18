<?php
// Start the session
session_start();

$_SESSION['form_data']['email'] = isset($_POST['email']) ? $_POST['email'] : '';

$_SESSION['form_data']['password'] = isset($_POST['password']) ? $_POST['password'] : '';

$_SESSION['form_data']['firstName'] = isset($_POST['firstName']) ? $_POST['firstName'] : '';

$_SESSION['form_data']['lastName'] = isset($_POST['lastName']) ? $_POST['lastName'] : '';

$_SESSION['form_data']['dob'] = isset($_POST['dob']) ? $_POST['dob'] : '';

$_SESSION['form_data']['phone'] = isset($_POST['phone']) ? $_POST['phone'] : '';

$_SESSION['form_data']['middleName'] = isset($_POST['middleName']) ? $_POST['middleName'] : '';

$_SESSION['form_data']['gender'] = isset($_POST['gender']) ? $_POST['gender'] : '';

$_SESSION['form_data']['interests'] = isset($_POST['interests']) ? $_POST['interests'] : '';

$_SESSION['form_data']['cStreet'] = isset($_POST['cStreet']) ? $_POST['cStreet'] : '';

$_SESSION['form_data']['cState'] = isset($_POST['cState']) ? $_POST['cState'] : '';

$_SESSION['form_data']['cCity'] = isset($_POST['cCity']) ? $_POST['cCity'] : '';

$_SESSION['form_data']['cCountry'] = isset($_POST['cCountry']) ? $_POST['cCountry'] : '';

$_SESSION['form_data']['pStreet'] = isset($_POST['pStreet']) ? $_POST['pStreet'] : '';

$_SESSION['form_data']['pState'] = isset($_POST['pState']) ? $_POST['pState'] : '';

$_SESSION['form_data']['pCity'] = isset($_POST['pCity']) ? $_POST['pCity'] : '';

$_SESSION['form_data']['pCountry'] = isset($_POST['pCountry']) ? $_POST['pCountry'] : '';

$cnt=count($_SESSION['form_data']['interests']);
$i = 0;
while ($i<$cnt) {
    echo $_SESSION['form_data']['interests'][$i];
    $i++;
}

$passErr = $emailErr = $repassErr=$phoneErr=$firstNameErr=$lastNameErr=$dobErr=
$genderErr=$currentStreetErr=$permanentStreetErr=$currentCityErr=
$permanentCityErr=$currentCountryErr=$permanentCountryErr=
$currentStateErr=$permanentStateErr="";

$pass = $email =$repass=$phone=$firstName=$lastName=$dob=$gender=$currentStreet=
$permanentStreet=$currentCity=$permanentCity=$currentCountry=$permanentCountry=
$currentState=$permanentState="";

$flag=false;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
    } else {
        $email = testInput($_POST["email"]);
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
              $emailErr = "Invalid email format";
              $flag = true;
        }
    }
    if (empty($_POST["password"])) {
        $passErr = "Password is required";
    } else {
        $pass = testInput($_POST["password"]);
        if (strlen($pass)<6 || (!preg_match("/[a-z]/", $pass))||(!preg_match("/[A-Z]/", $pass))||(!preg_match("/[0-9]/", $pass))) {
              $passErr = "Password must contain minimum of 6 characters , a lower case letter, a upper case letter and an integer";
              $flag = true;
        }
    }

    if ((!empty($_POST["password"]))&&(empty($_POST["rePassword"]))) {
        $repassErr = "Please ReEnter Password";
    } else {
        $repass= testInput($_POST["rePassword"]);
        // check if e-mail address is well-formed
        if ($pass!=$repass) {
            $repassErr = "Password doesn't match";
            $flag = true;
        }
    }
    if (empty($_POST["phone"])) {
        $phoneErr = "Phone is required" ;
    } else {
        $phone=testInput($_POST["phone"]);
        if (preg_match("/([+]\d{2})?(\d{3}){2}\d{4}/g", $phone)) {
            $phoneErr = "Phone can have only numbers and should contain 10 integers";
            $flag = true;
        }
    }

    if (empty($_POST["firstName"])) {
          $firstNameErr = "First name is required";
    } else {
        $firstName=testInput($_POST["firstName"]);
        if (!preg_match("/^[a-zA-Z ]*$/", $firstName)) {
            $firstNameErr = "Name can contain only letters and white spaces";
            $flag = true;
        }
    }

    if (empty(($_POST["lastName"]))) {
        $lastNameErr = "Last name is required";
    } else {
        $lastName = testInput($_POST["lastName"]);
        if (!preg_match("/^[a-zA-Z]*$/", $lastName)) {
            $lastNameErr = "Name can contain only letters and white spaces";
            $flag = true;
        }
    }

    if (empty($_POST["dob"]) || !isset($_POST["dob"])) {
        $dobErr = "DOB is required";
    } else {
        $dob = testInput($_POST["dob"]);
        if ($dob<1900-01-01) {
            $dobErr="Illegal DOB";
            $flag = true;
        }
    
    }

    if (empty($_POST["gender"])) {
        $genderErr = "* Gender is required";
        $flag = true;
    } else {
        $gender = testInput($_POST["gender"]);
    }

    if (empty($_POST["cStreet"])) {
        $currentStreetErr = "Current Street is required";
        $flag = true;
    } else {
        $currentStreet = testInput($_POST["cStreet"]);
    }
  
    if (empty($_POST["cState"])) {
        $currentStateErr = "Current State is required";
        $flag = true;
    } else {
          $currentState = testInput($_POST["cState"]);
    }
  
    if (empty($_POST["cCountry"])) {
        $currentCountryErr = "Current Country is required";
        $flag = true;
    } else {
        $currentCountry=testInput($_POST["cCountry"]);
    }
    if (empty($_POST["cCity"])) {
        $currentCityErr="Current City is required";
        $flag = true;
    } else {
        $currentCity = testInput($_POST["cCity"]);
    }

    if (empty($_POST["pStreet"])) {
         $permanentStreetErr = "Permanent Street is required";
         $flag = true;
    } else {
        $permanentStreet=testInput($_POST["pStreet"]);
    }

    if (empty($_POST["pState"])) {
        $permanentStateErr="Permanent State is required";
        $flag = true;
    } else {
        $permanentState=testInput($_POST["pState"]);
    }
    if (empty($_POST["pCountry"])) {
        $permanentCountryErr="Permanent Country is required";
        $flag =true;
    } else {
        $permanentCountry=testInput($_POST["pCountry"]);
    }
    if (empty($_POST["pCity"])) {
        $permanentCityErr="Permanent City is required";
        $flag = true;
    } else {
        $permanentCity=testInput($_POST["pCity"]);
    }
    if ($flag === false) {
        header("Location: mysql.php");
    }
}

function testInput($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

require('index.php');
