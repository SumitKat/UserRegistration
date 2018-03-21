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
    <link rel="stylesheet" type="text/css" href="CSS/index.css">   
    <script src="JQuery/index.js">       
    </script>
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
                    <li><a href = "login.php"><span class="glyphicon glyphicon-user"></span> Log In</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <form class = "center-block form1" name = "loginForm" method = "POST">
        <div class = "container-fluid text-center bg-1 ">
            <div class = "card col-lg-3  col-lg-offset-0 col-md-4 col-md-offset-4 col-sm-offset-3 col-sm-6">
                <div class = "row"><label style="color: #000"><h4><strong>Create Account</strong> </h4></label><br>
                    <div class = "col-lg-12 col-md-12   col-sm-12 form">
                        <div class = "form-group bg-2">
                            <br>
                            <span class="error"><?php echo isset($emailErr) ? $emailErr : '';?></span>
                            <input class = "form-control" placeholder="Email" type = "email" name="loginEmail" id = "loginEmail" autofocus><img class= "tickEmail" src="tick.png" style="height : 20px"><p></p>
                            <input type = "password" placeholder = "Password" class = "form-control" name = "loginPassword" id = "loginPassword"><img class = "tickPass" src="tick.png" style="height : 20px"><p></p>
                            <input type = "password" placeholder = "Retype Password" class = "form-control" name = "loginRePassword" id = "loginRePassword"><img class = "tickRepass" src="tick.png" style="height : 20px"><p></p>
                            <input name = "next" id = "next" class="btn btn-primary btn-block button1" value = "Next">
                            <br>
                            <span id="ema" style="color: red"></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <form class = "center-block form2" method="POST">
         <div class = "container-fluid text-center bg-3 ">
            <div class = "card col-lg-3  col-lg-offset-0 col-md-4 col-md-offset-4 col-sm-offset-3 col-sm-6">
                <div class = "row"><label style="color: #000"><h4><strong>Create Account</strong> </h4></label><br>
                    <div class = "col-lg-12 col-md-12   col-sm-12 form">
                        <div class = "form-group bg-4">
                            <input class="form-control" type="text" name="name" placeholder="Name" id="name" autofocus><p></p>
                            <input class="form-control" type="text" name="phone" placeholder="Phone" id="phone">
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
                            <p></p>
                            <label for ="dob">Date Of Birth :</label>
                            <input class = "form-control" type="Date" name="dob" id ="dob">
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
                            <input name = "form2_next" id = "form2_next" class="btn btn-primary btn-block button1" value = "Next">
                            <br>
                            <span id="form2_err" style="color: red"></span>
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>