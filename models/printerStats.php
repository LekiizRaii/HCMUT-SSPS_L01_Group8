<?php
require_once("../models/db_connection.php");

$conn = DataBase::getInstance();
// Fetch print counts for each day in each month
$sql = "SELECT 
            MayIn.ID, MayIn.Hang, MayIn.Model, COUNT(*) AS SoLuotIn 
        FROM 
            MayIn, InAn 
        WHERE 
            MayIn.ID = InAn.ID_MayIn 
        GROUP BY 
            MayIn.ID";

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
