<?php
session_start();

if (empty($_SESSION['login'])) {
    header("Location: login.php");
}

$servername = "localhost";
$username = "root";
$password = "mindfire";
$databaseName="myDB";

// Create connection
$conn = new mysqli($servername, $username, $password, $databaseName);

// Check connection
if ($conn->connect_error) {
    die( "Connection failed: " . $conn->connect_error );
}

$id =$_SESSION['login']['id'];
$userInfo = "SELECT  first_name, last_name, middle_name, email, phone, dob, gender FROM  users WHERE id = '$id' LIMIT 1";
$result = $conn->query($userInfo);
  
if ($result->num_rows == 0) {
    header("Location: login.php");
} else {
    $row = $result->fetch_assoc();
    $firstName = $row['first_name'];
    $lastName = $row['last_name'];
    $email = $row['email'];
    $middleName = $row['middle_name'];
    $phone = $row['phone'];
    $dob = $row['dob'];
    $gender = $row['gender'];
}

$userInterests = "SELECT name FROM interest WHERE user_id ='$id' LIMIT 1";
$resultInterest = $conn->query($userInterests);
$rowInterest = $resultInterest->fetch_assoc();
$interest = $rowInterest['name'];


$userPermanentAddress = "SELECT  street, city, country, state FROM address 
                         WHERE user_id = '$id' AND type = 'permanent'";
$resultPermanentAddress = $conn->query($userPermanentAddress);
$rowPermanentAddress = $resultPermanentAddress->fetch_assoc();
$pCity = $rowPermanentAddress['city'];
$pStreet = $rowPermanentAddress['street'];
$pState = $rowPermanentAddress['state'];
$pCountry = $rowPermanentAddress['country'];



$userCurrentAddress = "SELECT  street, city, country, state FROM address 
                         WHERE user_id = '$id' AND type = 'current'";
$resultCurrentAddress = $conn->query($userCurrentAddress);
$rowCurrentAddress = $resultCurrentAddress->fetch_assoc();
$cCity = $rowCurrentAddress['city'];
$cStreet = $rowCurrentAddress['street'];
$cState = $rowCurrentAddress['state'];
$cCountry = $rowCurrentAddress['country'];


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- Theme Made By www.w3schools.com - No Copyright -->
    <title>DashBoard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body {
            /*font: 20px Montserrat, sans-serif;*/
            /*color: #f5f6f7;*/
        }
        p {font-size: 16px;}
        /*.margin {margin-bottom: 45px;}*/
        .bg-1 { 
            background-color: #1abc9c; /* Green */
            color: #ffffff;
        }
        .bg-2 { 
            background-color: #474e5d; /* Dark Blue */
            color: #ffffff;
        }
        .bg-3 { 
            background-color: #ffffff; /* White */
            color: #555555;
        }
        .bg-4 { 
            background-color: #2f2f2f; /* Black Gray */
            color: #fff;
        }
        footer {
                       color: white;
                      background-color: black;
                      padding: 1em;
                      text-align: center;
        }
    
    </style>
</head>
<body>
 <nav class = "navbar navbar-inverse">
        <div class = "container-fluid">
            <div class = "navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
                    <span class = "icon-bar"></span>
                    <span class = "icon-bar"></span>
                    <span class = "icon-bar"></span>
                </button>
                <a class = "navbar-brand" href= "#" >Mindfire Solutions</a>
            </div>
            <div class = "collapse navbar-collapse" id="myNavbar">
                <ul class = "nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href = "#">Contact Us</a></li>
                    <li><a href = "#">Our Products</a></li>
                    <li><a href = "#">About Us</a></li>
                </ul>
                <ul class = "nav navbar-nav navbar-right">
                    <li><a href="logout.php"><span class="glyphicon glyphicon-off"></span> Log Out</a></li>
                </ul>
            </div>
        </div>
    </nav>




<div class="container-fluid bg-1 text-center">
    <h3 class="margin"><?php echo $firstName." ".$middleName." ".$lastName?></h3>
    <img src="bird.jpg" class="img-responsive img-circle margin" style="display:inline" alt="Bird" width="350" height="350">
    <h3> <?php echo $phone." / ".$email ?></h3>
</div>

<div class="container-fluid bg-2 text-center">
    <h3 class="margin">What Am I?</h3>
    <p> I was born on <?php echo $dob?></p>
    <p><?php echo isset($interest)? "I have interests in ".$interest : ''?></p>
</div>

<div class="container-fluid bg-3 text-center">    
    <h3 class="margin">Where To Find Me?</h3><br>
    <div class="row">
        <div class="col-sm-6">
            <h4 class="margin">Permanent Address</h5>
            <p><?php echo $pStreet.",".$pCity.",".$pState.",".$pCountry?></p>
            <img src="bird.jpg" class="img-responsive margin" style="width:100%" alt="Image">
        </div>
        <div class="col-sm-6"> 
            <h4>Current Address</h4>
            <p><?php echo $cStreet.",".$cCity.",".$cState.",".$cCountry?></p>
            <img src="bird.jpg" class="img-responsive margin" style="width:100%" alt="Image">
      </div>
    </div>
</div>


<footer class = "text-nowrap"> Copyright &copy; MindfireSolutions.com</footer>

</body>
</html>

