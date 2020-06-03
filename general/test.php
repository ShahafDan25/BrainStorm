<?php 
    function connDB() 
    {
        $username = "root";
        $password = "MMB3189@A";
        $dsn = 'mysql:dbname=BrainStorm;host=127.0.0.1;port=3306;socket=/tmp/mysql.sock';  
        try {$conn = new PDO($dsn, $username, $password);} 
        catch (PDOException $e) { echo 'Connection Failed: ' . $e -> getMessage();} 
        return $conn;
    }
    $c = connDB();

    $sql = "";
    $sql .= "INSERT INTO Student VALUES (2, 'John', 'Doe', 0, 'Mathematics', 'jxdoe@zonemail.clpccd.edu', 'aabbccdd');";
    $sql .= "INSERT INTO Student VALUES (3, 'Isaac', 'Smith', 0, 'Mathematics', 'ismith@zonemail.clpccd.edu', 'aabbccdd');";
    $sql .= "INSERT INTO Student VALUES (4, 'Jose', 'Lopez', 0, 'Mathematics', 'jlopez@zonemail.clpccd.edu', 'aabbccdd');";
    $sql .= "INSERT INTO Student VALUES (5, 'Travis', 'Pink', 0, 'Mathematics', 'twhite@zonemail.clpccd.edu', 'aabbccdd');";
    $sql .= "INSERT INTO Student VALUES (6, 'Trevor', 'Brown', 0, 'Mathematics', 'tbrown@zonemail.clpccd.edu', 'aabbccdd');";
    $sql .= "INSERT INTO Student VALUES (7, 'Daniel', 'Green', 0, 'Mathematics', 'dgreen@zonemail.clpccd.edu', 'aabbccdd');";
    $sql .= "INSERT INTO Student VALUES (8, 'Nathan', 'Bennett', 0, 'Mathematics', 'nbennet@zonemail.clpccd.edu', 'aabbccdd');";
    $sql .= "INSERT INTO Student VALUES (9, 'Michelle', 'Steinberg', 0, 'Mathematics', 'msteinberg@zonemail.clpccd.edu', 'aabbccdd');";
    $sql .= "INSERT INTO Student VALUES (10, 'Matthew', 'Kim', 0, 'Mathematics', 'mkim@zonemail.clpccd.edu', 'aabbccdd');";
    $sql .= "INSERT INTO Student VALUES (11 'North', 'West', 0, 'Mathematics', 'nwest@zonemail.clpccd.edu', 'aabbccdd');";
    $sql .= "INSERT INTO Student VALUES (12, 'Kaylee', 'Rooney', 0, 'Mathematics', 'krooney@zonemail.clpccd.edu', 'aabbccdd');";
    $sql .= "INSERT INTO Student VALUES (13, 'Breanna', 'Black', 0, 'Mathematics', 'bblack@zonemail.clpccd.edu', 'aabbccdd');";

    $sql .= "INSERT INTO Prof VALUES (3, 'Paul', 'Hrycewicz', 1, 2, 'pxhrycewicz@diablovalleycollege.edu', 'aabbccdd');";
    $sql .= "INSERT INTO Prof VALUES (4, 'Travis', 'White', 1, 1, 'twhite@laspositascollege.edu', 'aabbccdd');";
    $sql .= "INSERT INTO Prof VALUES (5, 'Carlos', 'Moreno', 1, 1, 'cxmoreno@laspositascollege.edu', 'aabbccdd');";
    $sql .= "INSERT INTO Prof VALUES (6, 'Joel', 'Abramson', 1, 3, 'jabramson@ohlonecollege.edu', 'aabbccdd');";
    $sql .= "INSERT INTO Prof VALUES (7, 'Jim', 'Pham', 1, 3, 'jpham@dohlonecollege.edu', 'aabbccdd');";
    $sql .= "INSERT INTO Prof VALUES (8, 'Juan Pablo', 'Mercado', 1, 4, 'jmercado@chabotcollege.edu', 'aabbccdd');";

    $sql .= "INSERT INTO Class VALUES (1, 'Data Structures', 'CS', 20, 3, 2);";
    $sql .= "INSERT INTO Class VALUES (2, 'Differential Equations', 'MATH', 5, 2, 1);";
    $sql .= "INSERT INTO Class VALUES (3, 'Database Programming', 'CS', 45, 1, 1);";
    $sql .= "INSERT INTO Class VALUES (4, 'Capstone Project', 'CS', 47, 5, 1);";
    $sql .= "INSERT INTO Class VALUES (5, 'Computing Fundamentals II', 'CS', 2, 7, 3);";
    $sql .= "INSERT INTO Class VALUES (6, 'Assmebly Programming', 'CS', 21, 1, 1);";
    $sql .= "INSERT INTO Class VALUES (7, 'Linux Operating System', 'CS', 41, 6, 3);";
    $sql .= "INSERT INTO Class VALUES (8, 'Data Structures', 'CS', 20, 3, 2);";

    $c->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $c -> exec($sql);

?>