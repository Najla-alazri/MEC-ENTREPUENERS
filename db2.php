<?php
$servername = "localhost"; // Change this if your server is different
$username = "root"; // Change this to your database username
$password = ""; // Change this to your database password
$dbname = "products"; 

// Create connection
$con2 = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($con2->connect_error) {
    die("Connection failed: " . $con2->connect_error);
}
?>
