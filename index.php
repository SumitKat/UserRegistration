<?php
// Start the session
session_start();

// echo '<pre>';
// print_r($_SESSION);

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


// unset($_SESSION['form_data']);
$cnt=count($_SESSION['form_data']['interests']);
$i = 0;
while ($i<$cnt) {
  echo $_SESSION['form_data']['interests'][$i];
  $i++;
}

echo '</pre>';
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Create Account</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <style>
            .error {
                color: red;
            }
            
            .resize {
                width: 180px;
            }
            
            p {
                font-family: "Times New Roman";
            }
            
            /*nav {
                float: left;
                max-height: 280px;
            }*/
            
            footer,
            header {
                color: white;
                background-color: black;
                padding: 1em;
                text-align: center;
            }
            
            form {
                padding: 1em;
                overflow: hidden;
            }
            
            body {
                background-size: cover;
            }
        </style>
    </head>

    <body background="background.jpg">

        <?php
// define variables and set to empty values
$passErr = $emailErr = $repassErr=$phoneErr=$firstNameErr=$lastNameErr=$dobErr=
$genderErr=$currentStreetErr=$permanentStreetErr=$currentCityErr=
$permanentCityErr=$currentCountryErr=$permanentCountryErr=
$currentStateErr=$permanentStateErr="";

$pass = $email =$repass=$phone=$firstName=$lastName=$dob=$gender=$currentStreet=
$permanentStreet=$currentCity=$permanentCity=$currentCountry=$permanentCountry=
$currentState=$permanentState="";

