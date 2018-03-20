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
    <link rel="stylesheet" type="text/css" href="reindex.css">   
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
                    <li><a href = "login.php"><span class="glyphicon glyphicon-user"></span> Log In</a></li>
                </ul>
            </div>
        </div>
    </nav>
    <form class = "center-block" name = "loginForm" method = "POST">
        <div class = "container-fluid text-center bg-1 ">
            <div class = "card col-lg-3  col-lg-offset-0 col-md-4 col-md-offset-4 col-sm-offset-3 col-sm-6">
                <div class = "row"><label style="color: #000"><h4><strong>Create Account</strong> </h4></label><br>
                    <div class = "col-lg-12 col-md-12   col-sm-12 form">
                        <div class = "form-group bg-2">
                            <br>
                            <span class="error"><?php echo isset($emailErr) ? $emailErr : '';?></span>
                            <input class = "form-control" placeholder="Email" type = "email" name="loginEmail" id = "loginEmail" onchange="validate(this.value)" autofocus>
                            <input type = "password" placeholder = "Password" class = "form-control" name = "loginPassword" id = "loginPassword" onchange="validate(this.value)">
                            <input type = "password" placeholder = "Retype Password" class = "form-control" name = "loginRePassword" id = "loginRePassword" onchange="validate(this.value)">
                            <input type = "submit" name = "next" class="btn btn-primary btn-block" value = "Next">
                            <br>
                            <span id="ema" style="color: red"></span>
                            <span style="color: red"><?php echo isset($_SESSION['emailErr']) ? $_SESSION['emailErr'] : '';?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
    <script src="reindex.js"></script>
</body>
</html>