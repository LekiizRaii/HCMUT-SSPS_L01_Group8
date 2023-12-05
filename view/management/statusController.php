<?php
function enablePrinter() {
    global $conn1;

    $sql = "UPDATE mayin SET TrangThai = 'Enabled'";

    if ($conn1->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn1->error;
    }
}

if (isset($_POST['EnablePrinterButton'])) {
    enablePrinter();
}

$conn1->close();

function disablePrinter() {
    global $conn2;
    
    $sql = "UPDATE mayin SET TrangThai = 'Disabled'";

    if ($conn2->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn2->error;
    }
}

if (isset($_POST['disablePrinterButton'])) {
    disablePrinter();
}

$conn2->close();
?>