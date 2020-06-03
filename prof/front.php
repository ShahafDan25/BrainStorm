<?php 
    include "../general/funcs.php" ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous"/>
        <title>BrainStorm - Professor</title>
        <link rel="stylesheet" href="../prof/profLoginStyle.css" />
    </head>
    <body>
        <div class="BG"></div>
        <div class="container" id="container">
            <div class="form-container sign-up-container">
              <!-- EDIT FORM ACTION FOR LINK -->
                <form action="../general/funcs.php" method = "post">
                    <h1>Create Account</h1>
                    <div class="social-container">
                        <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                        <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <span>or use your email for registration</span>
                    <input type = "text" placeholder=" School Email" name="email" required/>
                    <input type = "text" placeholder=" First Name" name="firstname" required/>
                    <input type = "text" placeholder=" Last Name" name="lastname" required/>
                    <select name = "subject" placeholder = " Subject" required> <?php echo populateSubjects(); ?> </select>
                    <select name = "school" placeholder = " College / Institution" required> <?php echo populateSchools(); ?> </select>
                    <input type = "password" placeholder=" Password" name="password" id = "pwa" required>
                    <input type = "password" placeholder=" Verify Password" name = "password-b" id = "pwb" required>
                    <input type = "hidden" name = "message" value = "signupprof">
                    <p class = "p" id = "veriText">   *    *    *   </p>
                    <button>Sign Up</button>
                </form>
            </div>
            <div class="form-container sign-in-container">
                <form action = "../general/funcs.php" method = "post">
                    <h1>Log In</h1>
                    <div class="social-container">
                        <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                        <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                        <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                    </div>
                    <span>or use your account</span>
                    <input type="email" placeholder=" Email" name = "email"/>
                    <input type="password" placeholder=" Password" name = "password"/>
                    <input type = "hidden" name = "message" value = "loginprof">
                    <button>Log In</button>
                </form>
                <form action = "../general/funcs.php" method = "post">
                    <input type = "hidden" name = "message" value = "profForgorPW">
                    <a href="#">Forgot your password?</a>
                </form>
            </div>
            <div class="overlay-container">
                <div class="overlay">
                    <div class="overlay-panel overlay-left">
                        <h1>Welcome Back Professor!</h1>
                        <p>To keep connected with us please login with your personal info</p>
                        <button class="ghost" id="signIn">Log In</button>
                    </div>
                    <div class="overlay-panel overlay-right">
                        <h1>Hello, Professor!</h1>
                        <p>Enter your personal details and start journey with us</p>
                        <button class="ghost" id="signUp">Sign Up</button>
                    </div>
                </div>
            </div>
        </div>
    </body>
    <script>
        const signUpButton = document.getElementById('signUp');
        const signInButton = document.getElementById('signIn');
        const container = document.getElementById('container');

        var pwa = document.getElementById("pwa");
        var pwb = document.getElementById("pwb");
        var pwtext = document.getElementById("veriText");

        signUpButton.addEventListener('click', () => {
            container.classList.add('right-panel-active');
        });

        signInButton.addEventListener('click', () => {
            container.classList.remove('right-panel-active');
        });
        
        pwa.onkeyup = function(event){
            if (event.target.value.length == 0) {
                pwtext.innerHTML = "   *    *    *   ";
                pwa.style = "border:none"; // : #D6D6D6 !important;";
            } 
            else if(event.target.value.length < 8) {
                pwtext.innerHTML = "Password must be at least 8 characters";
                pwa.style = "border: 2px solid #D30000"; // : #D6D6D6 !important;";
            }
            else {
                pwtext.innerHTML = "   *    *    *   ";
                pwa.style = "border: 2px solid #39D300"; // : #D6D6D6 !important;";
            }
        }

        pwb.onkeyup = function(event){
            if (event.target.value.length == 0) {
                pwtext.innerHTML = "   *    *    *   ";
                pwb.style = "border:none"; // : #D6D6D6 !important;";
            } 
            else if(event.target.value != pwa.value) {
                pwtext.innerHTML = "Passwords do not match";
                pwb.style = "border: 2px solid #D30000"; // : #D6D6D6 !important;";
            }
            else {
                pwtext.innerHTML = "   *    *    *   ";
                pwb.style = "border: 2px solid #39D300"; // : #D6D6D6 !important;";
            }
        }

    </script>
</html>
