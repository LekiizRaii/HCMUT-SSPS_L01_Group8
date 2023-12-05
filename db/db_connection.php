<?php
$hostName = 'localhost:3307';
$userName = 'root';
$password = '';
$database = 'smart_printing';

$conn = @new mysqli( $hostName, $userName, $password, $database);

$conn->error;
if ($conn->error) {
    die("Connection failed: " . $conn->connect_error);
}
?>