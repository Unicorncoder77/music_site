<?php
/*if (!defined('theExperienceWebApp')) exit();*/
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login Page</title>
        <link rel="stylesheet" href="style.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
       <!-- <script src="script.js"></script> -->
    </head>
    <body>
       <script src="script.js"> </script>
        <div id="header"></div>

        
        <h1 class="loginHeader"> Log In or Register</h1>
        <div class="container">
            <div class="slider">
            </div>
            <div class="btns">
                <button class="loginBtn">Login</button>
                <button class="signupBtn">Signup</button>
                </div>

            <div class="forms">
<!-- add action to go to php -->
                <form method="POST" action="userLoginProcess.php">
                    <div class="loginBox">
                        <input type="text" name="username" class="email ele" placeholder="username">
                        <input type="password" name="password" class="pass ele" placeholder="enter password" id="logPass">
<!-- Add hide and unhide password-->
                        <label>
                            <input type="checkbox" onclick="passToggle()"> Show Password
                        </label>
                        <button type="submit" class="clkbtn" name="login">Login</button>

                    </div>
                </form>
                <form method="POST" action="userLoginProcess.php">
                    <div class="signupBox">
                        <input type="text" class="name ele" placeholder="username" name="username">
                        <input type="email" class="email ele" placeholder="name@email.com" name="email">
                        <input type="password" class="pass ele" placeholder="enter password" name="password">
<!--Create a new  -->
                        <input type="password" class="pass ele" placeholder="confirm password" id="newPass" name="newPass">
                        <label>
                            <input type="checkbox" onclick="newPassToggle()"> Show Password
                        </label>

                        <button type="submit" class="clkbtn" name="signup">Signup</button>
                    </div>
                </form>



            </div>
        </div>

        <script>

            function passToggle() {
                var pass = document.getElementById("logPass");
                if (pass.type === "password"){
                    pass.type = "text";
                } else {
                    pass.type = "password";
                }
            }

            function newPassToggle() {
                var newPass = document.getElementById("newPass");
                if (newPass.type === "password"){
                    newPass.type = "text";
                } else {
                    newPass.type = "password";
                }
            }
            let signup = document.querySelector(".signupBtn");
            let login = document.querySelector(".loginBtn");
            let slider = document.querySelector(".slider");
            let forms = document.querySelector(".forms");

            signup.addEventListener("click", () => {
                slider.classList.add("moveslider");
                forms.classList.add("forms-move");
            });

            login.addEventListener("click", () => {
                slider.classList.remove("moveslider");
                forms.classList.remove("forms-move");
            });

            let params = new URLSearchParams(window.location.search);
            let error = params.get("error");

            if (error == "user_exists"){
                alert("This username already exists in our system :p");
            }
        </script>
    </body>
</html>