$flag=FALSE;

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } 
  else {
    $email = test_input($_POST["email"]);     

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
      $flag = TRUE;
    }
  }

  if (empty($_POST["password"])) {
    $passErr = "Password is required";
  }
  else {
    $pass = test_input($_POST["password"]);
    if (strlen($pass)<6 || (!preg_match("/[a-z]/",$pass))||(!preg_match("/[A-Z]/", $pass))||(!preg_match("/[0-9]/", $pass))){
      $passErr = "Password must contain minimum of 6 characters , a lower case letter, a upper case letter and an integer"; 
      $flag = TRUE;
      }
  }

  if ((!empty($_POST["password"]))&&(empty($_POST["rePassword"]))) {
    $repassErr = "Please ReEnter Password";
  } 
  else {
    $repass= test_input($_POST["rePassword"]);
    // check if e-mail address is well-formed
    if ($pass!=$repass) {
      $repassErr = "Password doesn't match"; 
      $flag = TRUE;
    }
  }

  if (empty($_POST["phone"])) {
    $phoneErr = "Phone is required" ;
  }
  else {
    $phone=test_input($_POST["phone"]);
    if(preg_match("/([+]\d{2})?(\d{3}){2}\d{4}/g",$phone)) {
    $phoneErr = "Phone can have only numbers and should contain 10 integers";
    $flag = TRUE;
    }
  }

  if (empty($_POST["firstName"])){
    $firstNameErr = "First name is required";
  }
  else
  {
    $firstName=test_input($_POST["firstName"]);
    if(!preg_match("/^[a-zA-Z ]*$/", $firstName)) {
      $firstNameErr = "Name can contain only letters and white spaces";
      $flag = TRUE;
    }
  }

  if (empty(($_POST["lastName"]))) {
    $lastNameErr = "Last name is required";
  }
  else {
    $lastName = test_input($_POST["lastName"]);
    if (!preg_match("/^[a-zA-Z]*$/", $lastName)){
      $lastNameErr = "Name can contain only letters and white spaces";
      $flag = TRUE;
    }
  }

  if (empty($_POST["dob"]) || !isset($_POST["dob"])) {
    $dobErr = "DOB is required";
  }
  else {
    $dob = test_input($_POST["dob"]);
    if($dob<1900-01-01) {
      $dobErr="Illegal DOB";
      $flag = TRUE;
    }
    
  }

  if (empty($_POST["gender"])) {
    $genderErr = "* Gender is required";
    $flag = TRUE;
  }
  else {
    $gender = test_input($_POST["gender"]);
  }

  if (empty($_POST["cStreet"])) {
    $currentStreetErr = "Current Street is required";
    $flag = TRUE;
  }
  else {
      $currentStreet = test_input($_POST["cStreet"]);
  }
  
  if (empty($_POST["cState"])) {
    $currentStateErr = "Current State is required";
    $flag = TRUE;
  }
  else {  $currentState = test_input($_POST["cState"]);
  }
  
  if (empty($_POST["cCountry"])) {
    $currentCountryErr = "Current Country is required";
    $flag = TRUE;
  }
  else {
    $currentCountry=test_input($_POST["cCountry"]);
  }

  if (empty($_POST["cCity"])) {
    $currentCityErr="Current City is required";
    $flag = TRUE;
  }
  else {
    $currentCity=test_input($_POST["cCity"]);
  }

  if (empty($_POST["pStreet"])) {
       $permanentStreetErr = "Permanent Street is required";
       $flag = TRUE;
  } 
  else {
      $permanentStreet=test_input($_POST["pStreet"]);
  }

  if (empty($_POST["pState"])){
    $permanentStateErr="Permanent State is required";
    $flag = TRUE;
  }
  else {
    $permanentState=test_input($_POST["pState"]);
  }

  if (empty($_POST["pCountry"])) {
    $permanentCountryErr="Permanent Country is required";
    $flag = TRUE;
  }
  else {
    $permanentCountry=test_input($_POST["pCountry"]);
  }

  if (empty($_POST["pCity"])) {
    $permanentCityErr="Permanent City is required";
    $flag = TRUE;
  }
  else {
    $permanentCity=test_input($_POST["pCity"]);
  }

  if ($flag === FALSE) {
      header("Location: mysql.php");
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

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
                    <li><a href = "login.php"><span class="glyphicon glyphicon-user"></span> Log In</a></li>
                </ul>
            </div>
        </div>
    </nav>

            <!-- <header style="height: 60px">
                <label class="text-nowrap">Create Account</label>
                <img src="logo.png" class="img-responsive" height="30px" width="30px;" align="right">
            </header> -->
           <!--  <p style="margin-left: 20px"><span class="error"> * required field.</span></p> -->
            <form class="center-block" name="myForm" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="POST">
                <div class="container-fluid bg-1">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="credentials">
                                <div class="form-group">
                                    <label for="Email">Email address:</label>
                                    <input type="text" class="form-control" name="email" id="Email" value=<?php echo $_SESSION['form_data']['email'];?>>
                                    <span class="error">* <?php echo $emailErr;?></span>
                                </div>
                                <div class = "form-group">
                                    <label for = "pwd">Password:</label>
                                    <input type = "password" class = "form-control" name = "password" id = "pwd">
                                    <span class = "error">* <?php echo $passErr;?></span>
                                </div>
                                <div class = "form-group">
                                    <label for = "rpwd">Re Enter Password: </label>
                                    <input type = "password" class = "form-control" name = "rePassword" id = "rpwd">
                                    <span class = "error">* <?php echo $repassErr;?></span>
                                </div>
                                <div class = "form-group">
                                    <label for = "phn">Phone: </label>
                                    <input type = "text" class = "form-control" name = "phone" id="phn" value = <?php echo$_SESSION['form_data']['phone'];?>>
                                    <span class = "error">* <?php echo $phoneErr;?></span>
                                </div>
                            </div>
                        </div>
                        <div class = "col-lg-4">
                            <div class = "info">
                                <div class = "form-group">
                                    <label for = "f_name">First Name:</label>
                                    <input type = "text" class = "form-control" name = "firstName" id = "f_name" value =<?php echo $_SESSION['form_data']['firstName'];?>>
                                    <span class = "error">*<?php echo $firstNameErr;?></span>
                                </div>
                                <div class = "form-group">
                                    <label for = "mname">Middle Name:</label>
                                    <input type = "text" class = "form-control" name = "middleName" id = "mname" value=<?php echo $_SESSION['form_data']['middleName'];?>>
                                    <p></p>
                                </div>
                                <div class="form-group">
                                    <label for="l_name">Last Name: </label>
                                    <input type = "text" class = "form-control" name = "lastName" id = "l_name" value =<?php echo $_SESSION['form_data']['lastName']?>>
                                    <span class = "error">*<?php echo $lastNameErr; ?></span>
                                </div>
                                <div class = "form-group">
                                    <label for = "d_o_b">Date Of Birth:</label>
                                    <input type = "Date" class = "form-control" name = "dob" id="d_o_b" value = <?php echo $_SESSION['form_data']['dob']?>>
                                    <span class = "error">*<?php echo $dobErr;?></span>
                                </div>
                                <div class = "form-group">
                                    <label for = "gender">Gender:</label>
                                    <span class="error">*</span>
                                    <div class = "radio">
                                        <label class = "radio-inline">
                                            <input type = "radio" name = "gender" value = "male" >Male
                                        </label>
                                        <label class = "radio-inline">
                                            <input type = "radio" name = "gender" value = "female">Female
                                        </label>
                                        <label class = "radio-inline">
                                            <input type = "radio" name = "gender" value = "others">Other
                                        </label>
                                    </div>
                                    <span class="error"><?php echo $genderErr;?></span>
                                </div>
                                <div class = "form-group">
                                    <label for = "sel1">Personal Interests:</label>
                                    <select multiple class = "form-control" id = "sel1" name = "interests[]">
                                        <option>Sports</option>
                                        <option>Books</option>
                                        <option>Computer and Software</option>
                                        <option>Fashion</option>
                                        <option>Photography</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class = "col-lg-4">
                            <div class = "address">
                                <div class = "form-group">
                                    <label for = "c_street">Current Street:</label>
                                    <input type = "text" class="form-control" name="cStreet" id="c_street" value=<?php echo $_SESSION['form_data']['cStreet'];?>>
                                    <span class = "error">*<?php echo $currentStreetErr;?></span>
                                </div>
                                <div class = "form-group">
                                    <label for = "c_city">Current City:</label>
                                    <input type = "text" class="form-control" name="cCity" id="c_city" value=<?php echo $_SESSION['form_data']['cCity'];?>>
                                    <span class = "error">*<?php echo $currentCityErr;?></span>
                                </div>
                                <div class = "form-group">
                                    <label for="c_state">Current State: </label>
                                    <input type = "text" class="form-control" name="cState" id="c_state" value=<?php echo $_SESSION['form_data']['cState'];?>>
                                    <span class = "error">*<?php echo $currentStateErr;?></span>
                                </div>
                                <div class = "form-group">
                                    <label for = "c_country">Current Country: </label>
                                    <input type = "text" class="form-control" name="cCountry" id="c_country" value=<?php echo $_SESSION['form_data']['cCountry'];?>>
                                    <span class = "error">*<?php echo $currentCountryErr;?></span>
                                </div>

                                <div class = "form-group">
                                    <label for = "p_street">Permanent Street:</label>
                                    <input type = "text" class="form-control" name="pStreet" id="p_street" value=<?php echo $_SESSION['form_data']['pStreet'];?>>
                                    <span class = "error">*<?php echo $permanentStreetErr;?></span>
                                </div>
                                <div class = "form-group">
                                    <label for = "p_city">Permanent City:</label>
                                    <input type = "text" class="form-control" name="pCity" id="p_city" value=<?php echo $_SESSION['form_data']['pCity'];?>>
                                    <span class = "error">*<?php echo $permanentCityErr;?></span>
                                </div>
                                <div class = "form-group">
                                    <label for = "p_state">Permanent State: </label>
                                    <input type = "text" class="form-control" name="pState" id="p_state" value=<?php echo $_SESSION['form_data']['pState'];?>>
                                    <span class = "error">*<?php echo $permanentStateErr;?></span>
                                </div>
                                <div class = "form-group">
                                    <label for = "p_country">Permanent Country: </label>
                                    <input type = "text" class="form-control" name="pCountry" id="p_country" value=<?php echo $_SESSION['form_data']['pCountry'];?>>
                                    <span class = "error">*<?php echo $permanentCountryErr;?></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <input type = "submit" class = "btn btn-success center-block " 
                value = "Submit" onclick = "return validate()">
            </form>

            <footer class = "text-nowrap"> Copyright &copy; MindfireSolutions.com</footer>
           
    </body>

    </html>