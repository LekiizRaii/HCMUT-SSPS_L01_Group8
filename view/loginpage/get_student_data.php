<?php
$hostName = 'localhost';
$userName = 'root';
$password = '';
$database = 'smart_printing';

$conn = @new mysqli( $hostName, $userName, $password, $database);

$conn->error;
if ($conn->error) {
    die("Connection failed: " . $conn->connect_error);
}

$result = $conn->query("SELECT * FROM nguoidung");
$data = array();

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

$conn->close();

echo json_encode($data);
?>
