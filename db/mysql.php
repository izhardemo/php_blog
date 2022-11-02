<?php
    $host = "localhost";
    $user = "root";
    $password = "";
    $db = "blog";
    

    // Create Connection
    $conn = mysqli_connect($host, $user, $password, $db);
    
    // Check Connection
    if(!$conn){
        die("Connection Failed");
    }
?>