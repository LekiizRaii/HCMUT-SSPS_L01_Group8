<?php
// File: getprintcounts.php
require_once("../models/db_connection.php");

$conn = DataBase::getInstance();
// Fetch print counts for each day in each month
$sql = "SELECT loaigiay, SUM(sotrang) AS total_sheets
        FROM tailieu
        GROUP BY loaigiay
        ORDER BY total_sheets DESC
        LIMIT 5";

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
