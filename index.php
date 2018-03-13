<?php
// Start the session
session_start();

echo '<pre>';
// print_r($_SESSION);
$_SESSION['form_data']['email'] = isset($_POST['email']) ? $_POST['email'] : '';
$_SESSION['form_data']['firstName'] = isset($_POST['firstName']) ? $_POST['firstName'] : '';
$_SESSION['form_data']['lastName'] = isset($_POST['lastName']) ? $_POST['lastName'] : '';
$_SESSION['form_data']['dob'] = isset($_POST['dob']) ? $_POST['dob'] : '';
$_SESSION['form_data']['phone'] = isset($_POST['Phone']) ? $_POST['phone'] : '';

// unset($_SESSION['form_data']);
print_r($_SESSION);
echo '</pre>';
?>

    <!DOCTYPE html>
    <html lang="en">

    <head>
        <title>Create User</title>
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
            
            nav {
                float: left;
                max-height: 280px;
            }
            
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

if ($_SERVER["REQUEST_METHOD"] == "POST") {

  if (empty($_POST["email"])) {
    $emailErr = "Email is required";
  } 
  else {
    $email = test_input($_POST["email"]);
     $_SESSION["email"]=$email;

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
      $emailErr = "Invalid email format"; 
    }
  }

  if (empty($_POST["password"])) {
    $passErr = "Password is required";
  }
  else {
    $pass = test_input($_POST["password"]);
    if (strlen($pass)<6 || (!preg_match("/[a-z]/",$pass))||(!preg_match("/[A-Z]/", $pass))||(!preg_match("/[0-9]/", $pass))){
      $passErr = "Password must contain minimum of 6 characters , a lower case letter, a upper case letter and an integer"; 
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
    }
  }

  if (empty($_POST["phone"])) {
    $phoneErr = "Phone is required" ;
  }
  else {
    $phone=test_input($_POST["phone"]);
    $_SESSION["Phone"]=$phone;
    if((preg_match("/{\+}?[^0-9]/",$phone))||(strlen($phone))!=10)
    $phoneErr = "Phone can have only numbers and should contain 10 integers";
  }

  if (empty($_POST["firstName"])){
    $firstNameErr = "First name is required";
  }
  else
  {
    $firstName=test_input($_POST["firstName"]);
    $_SESSION["firstName"] = $firstName;
    if(!preg_match("/^[a-zA-Z ]*$/", $firstName))
      $firstNameErr = "Name can contain only letters and white spaces";
  }

  if (empty(($_POST["lastName"]))) {
    $lastNameErr = "Last name is required";
  }
  else {
    $lastName = test_input($_POST["lastName"]);
    $_SESSION["lastName"] = $lastName;
    if (!preg_match("/^[a-zA-Z]*$/", $lastName))
      $lastNameErr = "Name can contain only letters and white spaces";
  }

  if (empty($_POST["dob"]) || !isset($_POST["dob"])) {
    $dobErr = "DOB is required";
  }
  else {
    $dob = test_input($_POST["dob"]);
    $_SESSION["dob"] = $dob;
    if($dob<1900-01-01)
      $dobErr="Illegal DOB";
    
  }

  if (empty($_POST["gender"])) {
    $genderErr = "Gender is required";
  }
  else {
    $gender = test_input($_POST["gender"]);
    $_SESSION["gender"] = $gender;
  }

  if (empty($_POST["cStreet"])) {
    $currentStreetErr = "Current Street is required";
  }
  else {
      $currentStreet = test_input($_POST["cStreet"]);
      $_SESSION["cstreet"] = $currentStreet;
  }
  
  if (empty($_POST["cState"])) {
    $currentStateErr = "Current State is required";
  }
  else {  $currentState = test_input($_POST["cState"]);
    $_SESSION["cstate"] = $currentState;
  }
  
  if (empty($_POST["cCountry"])) {
    $currentCountryErr = "Current Country is required";
  }
  else {
    $currentCountry=test_input($_POST["cCountry"]);
    $_SESSION["ccountry"]=$currentCountry;
  }

  if (empty($_POST["cCity"])) {
    $currentCityErr="Current City is required";
  }
  else {
    $currentCity=test_input($_POST["cCity"]);
    $_SESSION["ccity"]=$currentCity;
  }

  if (empty($_POST["pStreet"])) {
       $permanentStreetErr = "Permanent Street is required";
  } 
  else {
      $permanentStreet=test_input($_POST["pStreet"]);
      $_SESSION["pstreet"]=$permanentStreet;
  }

  if (empty($_POST["pState"])){
    $permanentStateErr="Permanent State is required";
  }
  else {
    $permanentState=test_input($_POST["pState"]);
    $_SESSION["pstate"]=$permanentState;;
  }

  if (empty($_POST["pCountry"])) {
    $permanentCountryErr="Permanent Country is required";
  }
  else {
    $permanentCountry=test_input($_POST["pCountry"]);
    $_SESSION["pcountry"]=$permanentCountry;
  }

  if (empty($_POST["pCity"])) {
    $permanentCityErr="Permanent City is required";
  }
  else {
    $permanentCity=test_input($_POST["pCity"]);
    $_SESSION["pcity"]=$permanentCity;
  }
}

