 <?php 
    start_session();
    include "funcs.php";
?> <html>
    <head>
        <title>Sign Up - BS</title>

        <!-- Bootstrap for CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">        
        <!-- CSS HARDCODE FILE LINK -->
        <link rel="stylesheet" type="text/css" href="signup.css"> 
        <!-- BOOTSTRAP FOR JAVASCRIPT AND JQUERY -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        
    </head>
    <body>
        <div class = "container">
            <h2>Welcome to your session _______</h2>
            <h4> Start a new Session by choosing a class</h4>
            <form action = "funcs.php" method = "post" class = "formalize">
                <select name  = "class">
                    <?php populateCourseByProf(connDB(), $_SESSION['profID']); ?>
                </select>
                <input type = "hidden" name = "message" value = "startClassSession">
                <button class = "btn btn-success">SUBMIT </button>
            </form> 
        </div>
        
    </body>
    <footer class = "footer">
        <p> BrainStorm - Give Your Students an Incentive! </p>
        <strong><p> The Productions of Shahaf, EJ, Nathan, and Roman </p></strong>
        <p> Ohlone Hacks 2020 </p>
    </footer>
</html>