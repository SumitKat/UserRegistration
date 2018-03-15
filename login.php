<!DOCTYPE html>
<html>

<head>



    <title>Login</title>
    <meta charset = "utf-8">
    <meta name = "viewport" content="width=device-width, initial-scale=1">
    <link rel = "stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <script src = "https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src = "https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <style>
        body {
            background: url(loginbcg.jpg) no-repeat center center fixed;
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

         footer {
                color: white;
                background-color: black;
                padding: 1em;
                text-align: center;
                opacity: 0.9;
                align-items: bottom
                
                    
            }
        
        .bg-1 {
            color: #ffffff;
            margin-top: 16%
        }
        
        .card {
            opacity: 0.8;
            background-color: black;
            text-color: #ffffff;
        }
        
        .form {
            background-color: black;
            opacity: 1;
        }
        
        @media only screen and (max-width: 600px) {
            body {
                background-color: #ffffff;
                background: #ffffff;
            }
            .bg-1 {
                margin-top: 25%;
            }
            .label {}
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
                <a class="navbar-brand" href="#">Mindfire Solutions</a>
            </div>
            <div class = "collapse navbar-collapse" id="myNavbar">
                <ul class = "nav navbar-nav">
                    <li class="active"><a href="#">Home</a></li>
                    <li><a href = "#">Contact Us</a></li>
                    <li><a href = "#">Our Products</a></li>
                    <li><a href = "#">About Us</a></li>
                </ul>
                <ul class = "nav navbar-nav navbar-right">
                    <li><a href = "index.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <form name = "loginForm" action = "<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]);?>" method = "POST">
    <div class = "container-fluid text-center bg-1">
        <div class = "card col-lg-3 col-lg-offset-4.5 col-md-3 col-md-offest-4.5 col-sm-offset-4.5 col-sm-3">
            <div class = "row">
                <div class = "col-lg-12  col-md-12   col-sm-12 form">
                    <div class = "form-group">
                        <br>
                        <label> SIGN IN TO MINDFIRE</label>
                        <input class = "form-control" placeholder="Email" type = "email" name="loginEmail" id = "loginEmail" autofocus>
                        <input type = "password" placeholder = "Password" class = "form-control" name = "loginPassword" id = "loginPassword">
                        <input type = "submit" name = "login" class="btn btn-primary btn-block" value = "SIGN IN" onclick = "">
                        <br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>

     <footer class = "text-nowrap navbar-fixed-bottom"> Copyright &copy; MindfireSolutions.com</footer>
</body>

</html>