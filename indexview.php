<?php
session_start();
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
    <link rel="stylesheet" type="text/css" href="index.css">
</head>
<body background="background.jpg">
    <!-- navigation bar -->
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
    <!-- form for user information -->
    <form class="center-block" name="myForm" action="<?php echo htmlspecialchars("index.php");?>" method="POST">
        <div class="container-fluid bg-1">
            <div class="row">
                <div class="col-lg-4">
                    <div class="credentials">
                        <div class="form-group">
                            <label for="Email">Email address:</label>
                            <input type="text" class="form-control" name="email" id="Email" value=<?php echo isset($_SESSION['form_data']) ? $_SESSION['form_data']['email'] : '';?>>
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
                            <input type = "text" class = "form-control" name = "phone" id="phn" value = <?php echo isset($_SESSION['form_data']['phone']) ? $_SESSION['form_data']['phone']: '';?>>
                            <span class = "error">* <?php echo $phoneErr;?></span>
                        </div>
                    </div>
                </div>
                <div class = "col-lg-4">
                    <div class = "info">
                        <div class = "form-group">
                            <label for = "f_name">First Name:</label>
                            <input type = "text" class = "form-control" name = "firstName" id = "f_name" value =<?php echo isset($_SESSION['form_data']['firstName']) ? $_SESSION['form_data']['firstName'] : '';?>>
                            <span class = "error">*<?php echo $firstNameErr;?></span>
                        </div>
                        <div class = "form-group">
                            <label for = "mname">Middle Name:</label>
                            <input type = "text" class = "form-control" name = "middleName" id = "mname" value=<?php echo isset($_SESSION['form_data']['middleName']) ?$_SESSION['form_data']['middleName'] : '';?>>
                            <p></p>
                        </div>
                        <div class="form-group">
                            <label for="l_name">Last Name: </label>
                            <input type = "text" class = "form-control" name = "lastName" id = "l_name" value =<?php echo isset($_SESSION['form_data']['lastName']) ? $_SESSION['form_data']['lastName'] : ''?>>
                            <span class = "error">*<?php echo $lastNameErr; ?></span>
                        </div>
                        <div class = "form-group">
                            <label for = "d_o_b">Date Of Birth:</label>
                            <input type = "Date" class = "form-control" name = "dob" id="d_o_b" value = <?php echo isset($_SESSION['form_data']['dob']) ? $_SESSION['form_data']['dob'] : ''?>>
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
                            <input type = "text" class="form-control" name="cStreet" id="c_street" value=<?php echo isset($_SESSION['form_data']['cStreet']) ? $_SESSION['form_data']['cStreet'] : '';?>>
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
        value = "Submit";">
    </form>

    <footer class = "text-nowrap"> Copyright &copy; MindfireSolutions.com</footer>
           
    </body>

    </html>
