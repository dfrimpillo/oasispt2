<?php
error_reporting(E_ALL);
ini_set('display_errors', true);


    $serverName = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "oasis";

    $conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName);

    if (!$conn){
        die("Connection failed: " . mysqli_connect_error());
    }