<?php
    include_once "../general/session.php";
    // --------------- POSTS -----------------//
    if($_POST['message'] == "startClassSession")
    {
        startClassSession(connDB(), $_POST['class']);
        echo '<script>location.replace("../prof/session.html");</script>';
    }

    if($_POST['message'] == "loginprof")
    {
        if(loginProf($_POST['email'], $_POST['password']))
        {
            $c = connDB();
            $sql = "SELECT ID, First_Name, Last_Name FROM Prof WHERE email = '".$_POST['email']."';";
            $s = $c -> prepare($sql);
            $s -> execute();
            $r = $s -> fetch(PDO::FETCH_ASSOC);
            $_SESSION['profID'] = $r['ID']; //define the session prof id
            $_SESSION['profFirst'] = $r['First_Name'];
            $_SESSION['profLast'] = $r['Last_Name'];
            echo '<script>alert(" Welcome ! "); location.replace("../indexes/profIndex.html");</script>';
        }
        else echo '<script> alert("Incorrect Credentials... Try Again");location.replace("../prof/front.php");</script>';

    }

    if($_POST['message'] == "newCollege")
    {
        insertSchool(connDB(), $_POST['name'], $_POST['location'], $_POST['major'], $_POST['email']);
        echo '<script>location.replace("../admin./admin.php");</script>';
    }

    if($_POST['message'] == "increaseBrains")
    {
        increaseStudentBrains(connDB(), $_POST['students'], $_POST['amount']);
        echo'<script>location.replace("session.php");</script>';
    }

    if($_POST['message'] == "comment")
    {
        $r = $_SESSION['crn-comment'];
        $_SESSION['crn-comment'] = $_POST['classid'];
        $_SESSION['prof-comment'] = $_POST['prof'];
        echo '<script>location.replace("../student/comment.php");</script>';
    }

    if($_POST['message'] == "submitComment")
    {
        submitComment($_POST['rank'], $_POST['commentary-text']);
        echo '<script>alert("Comment Submitted! Thanks!");location.replace("../student/mypath.php");</script>'; //NOTE: change later to PHP
    }

    if($_POST['message'] == "signupstudent")
    {
        if(student_emailRegistered($_POST['email'])) echo '<script>alert(" Email Is Already Registered ... "); location.replace("../student/front.php");</script>';
        else
        {
            if(passwords_match($_POST['password'], $_POST['password-b']))
            {
                signupstudent($_POST['email'], $_POST['firstname'], $_POST['lastname'], $_POST['major'], $_POST['password'], $_POST['school']);
                echo '<script>alert("Sign Up Succesfully!"); location.replace("../student/front.php");</script>';
            }
            else  echo '<script>alert(" Passwords Did Not Match ... "); location.replace("../student/front.php");</script>';
        }
        
    }

    if($_POST['message'] == "loginstudent")
    {
        if(isset($_POST['log-in'])) 
        {
            if(loginStudent($_POST['email'], $_POST['password']))
            {
                noteLogIn($_POST['email']);
                echo '<script>alert("welcome");</script>';
                echo '<script>location.replace("../indexes/studentIndex.html");</script>';
            }
            else echo '<script>location.replace("../student/front.php");</script>';
        }
        else if(isset($_POST['forgot-password']))
        {
            //generate new password
            $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
            $newpw = generate_string($permitted_chars, 10);

            //update new password
            echo update_student_password($newpw, $_POST['email']);

            //send the email with the new password
            // echo '<script>
            //     Email.send({
            //         Host : "smtp.yourisp.com",
            //         Username : "username",
            //         Password : "password",
            //         To : 'them@website.com',
            //         From : "you@isp.com",
            //         Subject : "This is the subject",
            //         Body : "And this is the body"
            //     }).then(
            //     message => alert(message)
            //     );
            
            // Email.send(
            //     "dan.shachaf@gmail.com",
            //     "'.$_POST['email'].'",
            //     "Your New BrainStorm Password",
            //     "Hello BrainStormer!
            //         Your new password is:
            //         '..'

            //         Please make sure to update your password next time you sign in!",
            //         "smtp.yourisp.com",

                

                

            // );</script>';

            //alert the user
            echo '<script>alert("Your New Password was sent to your email: '.$_POST['email'].'");</script>';
        }
        
    }

    if($_POST['message'] == "signupprof")
    {
        if(passwords_match($_POST['password'], $_POST['password-b']))
        {
            signupprof($_POST['email'], $_POST['firstname'], $_POST['lastname'], $_POST['school'], $_POST['password']);
            echo '<script>location.replace("../prof/front.php");</script>';
        }
        else  echo '<script>alert(" Passwords Did Not Match ... "); location.replace("../prof/front.php");</script>';

    }

    if($_POST['message'] == "addNewClass")
    {
        newClass($_POST['class'], $_POST['term'], $_POST['year'], $_POST['prof'], $_POST['grade']);
        echo '<script>alert("Class Inserted !"); location.replace("../student/mypath.php");</script>';
    }

    if($_POST['message'] == "update-profile-picture")
    {
        $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"])); 
        $fileSize = $_FILES['image']['size'];
        $fileError = $_FILES['image']['error']; 
        if($fileError === 0)
        {
            if($fileSize > 6000000) echo '<script>alert("Image Must Be Less than 6MB");</script>';
            else updateProfilePicture($file);
        }
        echo '<script>alert("Profile Picture has Been Updated!"); location.replace("../student/profile.php");</script>';
    }
    
    if($_POST['message'] == "reorder-classes")
    {
        if(isset($_POST['class-order-mypath-byname'])) $_SESSION['reorder-classes'] = "byname";
        if(isset($_POST['class-order-mypath-byterm'])) $_SESSION['reorder-classes'] = "byterm";
        if(isset($_POST['class-order-mypath-bysubject'])) $_SESSION['reorder-classes'] = "bysubject";
        echo '<script>location.replace("../student/mypath.php");</script>';    
    }
   
    if($_POST['message'] == "explore-class") {
        $_SESSION['class-selected'] = true;
        $_SESSION['explore-college'] = $_POST['school'];
        $_SESSION['explore-class-number'] = $_POST['class'];
        $_SESSION['explore-subject'] = $_POST['subject'];
        $_SESSION['explore-prof'] = $_POST['prof'];

        echo '<script>location.replace("../student/explore.php");</script>';
    }

    if($_POST['message'] == "populateDynamicClassDropDown") {
        echo classesBySubjectBySchool($_POST['school'], $_POST['subject']);
    }

    if($_POST['message'] == "populateDynamicProfDropDown") {
        echo profsBySubjectNubmerSchool($_POST['number'], $_POST['subject'], $_POST['school']);

    }
    
    if($_POST['message'] == "update-prof-profile-picture"){
        $file = addslashes(file_get_contents($_FILES["image"]["tmp_name"])); 
        $fileSize = $_FILES['image']['size'];
        $fileError = $_FILES['image']['error']; 
        if($fileError === 0)
        {
            if($fileSize > 6000000) echo '<script>alert("Image Must Be Less than 6MB");</script>';
            else updateProfProfilePicture($file);
        }
        echo '<script>alert("Profile Picture has Been Updated!"); location.replace("../prof/profile.php");</script>';
    }

    // ======================= FUNCTIONS ===================== //

    function passwords_match($a, $b)
    {
        if($a == $b) return true;
        else return false;
    }
    
    function generate_string($input, $strength = 16) {
        $input_length = strlen($input);
        $random_string = '';
        for($i = 0; $i < $strength; $i++) {
            $random_character = $input[mt_rand(0, $input_length - 1)];
            $random_string .= $random_character;
        }
     
        return $random_string;
    }

    function classNameBySubjectNumberCollege($sub, $col, $num) {
        $c = connDB();
        $sql = "SELECT Name FROM Class WHERE Subject = '".$sub."' AND Number = ".$num." AND College_ID = ".$col.";";
        $c -> prepare($sql);
        $s = $c -> execute();
        $r = $s -> fetch(PDO::FETCH_ASSOC);
        return $r['Name'];
    }

    function collegeNameByCollegeID($coll) {
        $sql = "SELECT Name FROM College WHERE ID = ".$coll.";";
        $c -> prepare($sql);
        $s = $c -> execute();
        $r = $s -> fetch(PDO::FETCH_ASSOC);
        return $r['Name'];
    }

    function classCRNBySubjectNumberCollege($sub, $col, $num) {
        $c = connDB();
        $sql = "SELECT CRN FROM Class WHERE Subject = '".$sub."' AND Number = ".$num." AND College_ID = ".$col.";";
        $c -> prepare($sql);
        $s = $c -> execute();
        $r = $s -> fetch(PDO::FETCH_ASSOC);
        return $r['CRN'];
    }

    function dateFormatTimeStamp($timestamp)
    {
        $months = array('Jan.', 'Feb.', 'Mar.', 'Apr.', 'May', 'June', 'July', 'Aug.', 'Sep.', 'Oct.', 'Nov.', 'Dec.');
        $newformat = $months[intval(substr($timestamp, 5, 2))-1].' '.substr($timestamp, 8, 2).', '.substr($timestamp, 0, 4);
        return $newformat;
    }

    function populateCommentsTable($col, $prof, $crn) {
        $colors = array("FF7E7E", "#FCA0A0", "#FCCEA0", "FCE0A0", "EFFF87", "#FCFCA0", "#CEFCA0", "#A0FCA0", "#A0FCCE", "#A0C3FC");
        $c = connDB();
        $sql = "SELECT ID, Student_ID, TimeStamp, Rating, Text FROM Comment WHERE Class_CRN = ".$crn." AND College_ID = ".$col." AND Prof_ID = ".$prof." LIMIT 12;";
        $s = $c -> prepare($sql);
        $s -> execute();
        $data = "";
        if($r = $s -> fetch(PDO::FETCH_ASSOC)) { //which means there is at least one comment on that course
            $data .= '<table class = "table">
                <thead>
                    <tr>
                        <th> Feedbacker </th>
                        <th> Rating </th>
                        <th> Comment </th>
                        <th> Date </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>'.nameByStudentID($r['Student_ID']).'</td>
                        <td><div style = "background-color: '.$colors[($r['Rating']-1)].' !important; border-radius:8px; border: 2px solid black; padding: 20% !important; text-align:center;">'.$r['Rating'].'</div></td>
                        <td>'.$r['Text'].'</td>
                        <td>'.dateFormatTimeStamp($r['TimeStamp']).'<td>
                    <tr>';
            while($r = $s -> fetch(PDO::FETCH_ASSOC)) {
                $data .= '<tr>
                    <td>'.nameByStudentID($r['Student_ID']).'</td>
                    <td><div style = "background-color: '.$colors[($r['Rating']-1)].' !important; border-radius:8px; border: 2px solid black; padding: 20% !important; text-align:center;">'.$r['Rating'].'</div></td>
                    <td>'.$r['Text'].'</td>
                    <td>'.dateFormatTimeStamp($r['TimeStamp']).'<td>
                <tr>';
            }
            $data .= '</tbody></table>';
        }
        else $data .= '<h5> Sorry, No Comments were recorded yet about this class... </h5>';
        return $data;
    }

    // --------------- PROFESSOR -----------------//
    function profBio($prof) {
        $c = connDB();
        $sql = "SELECT Biography FROM Prof WHERE ID = ".$prof.";";
        $s = $c -> prepare($sql);
        $s -> execute();
        $r = $s -> fetch(PDO::FETCH_ASSOC);
        $c = null;
        return $r['Biography'];
    }

    function populateProfClasses($prof) {
        $tbegin = "<table class = 'table profClassesTable'>
        <thead>
            <tr>
                <th> Class </th>
                <th> Read Comments </th>
            </tr>
        </thead>
        <tbody>";
        $tend = "</tobdy>
        </table>";
        $c = connDB();
        $data = "";
        $sql = "SELECT c.Name, c.Subject, c.Number, c.CRN FROM Class c JOIN ProfClass pc ON pc.Class_CRN = c.CRN WHERE Prof_ID = ".$prof." AND College_ID = (SELECT College_ID FROM Prof WHERE ID = ".$prof.");";
        $s = $c ->  prepare($sql);
        $s -> execute();
        while($r = $s -> fetch(PDO::FETCH_ASSOC))
        {
            $data .= 
            "<tr><form action = '../general/funcs.php' method = 'POST'>
                    <td><p value = ".$r['CRN'].">".$r['Name']." ( ".$r['Subject'].$r['Number']. " ) </p></td>
                    <td><input type = 'hidden' name = 'message' value = 'profReadOwnClassComments'><button class = 'btn btn-warning'>Explore</button></td>
            </form><tr>";
        }
        if(strlen($data) < 2) return "<h5> You Don't have any classes yet, please add classes </h5>";
        else return $tbegin.$data.$tend;
    }
    
    function getProfProfilePic($prof) {
        $c = connDB();
        $sql = "SELECT picture FROM Prof WHERE ID = ".$prof.";";
        $s = $c -> prepare($sql);
        $s -> execute();
        $r = $s -> fetch(PDO::FETCH_ASSOC);
        $c = null;
        if($r['picture'] == "NULL") return "../indexes/img/profileTemplate.png";
        return $r['picture'];
    }
    
    function newClass($class, $t, $y, $p, $g){
        $sql = "INSERT INTO Pupils VALUES (".$_SESSION['student'].", ".$class.", '".$t."', ".$y.", '".$g."', ".$p.", (SELECT College_ID FROM Student WHERE ID = ".$_SESSION['student']."));";
        $c = connDB();
        $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $c -> exec($sql);
        $c = null;
        return;
    }

    function nameByProfID($prof) {
        $sql = "SELECT First_Name, Last_Name FROM Prof WHERE ID = ".$prof.";";
        $c = connDB();
        $s = $c -> prepare($sql);
        $s -> execute();
        $r = $s -> fetch(PDO::FETCH_ASSOC);
        return $r['First_Name']." ".$r['Last_Name'];
    }

    function schoolByProfID($prof) {
        $sql = "SELECT c.Name FROM College c JOIN Prof s ON c.ID = s.College_ID WHERE s.ID = ".$prof.";";
        $c = connDB();
        $s = $c -> prepare($sql);
        $s -> execute();
        $r = $s -> fetch(PDO::FETCH_ASSOC);
        return $r['Name'];
    }

    function signupprof($em, $fn, $ln, $sc, $pw){
        $c = connDB();

        $sql2 = "SELECT MAX(ID)+1 FROM Prof;";
        $s = $c -> prepare($sql2);
        $s -> execute();
        $max = $s -> fetchColumn();

        $sql = "INSERT INTO Prof VALUES (".$max.", '".$fn."', '".$ln."', 1, ".$sc.", '".$em."', '".$pw."', 'NULL',  ' I am a Professor !');";
        $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $c -> exec($sql);

        $c = null; //NOTE: maybe close later $c -> close()
        return;
    }

    function loginProf($e, $p)
    {
        $c = connDB();
        $sql = "SELECT password FROM Prof WHERE email = '".$e."';";
        $s = $c -> prepare($sql);
        $s -> execute();
        $r = $s -> fetch(PDO::FETCH_ASSOC);
        $c = null;
        if($r['password'] == $p) return true;
        else return false;
    }

    function profNameByProfIDCollegeID($prof, $coll) {
        $sql = "SELECT First_Name, Last_Name FROM Prof WHERE College_ID = '".$coll."' AND ID = ".$prof.";";
        $c -> prepare($sql);
        $s = $c -> execute();
        $r = $s -> fetch(PDO::FETCH_ASSOC);
        return $r['First_Name']." ".$r['Last_Name'];
    }

    function updateProfProfilePicture($file) {
        $c = connDB();
        $sql = "UPDATE Prof SET picture = '".$file."' WHERE ID = ".$_SESSION['profID'].";";
        $c -> prepare($sql) -> execute();
        $c = null;
        return;
    }

    // --------------- STUDENT -----------------//
    function profsBySubjectNubmerSchool($num, $sub, $sch) {
        $c = connDB();
        $sql = "SELECT p.First_Name, p.Last_Name, p.ID FROM Prof p JOIN ProfClass pc ON pc.Prof_ID = p.ID JOIN Class c ON c.CRN = pc.Class_CRN WHERE c.Subject = '".$sub."' AND c.Number = ".$num." AND pc.College_ID = ".$sch.";";
        $s = $c -> prepare($sql);
        $s -> execute();
        $data = "<option value = 'none' selected disabled hidden>Select Instructor</option>";
        while($r = $s -> fetch(PDO::FETCH_ASSOC)) {
            $data .= '<option value = '.$r['ID'].'>'.$r['First_Name'].' '.$r['Last_Name'].'</option>';
        }
        return $data;
    }
    
    function classesBySubjectBySchool($school, $subject){
        // echo '<script>alert("Here are the classes: '.$school.$subject.'");</script>';
        $c = connDB();
        $sql = "SELECT Name, Number FROM Class WHERE College_ID = ".$school." AND Subject = '".$subject."';";
        $s = $c -> prepare($sql);
        $s -> execute();
        $data = "<option value = 'none' selected disabled hidden>Select a Class</option>";
        while($r = $s -> fetch(PDO::FETCH_ASSOC)){
            $data .= "<option value = ".$r['Number'].">".$r['Name']. " - ".$subject.$r['Number']."</option>";
        }
        return $data;
    }

    function schoolIDByStudentID($student)
    {
        $c = connDB();
        $sql = "SELECT College_ID FROM Student WHERE ID = ".$student.";";
        $s = $c -> prepare($sql);
        $s -> execute();
        $r = $s -> fetch(PDO::FETCH_ASSOC);
        return $r['College_ID'];
    }

    function update_student_password($newpw, $em) {
        $sql = "UPDATE Student SET password = '".$newpw."' WHERE Email = '".$em."';";
        $c -> prepare($sql) -> execute();
        return;
    }
    
    function student_emailRegistered($e)
    {
        $c = connDB();
        $sql = "SELECT Email FROM Student WHERE Email = '".$e."';";
        $s = $c -> prepare($sql);
        $s -> execute();
    
        if(!$s -> fetch(PDO::FETCH_ASSOC)) return false;
        else return true;
    }
    
    function updateProfilePicture($file){
        $c = connDB();
        $sql = "UPDATE Student SET picture = '".$file."' WHERE ID = ".$_SESSION['student'].";";
        $c -> prepare($sql) -> execute();
        $c = null;
        return;
    }

    function getProfilePic($student){
        $c = connDB();
        $sql = "SELECT picture FROM Student WHERE ID = ".$student.";";
        $s = $c -> prepare($sql);
        $s -> execute();
        $r = $s -> fetch(PDO::FETCH_ASSOC);
        $c = null;
        if($r['picture'] == "NULL") return "../indexes/img/profileTemplate.png";
        return $r['picture'];
    }

    function populateProfsPerSchool($student)
    {
        $c = connDB();
        $data = "";
        $sql = "SELECT ID, First_Name, Last_Name FROM Prof WHERE College_ID = (SELECT College_ID FROM Student WHERE ID = ".$student.");";
        $s = $c ->  prepare($sql);
        $s -> execute();
        while($r = $s -> fetch(PDO::FETCH_ASSOC))
        {
            $data .= "<option value = '".$r['ID']."'>".$r['First_Name']." ".$r['Last_Name']."</option>";
        }
        return $data;
    }
    
    function populateClassesPerSchool($student)
    {
        $c = connDB();
        $data = "";
        $sql = "SELECT CRN, Name, Subject, Number FROM Class WHERE College_ID = (SELECT College_ID FROM Student WHERE ID = ".$student.");";
        $s = $c ->  prepare($sql);
        $s -> execute();
        while($r = $s -> fetch(PDO::FETCH_ASSOC))
        {
            $data .= "<option value = '".$r['CRN']."'>".$r['Name']." [ ".$r['Subject']." ".$r['Number']." ]</option>";
        }
        return $data;
    }
    
    function emailByStudentID($student)
    {
        $sql = "SELECT Email FROM Student WHERE ID = ".$student.";";
        $c = connDB();
        $s = $c -> prepare($sql);
        $s -> execute();
        $r = $s -> fetch(PDO::FETCH_ASSOC);
        return $r['Email'];
    }
    
    function schoolLocationByStudentID($student)
    {
        $sql = "SELECT c.Location FROM College c JOIN Student s ON c.ID = s.College_ID WHERE s.ID = ".$student.";";
        $c = connDB();
        $s = $c -> prepare($sql);
        $s -> execute();
        $r = $s -> fetch(PDO::FETCH_ASSOC);
        return $r['Location'];
    }
    
    function nameByStudentID($student)
    {
        $sql = "SELECT First_Name, Last_Name FROM Student WHERE ID = ".$student.";";
        $c = connDB();
        $s = $c -> prepare($sql);
        $s -> execute();
        $r = $s -> fetch(PDO::FETCH_ASSOC);
        return $r['First_Name']." ".$r['Last_Name'];
    }
    
    function schoolByStudentID($student)
    {
        $sql = "SELECT c.Name FROM College c JOIN Student s ON c.ID = s.College_ID WHERE s.ID = ".$student.";";
        $c = connDB();
        $s = $c -> prepare($sql);
        $s -> execute();
        $r = $s -> fetch(PDO::FETCH_ASSOC);
        return $r['Name'];
    }

    function majorByStudentID($student)
    {
        $sql = "SELECT Major FROM Student WHERE ID = ".$student.";";
        $c = connDB();
        $s = $c -> prepare($sql);
        $s -> execute();
        $r = $s -> fetch(PDO::FETCH_ASSOC);
        return $r['Major'];
    }

    function noteLogIn($e)
    {
        $sql = "SELECT ID FROM Student WHERE Email = '".$e."';";
        $c = connDB();
        $s = $c -> prepare($sql);
        $s -> execute();
        $r = $s -> fetch(PDO::FETCH_ASSOC);
        $_SESSION['student'] = $r['ID'];
        // $sql = "UPDATE Student SET LoggedIn = 1 WHERE Email = '".$e."';";
        // $c -> prepare($sql) -> execute();
        $c = null;
        return;
    }
    
    function signupstudent($e, $f, $l, $m, $p, $school)
    {
        $c = connDB();

        $sql2 = "SELECT MAX(ID)+1 FROM Student;";
        $s = $c -> prepare($sql2);
        $s -> execute();
        $max = $s -> fetchColumn();

        $sql = "INSERT INTO Student VALUES (".$max.", '".$f."', '".$l."', 0, '".$m."', '".$e."', '".$p."', 0, '".$school."', 'NULL');";
        $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $c -> exec($sql);

        $c = null; //NOTE: maybe close later $c -> close()
        return;
    }
    
    function loginStudent($e, $p)
    {
        $c = connDB();
        $sql = "SELECT password, LoggedIn FROM Student WHERE Email = '".$e."';";
        $s = $c -> prepare($sql);
        $s -> execute();
        $r = $s -> fetch(PDO::FETCH_ASSOC);
        $c = null;
        if($r['password'] == $p) 
        {
            if($r['LoggedIn'] == 1)
            {
                echo '<script>alert("You are already logged in!");</script>';
                return false;
            }
            else return true;
        }
        else 
        {
            echo '<script>alert("Your Credentials Are Wrong, Try Again, Or Sign Up");</script>';
            return false;
        }
    }
    
    function submitComment($rate, $com)
    {
        $c = connDB();

        $sql2 = "SELECT MAX(ID)+1 FROM Student;";
        $s = $c -> prepare($sql2);
        $s -> execute();
        $max = $s -> fetchColumn();

        $sql = "INSERT INTO Comment VALUES (".$max.", ".$_SESSION['student'].", ".$_SESSION['crn-comment'].", ".$_SESSION['prof-comment'].", (SELECT College_ID FROM Prof WHERE ID = ".$_SESSION['prof-comment']."),NOW(), ".$rate.", '".$com."');";
        $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $c -> exec($sql);
        $c = null;
        return;

    }

    function getClassNameFromID($id)
    {
        $c = connDB();
        $sql = "SELECT Name, Subject, Number FROM Class WHERE CRN = ".$id.";";
        $s = $c -> prepare($sql);
        $s -> execute();
        $r = $s -> fetch(PDO::FETCH_ASSOC);
        $name = $r['Name']." | ".$r['Subject'].$r['Number'];
        $c = null;
        return $name;
    }
    
    function getProfNameFromID($id)
    {
        $c = connDB();
        $sql = "SELECT First_Name, Last_Name FROM Prof WHERE ID = ".$id.";";
        $s = $c -> prepare($sql);
        $s -> execute();
        $r = $s -> fetch(PDO::FETCH_ASSOC);
        $name = $r['First_Name']." ".$r['Last_Name'];
        $c = null;
        return $name;
    }

    function studentClassesTable($student)
    {
        $c = connDB();
        //doube fucking join SQL query LET'S GOOOO!
        if($_SESSION['reorder-classes'] == "byname") $sql = "SELECT s.Class_CRN, s.Term, s.Year, s.Grade, s.Prof_ID, c.Subject, c.Number, c.Name, p.First_Name, p.Last_Name FROM Pupils s JOIN Class c ON c.CRN = s.Class_CRN JOIN Prof p ON p.ID = s.Prof_ID WHERE s.Student_ID = ".$student." ORDER BY c.Name;";  
        else if($_SESSION['reorder-classes'] == "byterm") $sql = "SELECT s.Class_CRN, s.Term, s.Year, s.Grade, s.Prof_ID, c.Subject, c.Number, c.Name, p.First_Name, p.Last_Name FROM Pupils s JOIN Class c ON c.CRN = s.Class_CRN JOIN Prof p ON p.ID = s.Prof_ID WHERE s.Student_ID = ".$student." ORDER BY s.Year, s.Term;";  
        else if($_SESSION['reorder-classes'] == "bysubject") $sql = "SELECT s.Class_CRN, s.Term, s.Year, s.Grade, s.Prof_ID, c.Subject, c.Number, c.Name, p.First_Name, p.Last_Name FROM Pupils s JOIN Class c ON c.CRN = s.Class_CRN JOIN Prof p ON p.ID = s.Prof_ID WHERE s.Student_ID = ".$student." ORDER BY c.Subject, c.Number;";  
        else $sql = "SELECT s.Class_CRN, s.Term, s.Year, s.Grade, s.Prof_ID, c.Subject, c.Number, c.Name, p.First_Name, p.Last_Name FROM Pupils s JOIN Class c ON c.CRN = s.Class_CRN JOIN Prof p ON p.ID = s.Prof_ID WHERE s.Student_ID = ".$student.";";  
        $s = $c -> prepare($sql);
        $s -> execute();
        $data = "";
        while($r = $s -> fetch(PDO::FETCH_ASSOC))
        {
            $data .= "<form action = '../general/funcs.php' method = 'post'><tr>";
                $data .= "<td><input type = 'hidden' name = 'classid' value = '".$r['Class_CRN']."'>".$r['Subject'].$r['Number']."</p></td>";
                $data .= "<td>".$r['Name']."</td>";
                $data .= "<td>".$r['Term']." | ".$r['Year']."</td>";
                $data .= "<td>".$r['Grade']."</td>";
                $data .= "<td><input type = 'hidden' name = 'prof' value = '".$r['Prof_ID']."'>".$r['First_Name']. " ".$r['Last_Name']."</p></td>";
                $data .= "<td><input type='hidden' name='message' value='comment'><button class = 'btn btn-info'>Comment</button></td>";
            $data .= "</tr></form>";
        }
        $c = null;
        return $data;
    }

    function popGpaGraph($user)
    {
        $c = connDB();
        $sql = "SELECT DISTINCT Term, Year FROM Pupils WHERE Student_ID = '".$user."' AND College_ID = (SELECT College_ID FROM Student WHERE ID = ".$user.") ORDER BY Year;";
        $s = $c -> prepare($sql);
        $s -> execute();
        $totalUnits = 0; //initiatlize variables to calculate the GPA per term
        $totalIndValue = 0;
        $concurrent = 0;
        while($r = $s -> fetch(PDO::FETCH_ASSOC))
        {
            //next: embed the inner sql statement to calc gpa per semester;
            $sql2 = "SELECT p.Grade, c.Units FROM Pupils p JOIN Class c ON c.CRN = p.Class_CRN WHERE p.Student_ID = ".$user." AND p.Term  = '".$r['Term']."' AND p.Year = '".$r['Year']."';";
            $s2 = $c -> prepare($sql2);
            $s2 -> execute();
            $sem = 0;
            if($r['Term'] == "Spring") $sem = 0.1;
            elseif($r['Term'] == "Summer") $sem = 0.4;
            elseif($r['Term'] == "Fall") $sem = 0.6;
            $counter = 0;
            while($r2 = $s2 -> fetch(PDO::FETCH_ASSOC))
            {
                $counter++;
                $totalUnits += $r2['Units'];
                $value = 0;
                if($r2['Grade'] == 'A') $value = 4;
                elseif ($r2['Grade'] == 'B') $value = 3;
                elseif($r2['Grade'] == 'C') $value = 2;
                elseif ($r2['Grade'] == 'D') $value = 1;
                elseif ($r2['Grade'] == 'W') $totalUnits -= $r2['Units'];
                else $value = 0;
                $totalIndValue += ($r2['Units'] * $value);
            }
            $termGPA = round(($totalIndValue/$totalUnits), 2);
            $data .= "{SEMESTER:".($r['Year']+$sem).", GPA:".$termGPA."}, ";
        }
        //next: remove the last comma for snytax corrections
        $data = substr($data, 0, strlen($data) - 2);//cut the last two characters (remove a space and a comma)
        $c = null;
        return $data;
    }

    function calcGPA($user)
    {
        $c = connDB();
        $sql = "SELECT c.Units, p.Grade FROM Pupils p JOIN Class c ON c.CRN = p.Class_CRN WHERE p.Student_ID = ".$user.";";
        $s = $c -> prepare($sql);
        $s -> execute();
        $totalUnits = 0;
        $totalIndValue = 0;
        while($r = $s -> fetch(PDO::FETCH_ASSOC))
        {
            $totalUnits += $r['Units'];
            $value = 0;
            if($r['Grade'] == 'A') $value = 4;
            elseif ($r['Grade'] == 'B') $value = 3;
            elseif($r['Grade'] == 'C') $value = 2;
            elseif ($r['Grade'] == 'D') $value = 1;
            elseif ($r['Grade'] == 'W') $totalUnits -= $r['Units'];
            else $value = 0;
            $totalIndValue += ($r['Units'] * $value);
        }
        return round((($totalIndValue/$totalUnits)), 2);//essentially the floor function
    }

    // --------------- END STUDENT -----------------//


    function increaseStudentBrains($c, $s, $a)
    {
        $sql = "UPDATE Student SET Total_Brains = ((SELECT Total_Brains FROM Student WHERE ID = ".$s.") + ".$a.") WHERE ID = ".$s.";";
        $c -> prepare($sql) -> execute();

        $sql = "INSERT INTO Record VALUES (".$s.", ".$a.", ".$_SESSION['currentSessionID'].");";
        $c -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $c -> exec($sql);
        return;
    }
    
    function startClassSession($c, $class)
    {
        $sql2 = "SELECT MAX(ID)+1 FROM Session;";
        $s = $c -> prepare($sql2);
        $s -> execute();
        $max = $s -> fetchColumn();

        $sql = "INSERT INTO Session VALUES (CURDATE(), ".$class.", ".$_SESSION['profID'].", ".$max.");";
        $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $c -> exec($sql);

        $_SESSION['currentSessionID'] = $max;
        return;
    }

    function verifyCredentials($c, $e, $p)
    {
        $sql = "SELECT password FROM Prof WHERE email = '".$e."';";
        $s = $c -> prepare($sql);
        $s -> execute();
        $r = $s -> fetch(PDO::FETCH_ASSOC);
        if($p == $r['password']) return true;
        else return false;
    }

    function insertSchool($c, $n, $l)
    {
        $sql2 = "SELECT MAX(ID)+1 FROM College;";
        $s = $c -> prepare($sql2);
        $s -> execute();
        $max = $s -> fetchColumn();

        $sql = "INSERT INTO College VALUES (".$max.", '".$n."', '".$l."');";
        $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $c -> exec($sql);
        return;
    }

    
    // --------------- POPULATORS -----------------//
    
    function populateGrades()
    {
        $data = "<option value = 'A'>A</option>";
        $data .= "<option value = 'B'>B</option>";
        $data .= "<option value = 'C'>C</option>";
        $data .= "<option value = 'D'>D</option>";
        $data .= "<option value = 'F'>F</option>";
        $data .= "<option value = 'W'>Withdrawn</option>";
        $data .= "<option value = 'IP'>In Progress</option>";
        $data .= "<option value = 'P'>Planned</option>";
        return $data;

    }
    
    function populateBrainRecordTable($c)
    {
        $sql = "SELECT a.First_Name, b.Last_Name, a.Brains FROM Record a JOIN Student b ON b.id = a.Student_ID WHERE a.Session_ID = ".$_SESSION['currentSessionID'].";";
        $s = $c -> prepare($sql);
        $s -> execute();
        $data = "";
        while($r = $s -> fetch(PDO::FETCH_ASSOC))
        {   
            $data .= "<tr>";
            $data .= "<td>".$r['First_Name']." ".$r['Last_Name']."</td>";
            $data .= "<td>".$r['Brains']."</td>";
            $data .= "</tr>";
        }
        return $data;
    }
    
    function populateSessionStudents($c, $s)
    {
        $sql = "SELECT a.Student_ID, a.Class_Prof_ID, a.Class_CRN, b.First_Name, b.Last_Name FROM Pupils a JOIN Student b ON a.Student_ID = b.ID WHERE Class_CRN = (SELECT c.Class_CRN FROM Session c WHERE c.ID = ".$_SESSION['currentSessionID']." AND a.Class_Prof_ID = ".$_SESSION['Prof_ID'].");";
        $s = $c ->prepare($sql);
        $s -> execute();
        $data = "";
        while ($r = $s -> fetch(PDO::FETCH_ASSOC))
        {
            $data .= '<option value = '.$r['Student_ID'].'>'.$r['First_Name'].' '.$r['Last_Name'].'</option>';
        }
        return $data;
    }

    function populateSchools()
    {
        $c = connDB();
        $data = " ";
        $sql = "SELECT ID, Name FROM College WHERE ID > 0";
        $s = $c -> prepare($sql);
        $s -> execute();
        while($r = $s -> fetch(PDO::FETCH_ASSOC))
        {
            $data .= "<option value ='".$r['ID']."'>".$r['Name']."</option>";
        }
        $c  = null;
        return $data;
    }

    function populateProfs($c)
    {
        $data = " ";
        $sql = "SELECT ID, First_Name, Last_Name FROM Prof WHERE Active = 1";
        $s = $c -> prepare($sql);
        $s -> execute();
        while($r = $s -> fetch(PDO::FETCH_ASSOC))
        {
            $data .= "<option value ='".$r['ID']."'>".$r['First_Name']." ".$r['Last_Name']."</option>";
        }
        return $data;
    }

    function populateCourseByProf($c, $id)
    {
        $sql = "SELECT CRN, Name, Subject, Number, Section FROM Class WHERE Prof_ID = ".$id.";";
        $s = $c ->prepare($sql);
        $s -> execute();
        $data = "";
        while($r = $s -> fetch (PDO::FETCH_ASSOC))
        {
            $data .= "<option value = ".$r['CRN'].">".$r['Name']." [ ".$r['Subject'].$r['Number']." - ".$r['Section']." ] </option>";
        }
        return $data;
    }

    function populateYears()
    {
        $options = "";
        for($x = 0; $x <= 11; $x++)
        {
            $options .= '<option value = '.($x + 2010).'>  - '.($x+2010).'  -  </option>';
        }
        return $options;
    }

    function populateTerms()
    {
        $options = '<option value = "Summer">SUMMER</option>';
        $options .= '<option value = "Fall">FALL</option>';
        $options .= '<option value = "Spring">SPRING</option>';
        return $options;
    }

    function populateSubjects()
    {
        $c = connDB();
        $data = "";
        $sql = "SELECT * FROM Subject";
        $s = $c -> prepare($sql);
        $s -> execute();
        while($r = $s -> fetch(PDO::FETCH_ASSOC))
        {
            $data .= "<option value = '".$r['Code']."'>".$r['Name']."</option>";
        }
        return $data;
    }

    // --------------- CONNECTIONS -----------------//
    function connDB() 
    {
        $username = "root";
        $password = "MMB3189@A";
        $dsn = 'mysql:dbname=BrainStorm;host=127.0.0.1;port=3306;socket=/tmp/mysql.sock';  
        try {$conn = new PDO($dsn, $username, $password);} 
        catch (PDOException $e) { echo 'Connection Failed: ' . $e -> getMessage();} 
        return $conn;
    }
?>