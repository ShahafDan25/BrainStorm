<?php 
    //include "../general/funcs.php";
    include "../general/funcs2.php";
    //var_dump(connDBs());
?>
<DOCYTPE! html>
<html>
    <head>
        <title>Sign Up - BS</title>

        <!-- Bootstrap for CSS -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">        
        <!-- CSS HARDCODE FILE LINK -->
        <link rel="stylesheet" type="text/css" href="admin.css"> 
        <!-- BOOTSTRAP FOR JAVASCRIPT AND JQUERY -->
        <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>

        
    </head>
    <body>
        <div class = "container">
            <br>
            <h1> WELCOME: ADMIN PAGE </h1>
            <hr>
            <h3> Choose from the following Options!</h3>
            <table class = "table tablize">
                <tbody>
                    <tr>
                        <th> Insert New Professor to the System </th>
                        <td> <button class = "btn btn-warning" data-toggle = "collapse" data-target = "#newProf" aria-expanded="false">CLICK HERE </button> </td>
                    </tr>
                    <tr>
                        <th> Insert New Class to the System </th>
                        <td> <button class = "btn btn-warning" data-toggle = "collapse" data-target = "#newClass" aria-expanded="false">CLICK HERE </button> </td>
                    </tr>
                    <tr>
                        <th> Insert New College (School) to the System </th>
                        <td> <button class = "btn btn-warning" data-toggle = "collapse" data-target = "#newCollege" aria-expanded="false">CLICK HERE </button> </td>
                    </tr>
                    <tr>
                        <th> Delete Professor from the System </th>
                        <td> <button class = "btn btn-warning" data-toggle = "collapse" data-target = "#delProf" aria-expanded="false">CLICK HERE </button> </td>
                    </tr>
                    <tr>
                        <th> Delete College (School) from the System </th>
                        <td> <button class = "btn btn-warning" data-toggle = "collapse" data-target = "#delCollege" aria-expanded="false">CLICK HERE </button> </td>
                    </tr>
                </tbody>
            </table>
            <!---------------------------------->
            <div class = "collapse" id = "newProf">
                <h3> INSERT A NEW PROFESSOR TO THE SYSTEM </h3>
                <form class = "formalize" action = "../general/funcs2.php" method = "post"> 
                    <table class = "table tablize">
                        <tbody>
                            <tr>
                                <td>First Name</td>
                                <td> <input type = "text" class = "inputize" name = "firstname" placeholder = "  First Name"></td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                <td> <input type = "text" class = "inputize" name = "lastname" placeholder = "  Last Name"></td>
                            </tr>
                            <tr>
                                <td>Email</td>
                                <td> <input type = "text" class = "inputize" name = "email" placeholder = "  Email"></td>
                            </tr>
                            <tr>
                                <td>Activity Status</td>
                                <td> <select name = "activity"> <?php echo '<option value=1>Active</option>';
                                echo '<option value=0>Inactive</option>';?></select></td>
                            </tr>
                            <tr>
                                <td>College of Instruction</td>
                                <td> <select name = "college"> <?php echo populateSchools(connDBs()); ?></select></td>
                            </tr>
                        </tbody>
                    </table>
                    <input type = "hidden" name = "message" value = "newProf">
                    <button class = "btn btn-success">SUBMIT</button>
                </form>
            </div>
            <!---------------------------------->
            <div class = "collapse" id = "newClass">
                <h3> INSERT A NEW CLASS TO THE SYSTEM </h3>
                <form class = "formalize" action = "../general/funcs2.php" method = "post"> 
                    <table class = "table tablize">
                        <tbody>
                            <tr>
                                <td>Name</td>
                                <td> <input type = "text" class = "inputize" name = "cname" placeholder = "  Class Name"></td>
                            </tr>
                            <tr>
                                <td>Subject</td>
                                <td> <input type = "text" class = "inputize" name = "subject" placeholder = "  Subject"></td>
                            </tr>
                            <tr>
                                <td>Class Number</td>
                                <td> <input type = "text" class = "inputize" name = "number" placeholder = "  Class Number"></td>
                            </tr>
                            <tr>
                                <td>Section Number</td>
                                <td> <input type = "text" class = "inputize" name = "section" placeholder = "  Section Number"></td>
                            </tr>  
                            <tr>
                                <td>Professor Instructing</td>
                                <td> <select name = "prof"> <?php echo populateProfs(connDBs()); ?></select></td>
                            </tr>
                            
                        </tbody>
                    </table>
                    <input type = "hidden" name = "message" value = "newClass">
                    <button class = "btn btn-success">SUBMIT</button>
                </form>
            </div>
            <!---------------------------------->
            <div class = "collapse" id = "newCollege">
                <h3> INSERT A NEW COLLEGE TO THE SYSTEM </h3>
                <form class = "formalize" action = "../general/funcs2.php" method = "post"> 
                    <table class = "table tablize">
                        <tbody>
                            <tr>
                                <td>College Name</td>
                                <td> <input type = "text" class = "inputize" name = "name" placeholder = "  College Name"></td>
                            </tr>
                            <tr>
                                <td>Address</td>
                                <td> <input type = "text" class = "inputize" name = "location" placeholder = "  Address"></td>
                            </tr>
                        </tbody>
                    </table>
                    <input type = "hidden" name = "message" value = "newCollege">
                    <button class = "btn btn-success">SUBMIT</button>
                </form>
            </div>
        </div>
            <!---------------------------------->
            <div class = "collapse" id = "delProf">
                <h3> DELETE PROFESSOR FROM THE SYSTEM </h3>
                <form class = "formalize" action = "../general/funcs2.php" method = "post"> 
                    <table class = "table tablize">
                        <tbody>
                            <tr>
                                <td>First Name</td>
                                <td> <input type = "text" class = "inputize" name = "firstname" placeholder = "  First Name"></td>
                            </tr>
                            <tr>
                                <td>Last Name</td>
                                <td> <input type = "text" class = "inputize" name = "lastname" placeholder = "  Last Name"></td>
                            </tr>
                            <tr>
                                <td>College of Instruction</td>
                                <td> <select name = "college"> <?php echo populateSchools(connDBs()); ?></select></td>
                            </tr>
                        </tbody>
                    </table>
                    <input type = "hidden" name = "message" value = "delProf">
                    <button class = "btn btn-success">SUBMIT</button>
                </form>
            </div>
        </div>
            <!---------------------------------->
            <div class = "collapse" id = "delCollege">
                <h3> DELETE COLLEGE FROM THE SYSTEM </h3>
                <form class = "formalize" action = "../general/funcs2.php" method = "post"> 
                    <table class = "table tablize">
                        <tbody>
                        <tr>
                                <td>College of Instruction</td>
                                <td> <select name = "college"> <?php echo populateSchools(connDBs()); ?></select></td>
                            </tr>
                        </tbody>
                    </table>
                    <input type = "hidden" name = "message" value = "delCollege">
                    <button class = "btn btn-success">SUBMIT</button>
                </form>
            </div>
        </div>
            <!---------------------------------->
    </body>
    <footer class = "footer">
        <p> BrainStorm - Give Your Students an Incentive! </p>
        <strong><p> The Productions of Shahaf, EJ, Nathan, and Roman </p></strong>
        <p> Ohlone Hacks 2020 </p>
    </footer>
</html>