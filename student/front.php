<?php  include "../general/funcs.php" ?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />
        <title>BrainStorm - Student</title>
        <link rel="stylesheet" href="studLoginStyle.css" />
    </head>
    <body>

        <div class="BG"></div>
        <!-- <header>
                <img class="logo" src="../indexes/img/BsStudent.png" alt="logo" href="../indexes/studentIndex.html"/>
                <button class = "navBtn inline" onclick = "location.replace('../student/mypath.php');" >My Path</button>
                <button class = "navBtn inline" onclick = "location.replace('../student/profile.php');" >Profile</button>
        </header> -->
        <div class="container" id="container">
        
            <div class="form-container sign-up-container">
            <!-- EDIT FORM ACTION FOR LINK -->
            <form action="../general/funcs.php" method = "POST">
                <h1>Create Account</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your email for registration</span>
                <input type="text" placeholder="School Email" name="email"/>
                <input type="text" placeholder="First Name" name="firstname"/>
                <input type="text" placeholder="Last Name" name="lastname"/>
                <select name = "subject" placeholder = " Subject" required> <?php echo populateSubjects(); ?> </select>
                <select name = "school" placeholder = " College / Institution" required> <?php echo populateSchools(); ?> </select>
                <input type = "password" placeholder=" Password" name="password" id = "pwa" required>
                <input type = "password" placeholder=" Verify Password" name="password-b" id = "pwb" required>
                <input type = "hidden" name = "message" value = "signupstudent">
                <p class = "p" id = "veriText">   *    *    *   </p>
                <button>Sign Up</button>
            </form>
        </div>
        <div class="form-container sign-in-container">
            <form action = "../general/funcs.php" method = "POST">
                <h1>Log In</h1>
                <div class="social-container">
                    <a href="#" class="social"><i class="fab fa-facebook-f"></i></a>
                    <a href="#" class="social"><i class="fab fa-google-plus-g"></i></a>
                    <a href="#" class="social"><i class="fab fa-linkedin-in"></i></a>
                </div>
                <span>or use your account</span>
                <input type="email" placeholder="Email" name = "email"/>
                <input type="password" placeholder="Password" name = "password"/>
                <input type = "hidden" name = "message" value = "loginstudent">
                <a href="#">Forgot your password?</a>
                <button>Log In</button>
            </form>
        </div>
        <div class="overlay-container">
            <div class="overlay">
                <div class="overlay-panel overlay-left">
                    <h1>Welcome Back!</h1>
                    <p>Login with your personal info to connect with us again</p>
                    <button class="ghost" id="signIn">Log In</button>
                </div>
                <div class="overlay-panel overlay-right">
                    <h1>Hello There!</h1>
                    <p>Start your journey with us by creating a new account</p>
                    <button class="ghost" id="signUp">Sign Up</button>
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
        $("#forgotPW").click(function(event)
        {
            event.preventDefault(); // cancel default behavior
            //generate new 
            //send email
        });
    </script>
</html>
