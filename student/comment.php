<?php session_start(); include "../general/funcs.php"; ?>
<!DOCTYPE html>
<html>
    <head>
        <title>BrainStorm - Comment</title> 
        <!-- Bootstrap for CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">        
        <!-- CSS HARDCODE FILE LINK -->
        <link rel="stylesheet" type="text/css" href="student.css"> 
        <!-- Bootstrap for JavaScript -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    </head>
    <body>
        <header>
            <!-- EDIT THIS WHEN CHANGING FROM GLITCH -->
              <img class="logo" src="../indexes/img/BsStudent.png" alt="logo" href="../indexes/studentIndex.html"/>
              <button class = "navBtn inline" onclick = "location.replace('../student/mypath.php');" >My Path</button>
              <button class = "navBtn inline" onclick = "location.replace('../student/profile.php');" >Profile</button>
        </header>
        <div class = "container">
            <div class = "sub-container">
                <h1> Comment on a Class </h1>
                <h3>Professor: <?php echo getProfNameFromID($_SESSION['prof-comment']); ?> </h3>
                <br>
                <h3> Class:  <?php echo getClassNameFromID($_SESSION['crn-comment']); ?> </h3>
                <form action = "../general/funcs.php" method = "post">
                    <h3> What would you rate your experience in this class?</h3>
                    <input id = "ranking" type = "range" min = "1" max = "10" name = "rank" step = "1" onchange = "updateValueText(this.value);">
                    <label for="ranking" id = "ratingText">Rating</label>
                    <br>
                    <h3> Leave you comment about this class down below! </h3>
                    <textarea class = "comment-text" name = "commentary-text"></textarea>
                    <br>
                    <input type = "hidden" name = "message" value = "submitComment">
                    <button class = "btn navBtn inline">Submit</button>
                </form>
            </div>
        </div>
    </body>
    <script>
        var text = document.getElementById("ratingText");
        function updateValueText(val) {
            text.innerHTML = val;
        }
    </script>
</html>