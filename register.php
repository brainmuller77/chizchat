
<?php  
require 'config/config.php';
require 'includes/form_handlers/register_handler.php';
require 'includes/form_handlers/login_handler.php';
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <title>ChitChat</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->  
    <link rel="icon" type="image/png" href="images/icons/favicon.ico"/>
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->  
    <link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
    <link rel="stylesheet" type="text/css" href="css/util.css">
    <link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
<script src="assets/js/register.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="assets/js/register.js"></script>
</head>
<body>
    
    <?php  

    if(isset($_POST['register_button'])) {
        echo '
        <script>

        $(document).ready(function() {
            $("#first").hide();
            $("#second").show();
        });

        </script>

        ';
    }


    ?>
    <div class="container-login100" style="background-image: url('login/images/bg-01.jpg');">
        <div class="wrap-login100 p-l-55 p-r-55 p-t-80 p-b-30">

     <div class="login100-form-title p-b-37">
                  <h1>  ChitChat </h1> <br>  
                    <h6>Login or SignUp Below</h6>      
                </div>
               <div id="first">
                <form action="register.php" method="POST">
                 <div class="wrap-input100 validate-input m-b-20" data-validate="Enter username or email">
                    <input class="input100" type="email" name="log_email" placeholder="Email Address" value="<?php 
                    if(isset($_SESSION['log_email'])) {
                        echo $_SESSION['log_email'];
                    } 
                    ?>" required>
                    <span class="focus-input100"></span>
                     </div>
                    <br>
                    <div class="wrap-input100 validate-input m-b-20" data-validate = "Enter password">
                    <input class="input100" type="password" name="log_password" placeholder="Password" style="line-height: 0.3">
                    <span class="focus-input100"></span>
                    </div>
                    <br>
                    <?php if(in_array("Email or password was incorrect<br>", $error_array)) echo  "Email or password was incorrect<br>"; ?>
                   
                <div class="container-login100-form-btn">
                    <input class="login100-form-btn" type="submit" name="login_button" value="Login">
                   
                    <br>
                </div>
                 <br>
                    <a href="#" id="signup" class="signup">Doesn't have an account? Register here!</a>

                </form>
            </div>
           
               
                 <div id="second" style="display:none;">
                <div class="text-center">
                   <form action="register.php" method="POST">
                     <div class="wrap-input100 validate-input m-b-20" data-validate = "Enter First Name">
                    <input class="input100" type="text" name="reg_fname" placeholder="First Name" value="<?php 
                    if(isset($_SESSION['reg_fname'])) {
                        echo $_SESSION['reg_fname'];
                    } 
                    ?>" required>
                     <span class="focus-input100"></span>
                 </div>
                    <br>
                    <?php if(in_array("Your first name must be between 2 and 25 characters<br>", $error_array)) echo "Your first name must be between 2 and 25 characters<br>"; ?>
                    
                    

                      <div class="wrap-input100 validate-input m-b-20" data-validate = "Enter Last Name">
                    <input class="input100" type="text" name="reg_lname" placeholder="Last Name" value="<?php 
                    if(isset($_SESSION['reg_lname'])) {
                        echo $_SESSION['reg_lname'];
                    } 
                    ?>" required>
                     <span class="focus-input100"></span>
                 </div>
                    <br>
                    <?php if(in_array("Your last name must be between 2 and 25 characters<br>", $error_array)) echo "Your last name must be between 2 and 25 characters<br>"; ?>
                     <div class="wrap-input100 validate-input m-b-20" data-validate = "Enter Email">
                    <input class="input100" type="email" name="reg_email" placeholder="Email" value="<?php 
                    if(isset($_SESSION['reg_email'])) {
                        echo $_SESSION['reg_email'];
                    } 
                    ?>" required>
                     <span class="focus-input100"></span>
                 </div>
                    <br>
                        
                        <div class="wrap-input100 validate-input m-b-20" data-validate = "Enter Email">
                    <input class="input100" type="email" name="reg_email2" placeholder="Confirm Email" value="<?php 
                    if(isset($_SESSION['reg_email2'])) {
                        echo $_SESSION['reg_email2'];
                    } 
                    ?>" required>
                     <span class="focus-input100"></span>
                 </div>
                    <br>
                    <?php if(in_array("Email already in use<br>", $error_array)) echo "Email already in use<br>"; 
                    else if(in_array("Invalid email format<br>", $error_array)) echo "Invalid email format<br>";
                    else if(in_array("Emails don't match<br>", $error_array)) echo "Emails don't match<br>"; ?>

                        <div class="wrap-input100 validate-input m-b-20" data-validate = "Enter password">
                    <input class="input100" type="password" name="reg_password" placeholder="Password" required>
                    <span class="focus-input100"></span>
                 </div>
                    <br>
                    <div class="wrap-input100 validate-input m-b-20" data-validate = "Enter password">
                   
                    <input class="input100" type="password" name="reg_password2" placeholder="Confirm Password" required>
                    <span class="focus-input100"></span>
                 </div>
                    <br>
                    <?php if(in_array("Your passwords do not match<br>", $error_array)) echo "Your passwords do not match<br>"; 
                    else if(in_array("Your password can only contain english characters or numbers<br>", $error_array)) echo "Your password can only contain english characters or numbers<br>";
                    else if(in_array("Your password must be betwen 5 and 30 characters<br>", $error_array)) echo "Your password must be betwen 5 and 30 characters<br>"; ?>


                    <input class="login100-form-btn" type="submit" name="register_button" value="Register">
                    
                    <br>

                    <?php if(in_array("<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>", $error_array)) echo "<span style='color: #14C800;'>You're all set! Go ahead and login!</span><br>"; ?>
                    <a href="#first" id="signin" class="signin">Already have an account? Sign in here!</a>
                </form>
                </div>
            </div>
            

            
        </div>
    </div>
    
    

    <div id="dropDownSelect1"></div>
    
<!--===============================================================================================-->
    <script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/bootstrap/js/popper.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
    <script src="vendor/daterangepicker/moment.min.js"></script>
    <script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
    <script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
    <script src="js/main.js"></script>

</body>
</html>
