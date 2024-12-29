<?php
$host = "localhost";  
$user = "root";       
$password = "";       
$dbname = "php_crud";  

$conn = new mysqli($host, $user, $password, $dbname);

// Check for connection errors
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
?>
