 <?php //@ob_start(); 
 //session_start();
 include "../general/funcs.php"; 
 $gpaData = popGpaGraph($_SESSION['student']);?> 
<!DOCTYPE html>
<html>
    <head>
        <title>My Path</title> 
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
    </head>
    <body class = "profileBody">
        <header>
          <!-- EDIT THIS WHEN CHANGING FROM GLITCH -->
            <a><img class="logo" src="../indexes/img/BsStudent.png" alt="logo" href="../indexes/studentIndex.html" onclick = "location.replace('../indexes/studentIndex.html');"/></a>
            <button class = "navBtn inline" onclick = "location.replace('../student/profile.php');" >Profile</button>
            <button class = "navBtn inline" onclick = "location.replace('../student/mypath.php');" >My Path</button>
            <button class = "navBtn inline" onclick = "location.replace('../student/explore.php');" >Explore</button>
        </header>
        <h1 class = "outerText">&nbsp; <?php echo nameByStudentID($_SESSION['student']); ?>'s Academic Path </h1>
        <h3 class = "outerText">&nbsp; @ <?php echo schoolByStudentID($_SESSION['student']);?> </h3>
        <div class = "container">
            <div class = "sub-container">
                <h3 class = "inline pull-left"> My Classes </h3>                
                <h3 class = "inline right"> GPA: <?php echo calcGPA($_SESSION['student']); ?> </h3>
                <hr class = "sep">
                <div class = "classesButtons">
                    <form action = "../general/funcs.php" method = "POST">
                        <button class = "btn orderClassBtn inline" name = "class-order-mypath-byname"> Order by Name</button>
                        <button class = "btn orderClassBtn inline" name = "class-order-mypath-bysubject"> Order by Subject</button>
                        <button class = "btn orderClassBtn inline" name = "class-order-mypath-byterm"> Order by Academic Term</button>
                        <input type = "hidden" name = "message" value = "reorder-classes">
                </form>
                </div>
                <br><br>
                <!-- DISPLAY MY CLASSES -->
                <table class = "table classesTable">
                    <thead>
                        <tr>
                            <th> Class </th>
                            <th> Name </th>
                            <th> Academic Term </th>
                            <th> Grade </th>
                            <th> Professor</th>
                            <th> Submit Comment</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php echo studentClassesTable($_SESSION['student']); ?>
                    </tbody>
                </table>
            </div>
            <br>
            <div class = "sub-container">
                <h3> Add a Class </h3> 
                <hr class = "sep">
                <form action = "../general/funcs.php" method = "post">
                    <select name = "class" class = "btn select"><?php echo populateClassesPerSchool($_SESSION['student']); ?></select>
                    <select name = "term" class = "btn select"><?php echo populateTerms(); ?></select>
                    <select name = "year" class = "btn select"><?php echo populateYears(); ?></select>
                    <select name = "grade" class = "btn select"><?php echo populateGrades(); ?></select>
                    <select name = "prof" class = "btn select"> <?php echo populateProfsPerSchool($_SESSION['student']); ?> </select>
                    <input type = "hidden" name = "message" value = "addNewClass">
                    <button class = "btn orderClassBtn"> Submit </button>
                </form>
            </div>
            <br>
            <div class = "sub-container">
                <h3> GPA TRACKER </h3>
                <hr class = "sep">
                <div id = "gpaGraph"><!-- DISPLAY GPA GRAPH --></div>
            </div>
        </div>

    </body>
    <script>
        Morris.Line({
            element: 'gpaGraph',
            data: [ <?php echo $gpaData; ?> ],
            xkey: ['SEMESTER'],
            ykeys: ['GPA'],
            ymin: 2.0,
            ymax: 4.0,
            labels: ['GPA'],
            hiderHover: 'auto',
            stacked: true
        });
    </script>
</html>