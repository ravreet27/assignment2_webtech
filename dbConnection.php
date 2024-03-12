<?php
$host = 'localhost';
$user = 'root';
$password = ''; 
$database = 'assignment2webtech';

$conn = new mysqli($host, $user, $password, $database);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

echo "Connected to MySQL database";


?>