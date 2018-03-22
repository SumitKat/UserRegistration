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
    <link rel="stylesheet" type="text/css" href="css/index.css"> 

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <script src="js/index.js">       
    </script>
</head>
<body>

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
                    <li><a href = "model/login.php"><span class="glyphicon glyphicon-user"></span> Log In</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <!-- form for email and password input -->
    <form class="center-block form1" name="loginForm" method="POST" action="api/database.php">
        <div class="container-fluid container1">
        <div class = "container-fluid text-center bg-1 ">
            <div class = "card col-lg-3  col-lg-offset-0 col-md-4 col-md-offset-4 col-sm-offset-3 col-sm-6">
                <div class = "row"><label style="color: #000"><h4><strong>Create Account</strong> </h4></label><br>
                    <div class = "col-lg-12 col-md-12   col-sm-12 form">
                        <div class = "form-group bg-2">
                            <br>
                            <input class = "form-control" placeholder="Email" type = "email" name="loginEmail" id = "loginEmail" autofocus><img class= "tickEmail" src="img/tick.png" style="height : 20px"><p></p>
                            <input type = "password" placeholder = "Password" class = "form-control" name = "loginPassword" id = "loginPassword"><img class = "tickPass" src="img/tick.png" style="height : 20px"><p></p>
                            <input type = "password" placeholder = "Retype Password" class = "form-control" name = "loginRePassword" id = "loginRePassword"><img class = "tickRepass" src="img/tick.png" style="height : 20px"><p></p>
                            <input name = "next" id = "next" class="btn btn-primary btn-block button1" value = "Next">
                            <br>
                            <span id="ema" style="color: red"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <div class="container-fluid container2">
         <div class = "container-fluid text-center bg-3 ">
            <div class = "card col-lg-3  col-lg-offset-0 col-md-4 col-md-offset-4 col-sm-offset-3 col-sm-6">
                <div class = "row"><label style="color: #000"><h4><strong>Create Account</strong> </h4></label><br>
                    <div class = "col-lg-12 col-md-12   col-sm-12 form">
                        <div class = "form-group bg-4">
                            <input class="form-control" type="text" name="name" placeholder="Name" id="name" autofocus><img class= "tickName" src="img/tick.png" style="height : 20px"><p></p>
                            <input class="form-control" type="text" name="phone" placeholder="Phone" id="phone">
                            <img class= "tickPhone" src="img/tick.png" style="height : 20px">
                            <p></p>
                            <label for = "gender">Gender:</label>
                            <label class = "radio-inline">
                                <input type = "radio" name = "gender" value = "male" >Male
                            </label>
                            <label class = "radio-inline">
                                <input type = "radio" name = "gender" value = "female">Female
                            </label>
                            <label class = "radio-inline">
                                <input type = "radio" name = "gender" value = "others">Other
                            </label>
                            <img class= "tickGender" src="img/tick.png" style="height : 20px">
                            <p></p>
                            <label for ="dob">Date Of Birth :</label>
                            <input class = "form-control" type="Date" name="dob" id ="dob">
                            <img class= "tickDate" src="img/tick.png" style="height : 20px">
                            <p></p>
                            <label for = "sel1">Personal Interests:</label>
                            <select multiple class = "form-control" id = "sel1" name = "interests[]">
                                <option>Sports</option>
                                <option>Books</option>
                                <option>Computer and Software</option>
                                <option>Fashion</option>
                                <option>Photography</option>
                            </select>
                            <p></p>
                            <div class="button-group">
                            <input name = "form2_next" id = "form2_next" class="btn btn-primary btn-block button1" value = "Next">
                            <input name = "form2_prev" id = "form2_prev" class="btn btn-default btn-block button1" value = "Back">
                            </div>
                            <br>
                            <span id="form2_err" style="color: red"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container3">
         <div class = "container-fluid text-center bg-5 ">
            <div class = "card col-lg-3  col-lg-offset-0 col-md-4 col-md-offset-4 col-sm-offset-3 col-sm-6">
                <div class = "row"><label style="color: #000"><h4><strong>Add Details</strong> </h4></label><br>
                    <div class = "col-lg-12 col-md-12   col-sm-12 form">
                        <div class = "form-group bg-6">
                            <input class="form-control" type="text" name="street" placeholder="Street Address" id="street" autofocus>
                            <img class= "tickStreet" src="img/tick.png" style="height : 20px"><p></p>
                            <input class="form-control" type="text" name="city" placeholder="City" id="city">
                            <img class= "tickCity" src="img/tick.png" style="height : 20px">
                            <p></p>
                            <input class="form-control" type="text" name="state" placeholder="State/Province" id="state">
                            <img class= "tickState" src="img/tick.png" style="height : 20px">
                            <p></p>
                            <input class="form-control" type="text" name="country" placeholder="Country" id="country">
                            <img class="tickCountry" src="img/tick.png" style="height : 20px">
                            <p></p>
                            <input type = "submit" name="form3_register" id="form3_next" class="btn btn-primary btn-block button1" value = "Register">
                            <input name = "form3_prev" id = "form3_prev" class="btn btn-default btn-block button1" value = "Back">
                            <br>
                            <span id="form3_err" style="color: red"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
       </div> 
    </form>
</body>
</html>