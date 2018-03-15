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


        @media only screen and (min-width: 1200px) {
            .bg-1 {
            color: #ffffff;
            display: flex;
            align-items: center;
            justify-content: center;

        }
        }

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
                align-self: bottom
                
                    
            }
        
        .bg-1 {
            color: #ffffff;
            margin-top: 16%;
            }
        
        .card {
            opacity: 0.8;
            background-color: black;
            text-color: #ffffff;
            align-items: center;
            justify-content: center;
            align-content: center;
        }

        .error {
                color: #ff0000;
            }
        
        @media only screen and (max-width: 600px) {
            
            .bg-1 {
                margin-top: 25%;
                
            }
        
        }
    </style>

</head>

<body>
    <?php

        $emailErr = $passErr = "";
        $email = $pass = "";
        $flag = FALSE;

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            if(empty($_POST['loginEmail'])) {
                $emailErr = "Email can't be empty";
                $flag = TRUE;
            }
            else {
                $email = test_input($_POST['loginEmail']);

                if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $emailErr = "Enter a valid Email";
                    $flag = TRUE;
                }
            }

            if (empty($_POST['loginPassword'])) {
                $passErr="Password can't be empty";
                $flag = TRUE;
            }
            else {
                $pass = test_input($_POST['loginPassword']);

                if (strlen($pass)<6 || (!preg_match("/[a-z]/",$pass))||(!preg_match("/[A-Z]/", $pass))||(!preg_match("/[0-9]/", $pass))){
                        $passErr = "Enter a Valid Password"; 
                        $flag = TRUE;
                }
            }

        }


        function test_input($data) {
            $data = trim($data);
            $data = stripslashes($data);
            $data = htmlspecialchars($data);
            return $data;
        }


        if($flag == FALSE) {

                $servername = "localhost";
                $username = "root";
                $password = "mindfire";
                $databaseName="myDB";

                // Create connection
                $conn = new mysqli($servername, $username, $password,$databaseName);

                // Check connection
                if ( $conn->connect_error ) {
                    die( "Connection failed: " . $conn->connect_error );
                } 

                $sql = "SELECT id,first_name, last_name, password FROM  users WHERE email = '$email' LIMIT 1";
                $result = $conn->query($sql);
                if ($result->num_rows == 0) {
                    echo "Invalid email id or Password";
                }
                else {
                    $row = $result->fetch_assoc();
                    if($row['password'] == crypt($pass,'salt')) {
                        $_SESSION['login']['id'] = $row['id'];
                        $_SESSION['login']['firstName'] = $row['first_name'];
                        $_SESSION['login']['lastName'] = $row['last_name'];
                        header("Location: dashboard.php");
                    }
                    
                }   
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
                    <li><a href = "index.php"><span class="glyphicon glyphicon-user"></span> Sign Up</a></li>
                </ul>
            </div>
        </div>
    </nav>

    <form class = "center-block" name = "loginForm" action = "<?php echo htmlspecialchars($_SERVER[" PHP_SELF "]);?>" method = "POST">
    <div class = "container-fluid text-center bg-1 ">
        <div class = "card col-lg-3  col-lg-offset-0 col-md-4 col-md-offset-4 col-sm-offset-3 col-sm-6">
            <div class = "row">
                <div class = "col-lg-12 col-md-12   col-sm-12 form">
                    <div class = "form-group bg-2">
                        <br>
                        <label> SIGN IN TO MINDFIRE</label><br>
                        <span class="error"><?php echo $emailErr;?></span>
                        <input class = "form-control" placeholder="Email" type = "email" name="loginEmail" id = "loginEmail" autofocus>
                        
                       <span class="error"><?php echo $passErr;?></span>
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