function test_input($data) {
  $data = trim($data);
  $data = stripslashes($data);
  $data = htmlspecialchars($data);
  return $data;
}
?>

            <header style="height: 60px">
                <label class="text-nowrap">Create Account</label>
                <img src="logo.png" class="img-responsive" height="30px" width="30px;" align="right">
            </header>
            <p style="margin-left: 20px"><span class="error"> * required field.</span></p>
            <form name="myForm" action="<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]);?>" method="POST">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="credentials">
                                <div class="form-group">
                                    <label for="Email">Email address:</label>
                                    <input type="text" class="form-control" name="email" id="Email" value=<?php echo $_SESSION[ "email"];?>>
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
                                    <input type = "tel" class = "form-control" name = "phone" id="phn" value = <?php echo$_SESSION[ "Phone"];?>>
                                    <span class = "error">* <?php echo $phoneErr;?></span>
                                </div>
                            </div>
                        </div>
                        <div class = "col-lg-4">
                            <div class = "info">
                                <div class = "form-group">
                                    <label for = "f_name">First Name:</label>
                                    <input type = "text" class = "form-control" name = "firstName" id = "f_name" value =<?php echo $_SESSION[ "firstName"];?>>
                                    <span class = "error">*<?php echo $firstNameErr;?></span>
                                </div>
                                <div class = "form-group">
                                    <label for = "mname">Middle Name:</label>
                                    <input type = "text" class = "form-control" name = "middleName" id = "mname">
                                    <p></p>
                                </div>
                                <div class="form-group">
                                    <label for="l_name">Last Name: </label>
                                    <input type = "text" class = "form-control" name = "lastName" id = "l_name" value =<?php echo $_SESSION[ "lastName"]?>>
                                    <span class = "error">*<?php echo $lastNameErr; ?></span>
                                </div>
                                <div class = "form-group">
                                    <label for = "d_o_b">Date Of Birth:</label>
                                    <input type = "Date" class = "form-control" name = "dob" id="d_o_b" value = <?php echo $_SESSION[ "dob"]?>>
                                    <span class = "error">*<?php echo $dobErr;?></span>
                                </div>
                                <div class = "form-group">
                                    <label for = "gender">Gender:</label>
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
                                    <span class="error">*<?php echo $genderErr;?></span>
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
                                    <input type = "text" class="form-control" name="cStreet" id="c_street" value=<?php echo $_SESSION[ "cstreet"];?>>
                                    <span class = "error">*<?php echo $currentStreetErr;?></span>
                                </div>
                                <div class = "form-group">
                                    <label for = "c_city">Current City:</label>
                                    <input type = "text" class="form-control" name="cCity" id="c_city" value=<?php echo $_SESSION[ "ccity"];?>>
                                    <span class = "error">*<?php echo $currentCityErr;?></span>
                                </div>
                                <div class = "form-group" <label for="c_state">Current State: </label>
                                    <input type = "text" class="form-control" name="cState" id="c_state" value=<?php echo $_SESSION[ "cstate"];?>>
                                    <span class = "error">*<?php echo $currentStateErr;?></span>
                                </div>
                                <div class = "form-group">
                                    <label for = "c_country">Current Country: </label>
                                    <input type = "text" class="form-control" name="cCountry" id="c_country" value=<?php echo $_SESSION[ "ccountry"];?>>
                                    <span class = "error">*<?php echo $currentCountryErr;?></span>
                                </div>

                                <div class = "form-group">
                                    <label for = "p_street">Permanent Street:</label>
                                    <input type = "text" class="form-control" name="pStreet" id="p_street" value=<?php echo $_SESSION[ "pstreet"];?>>
                                    <span class = "error">*<?php echo $permanentStreetErr;?></span>
                                </div>
                                <div class = "form-group">
                                    <label for = "p_city">Permanent City:</label>
                                    <input type = "text" class="form-control" name="pCity" id="p_city" value=<?php echo $_SESSION[ "pcity"];?>>
                                    <span class = "error">*<?php echo $permanentCityErr;?></span>
                                </div>
                                <div class = "form-group">
                                    <label for = "p_state">Permanent State: </label>
                                    <input type = "text" class="form-control" name="pState" id="p_state" value=<?php echo $_SESSION[ "pstate"];?>>
                                    <span class = "error">*<?php echo $permanentStateErr;?></span>
                                </div>
                                <div class = "form-group">
                                    <label for = "p_country">Permanent Country: </label>
                                    <input type = "text" class="form-control" name="pCountry" id="p_country" value=<?php echo $_SESSION[ "pcountry"];?>>
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
            <!-- <script src="validate.js"></script> -->
    </body>

    </html>