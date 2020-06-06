<?php include "../general/funcs.php" ?>
<!DOCTYPE html>
<html>
    <head>
        <!-- PAGE SETTINGS IN LINKS -->
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.8.1/css/all.css" integrity="sha384-50oBUHEmvpQ+1lW4y57PTFmhCaXp0ML5d60M1M7uH2+nqUivzIebhndOJK28anvf" crossorigin="anonymous" />
        <title>Contact BrainStorm</title>
        <link rel="stylesheet" href="contactUs.css">
        <!-- Bootstrap for CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">      
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">  
        <!-- Bootstrap for JavaScript -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body>
        <header>
            <a><img class="logo left" src="../indexes/img/BrainStormLOGO.png" alt="logo" href="../indexes/studentIndex.html" onclick = "location.replace('../indexes/mainIndex.html');"/></a>
            <button class = "navBtn inline" onclick = "location.replace('../student/front.php');" >Professor</button>
            <button class = "navBtn inline" onclick = "location.replace('../student/front.php');" >Student</button>
        </header>
        <div class="BG"></div>
        <section class = "container">
            <div class = "form-container">
                Contact Us!
                <hr>
                <form action = "../general/funcs.php" method = "POST" id = "contact-us-form">
                    <label class = "contact-us-label">
                        Name<br>
                        <input type = "text" name = "name" class = "contact-input" required>
                    </label><br>
                    <label class = "contact-us-label">
                        School Email<br>
                        <input type = "text" name = "email" class = "contact-input" required>
                    </label><br>
                    <label class = "contact-us-label">
                        School
                        <select name = "school" class = "contact-input">
                            <option value = "none" selected disabled hidden> </option>
                            <?php echo populateSchools(); ?>
                        </select>
                    </label><br>
                    <label class = "contact-us-label">
                        Subject<br>
                        <input type = "text" name = "subject" class = "contact-input" required>
                    </label><br>
                    <label class = "contact-us-label">
                        Message<br>
                        <textarea name = "message" class = "contact-input" required></textarea>
                    </label><br><br>
                    <!-- <label> ADD THIS LATER (?)
                        Attach Files
                        <input type = "file" name = "file" class = "contact-input">
                    </label> -->
                    <input type = "hidden" name = "message" value = "contact-us">
                    <button class = "btn btn-success" style = "width: 100% !important;"> Submit </button>
                </form>
            </div>
        </section>
    </body>
</html>