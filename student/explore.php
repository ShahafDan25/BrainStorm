<?php //@ob_start(); 
 //session_start();
 include "../general/funcs.php";
//  $_SESSION['class-selected'] = false; ?>
<!DOCTYPE html>
<html>
    <head>
        <title>BrainStorm - Explore</title> 
        <!-- Bootstrap for CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">        
        <!-- CSS HARDCODE FILE LINK -->
        <link rel="stylesheet" type="text/css" href="student.css"> 
        <!-- Bootstrap for JavaScript -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
        <!-- MORRIS.JS (for graphing utilities from PHP data) LINKS -->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.css">
        <script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/morris.js/0.5.1/morris.min.js"></script>
        <!--  JQUERY BOOTSTRAP --> 
        

    </head>
    <body class = "profileBody">
        <header>
          <!-- EDIT THIS WHEN CHANGING FROM GLITCH -->
            <img class="logo" src="../indexes/img/BsStudent.png" alt="logo" href="../indexes/studentIndex.html"/>
            <button class = "navBtn inline" onclick = "location.replace('../student/mypath.php');" >My Path</button>
            <button class = "navBtn inline" onclick = "location.replace('../student/profile.php');" >Profile</button>
        </header>
        <h3 class = "outerText">Explore Classes From Your School and Other institutions </h3>
        <div class = "container">
            <div class = "sub-container">
                <h3> Select a Class to Explore </h3>
                <hr class = "sep">
                <form action = "../general/funcs.php" method = "POST">
                    <select name = "school" id = "colleges" required>
                        <option value = "<?php echo schoolIDByStudentID($_SESSION['student']); ?>" selected disabled hidden><?php echo schoolByStudentID($_SESSION['student']); ?></option>
                        <?php echo populateSchools(); ?>
                    </select>
                    <select required name = "subject" onchange = "getSelectedSubject(this.value, document.getElementById('colleges').value);" id = "subject">
                        <option value = "none" selected disabled hidden>Select a Subject</option>
                        <?php echo populateSubjects(); ?>
                    </select>
                    <select required name = "class" id = "classes" onchange = "getDynamicProfByClass(this.value, document.getElementById('colleges').value, document.getElementById('subject').value);">
                        <option value = "none" selected disabled hidden>Select a Class</option>
                    </select>
                    <select name = "prof" id = "profs" required>
                        <option value = "none" selected disabled hidden>Select Instructor</option>
                    </select>
                    <input type = "hidden" name = "message" value = "explore-class">
                    <button class = "btn btn-success">SUBMIT</button>
                </form>
            </div>
            <br>
            <?php if($_SESSION['class-selected'] == true) 
                {
                    echo '<div class = "sub-container">';
                    echo '<h3>Read About</h3>';
                    echo '</div>';
                }
            ?>
        </div>
    </body>
    <script>
        //dynamically populate classes (bu subject, school)
        function getSelectedSubject(subjectVal, schoolVal){
            $.ajax({
                type: "POST",
                url: "../general/funcs.php",
                data: {subject: subjectVal, school: schoolVal, message: "populateDynamicClassDropDown"},
                success: function(data){
                    $("#classes").html(data);
                }
            });
        }
        //dynamically populate professors (by class, subject, school)
        function getDynamicProfByClass(classNumber, college, major){
            $.ajax({
                type: "POST",
                url: "../general/funcs.php",
                data: {number: classNumber, school: college, subject: major, message: "populateDynamicProfDropDown"},
                success: function(data){
                    $("#profs").html(data);
                }
            });
        }
    </script>
</html>