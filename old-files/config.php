<?php
    $server = "localhost";
    $username = "root";
    $password = "";
    $dbname = "project_management";

    // Create connection
    $conn = mysqli_connect($server, $username, $password, $dbname);
    // Check connection
    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }
?>