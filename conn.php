<?php
    $host = "localhost";
    $passwd = "megane";
    $db = "authentication";
    $user = "root";

    
    $conn = mysqli_connect($host,$user,$passwd,$db);
    if(!$conn){
        die("connection error");
        echo "fail";
    }
    // var_dump($conn);
    // die();
?>