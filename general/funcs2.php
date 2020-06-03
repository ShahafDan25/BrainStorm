<?php
session_start();   //start session variables accessibility
    // --------------- POSTS -----------------//
    if($_POST['message'] == "newProf")
    {
        $c = connDBs();
        insertProfessor($c, $_POST['firstname'], $_POST['lastname'], $_POST['activity'], $_POST['college'], $POST['email']);
        echo '<script>location.replace("../admin/admin.php");</script>';
        closeDB($c);
    }
    if($_POST['message'] == "delProf")
    {
        deleteProfessors(connDBs(), $_POST['firstname'], $_POST['lastname'], $_POST['college']);
        echo '<script>location.replace("../admin/admin.php");</script>';
    }
    if($_POST['message'] == "newClass")
    {
        $c = connDBs();
        insertCourse($c, $_POST['cname'], $_POST['subject'], $_POST['number'], $_POST['section'], $POST['prof']);
        echo '<script>location.replace("../admin/admin.php");</script>';
        closeDB($c);
    }
    if($_POST['message'] == "delCollege")
    {
        deleteColleges(connDBs(), $_POST['college']);
        echo '<script>location.replace("../admin/admin.php");</script>';
    }
    if($_POST['message'] == "newCollege")
    {
        insertSchool(connDBs(), $_POST['name'], $_POST['location']);
        echo '<script>location.replace("../admin/admin.php");</script>';
    }
    // --------------- POPULATORS -----------------// 
      function populateCourses($c)
    {
        $data = " ";
        $sql = "SELECT a.CRN, a.Name, a.Subject, a.Number, a.Section, b.ID FROM Class as a, Prof as b WHERE a.Prof_ID = b.ID";
        $s = $c -> prepare($sql);
        $s -> execute();
        while($r = $s -> fetch(PDO::FETCH_ASSOC))
        {
            $data .= "<option value ='".$r['CRN']."'>".$r['Name']."</option>";
        }
        return $data;
    }
       function populateStudents($c)
    {
        $data = " ";
        $sql = "SELECT a.ID, a.First_Name, a.Last_Name, a.Total_Brains, b.CRN FROM Student as a, Class as b WHERE a.C";
        $s = $c -> prepare($sql);
        $s -> execute();
        while($r = $s -> fetch(PDO::FETCH_ASSOC))
        {
            $data .= "<option value ='".$r['ID']."'>".$r['First_Name']." ".$r['Last_Name']."</option>";
        }
        return $data;
    }
        function populateSchools($c)
    {
        $data = " ";
        $sql = "SELECT ID, Name FROM College";
        $s = $c -> prepare($sql);
        $s -> execute();
        while($r = $s -> fetch(PDO::FETCH_ASSOC))
        {
            $data .= "<option value ='".$r['ID']."'>".$r['Name']."</option>";
        }
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

    // ---------------- INSERTIONS ------------------//
        function insertSchool($c, $n, $l)
    {
        $sql2 = "SELECT MAX(ID)+1 FROM College";
        $s = $c -> prepare($sql2);
        $s -> execute();
        $max = $s -> fetchColumn();

        $sql = "INSERT INTO College VALUES (".$max.", '".$n."', '".$l."');";
        $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $c -> exec($sql);
        return;
    }
        function insertProfessor($c, $fn, $ln, $a, $cid, $e)
    {
        $sql2 = "SELECT MAX(ID)+1 FROM Prof";
        $s = $c -> prepare($sql2);
        $s -> execute();
        $max = $s -> fetchColumn();

        $sql = "INSERT INTO Prof (ID, First_Name, Last_Name, Active, College_ID, email) 
            VALUES (".$max.", '".$fn."', '".$ln."', '".$a."', '".$cid."', '".$e."')";
        $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $c -> exec($sql);
        return;
    }
        function insertCourse($c, $n, $s, $num, $sec, $p)
    {
        $sql2 = "SELECT MAX(CRN)+1 FROM Class";
        $s = $c -> prepare($sql2);
        $s -> execute();
        $max = $s -> fetchColumn(); 
        
        $sql = "INSERT INTO Class (CRN, Name, Subject, Number, Section, Prof_ID) VALUES (".$max.", '".$n."',
         '".$s."', ".$num.", '".$sec."', ".$p.")";
        $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        $c -> exec($sql);
        return;
    }
    // ---------------- DELETIONS ------------------//
        function deleteColleges($c, $col)
    {
        $sql = "DELETE FROM College WHERE ID=".$col."";
        $s = $c -> prepare($sql);
        $s -> execute();

    }
        function deleteProfessors($c, $fn, $ln, $s)
    {
        $sql = "DELETE FROM Prof WHERE First_Name ='".$fn."' AND Last_Name ='".$ln."' AND College_ID=".$s."";
        $s = $c -> prepare($sql);
        $s -> execute();
    }
    // --------------- CONNECTIONS -----------------//
        function connDBs() 
    {
        $servername = "127.0.0.1";
        $username = "root";
        $password = "aPassword";
        $charset = "utf8mb4";
        try {
        $conn = new PDO("mysql:host=$servername;dbname=BrainStorm", $username, $password);
            // set the PDO error mode to exception
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
             echo "Connected successfully";
        } catch(PDOException $e) {
             echo "Connection failed: " . $e->getMessage();
        }
        return $conn;
    }
        function closeDB($c)
    {
        $c = null;
        return;
    }
?>