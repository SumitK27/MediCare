<?php
	ob_start();         // Turns on Output Buffering
    session_start();    // Recognize if user is logged in
    
    date_default_timezone_set("Asia/Kolkata");   // Set default timezone

    $host = 'localhost';
    $user = 'root';
    $password = '';
    $database = 'experteze';
    
	try {
        $conn = new PDO("mysql:dbname=$database;host=$host", $user, $password); // PhpDaterObject
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);  // Set error porting of database
    } catch (PDOException $e) {
        exit("Connection failed: " . $e->getMessage());
    }
    // echo "Successfully connected to $database database \n";
?>