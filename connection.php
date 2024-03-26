<?php
    // Server details
    $server = "localhost";
    $username = "root";
    $password = "";
    $database = "library1";

    // Create a connection
    $db = mysqli_connect($server, $username, $password, $database);

    // Check connection
    if (!$db) {
        die("Connection failed: " . mysqli_connect_error());
    }
