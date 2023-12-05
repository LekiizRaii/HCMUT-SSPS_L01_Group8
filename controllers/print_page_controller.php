<?php
// Return data as JSON
$data = $_GET['test'];
header('Content-Type: application/json');
echo json_encode($data);
?>