<?php

$db_host = "localhost";
$db_user = "root";
$db_password = "Damaldo0203#";
$db_name = "e_commerce";

// Create connection
$conn = new mysqli($db_host, $db_user, $db_password, $db_name);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

?>
