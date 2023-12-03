<?php
// File: getprintcounts.php

// Connect to the database (replace with your actual database credentials)
$servername = "localhost";
$username = "root";
$password = "Danh@mysql@23";
$dbname = "smart_printing";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$month = $_GET['month'];

// Fetch print counts for each day in each month
$sql = "SELECT     
            DATE(ThoiGian) AS Day,     
            COUNT(*) AS RecordsCount 
        FROM     
            LuotIn 
        WHERE     
            MONTH(ThoiGian) = '$month' 
        GROUP BY     
            DATE(ThoiGian)";

$result = $conn->query($sql);

$data = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
}

// Close the database connection
$conn->close();

// Return data as JSON
header('Content-Type: application/json');
echo json_encode($data);
?>
