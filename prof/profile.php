<?php session_start();
    include "../general/funcs.php"; 
?> 
<!-- Created By CodingNepal -->
<html>
    <head>
        <title>Brainstorm Menu</title>

            <!-- Bootstrap for CSS -->
            <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">      
            <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">  
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
            <!-- MORRIS.JS (for graphing utilities from PHP data) LINKS -->
    </head>
    <body class = "profile-body">
        <header>
          <!-- EDIT THIS WHEN CHANGING FROM GLITCH -->
            <a><img class="logo" src="../indexes/img/BsStudent.png" alt="logo" href="../indexes/studentIndex.html" onclick = "location.replace('../indexes/studentIndex.html');"/></a>
            <button class = "navBtn inline" onclick = "location.replace('../student/mypath.php');" >My Path</button>
            <button class = "navBtn inline" onclick = "location.replace('../student/explore.php');" >Explore</button>
        </header>
        <div class = "profile">
            <div class = "profile-section inline">
                <div class = "card centrize left">
                    <div class = "centrize profile-picture-container">
                        <?php 
                            if(getProfilePic($_SESSION['student']) == NULL) echo '<img class = "profile-picture" src="../indexes/img/profileTemplate.png"/>';
                            else echo '<img class = "profile-picture" src="data:image/jpeg;base64,'.base64_encode(getProfilePic($_SESSION['student'])).'"/>';
                        ?>
                    </div>
                    <hr class = "sep shorter-hr">
                    <h4><?php echo nameByStudentID($_SESSION['student']) ?></h4>
                    <h6><?php echo majorByStudentID($_SESSION['student']); ?></h6>
                    <p>@ <?php echo schoolByStudentID($_SESSION['student']); ?></p> 
                    <form action = "../general/funcs.php" method = "post" enctype="multipart/form-data" id ="form">
                        <label class = "btn btn-info profile-btn">
                            Update Profile Picture
                            <input hidden = true type = "file" name = "image" id = "image" accept = ".jpeg,.JPG,.PNG">
                        </label>
                        <input type = "hidden" name = "message" value = "update-profile-picture">
                    </form>
                </div>
            </div>
        </div>
    </body>
    <script>
        document.getElementById("image").onchange = function() {
            document.getElementById("form").submit();
        };
    </script>
</html>