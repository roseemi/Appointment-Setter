<!-- This file connects our data to and from the database -->
<?php
    // Do not close off with a closing tag
    // If there is any whitespace or tabs after the closing tag, it can cause an error
    // Closing is unnecessary when the whole file is php
    $serverName = "localhost";
    $dbUsername = "root";
    $dbPassword = "";
    $dbName = "patient_appointments";

    // Connect to the database: remove or change the port parameter as needed
    $conn = mysqli_connect($serverName, $dbUsername, $dbPassword, $dbName, 3307);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }