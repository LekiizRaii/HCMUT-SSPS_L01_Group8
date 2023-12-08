<?php
$hostName = 'localhost';
$userName = 'root';
$password = 'Danh@mysql@23';
$database = 'smart_printing';

$conn = @new mysqli( $hostName, $userName, $password, $database);

$conn->error;
if ($conn->error) {
    die("Connection failed: " . $conn->connect_error);
}
?>