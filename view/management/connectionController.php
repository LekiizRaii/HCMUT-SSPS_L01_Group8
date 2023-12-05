<?php
function connectPrinter() {
    global $conn1;

    $sql = "UPDATE mayin SET KetNoi = 'Connected', TrangThai = 'Enabled'";

    if ($conn1->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn1->error;
    }
}

if (isset($_POST['connectPrinterButton'])) {
    connectPrinter();
}

$conn1->close();

function disconnectPrinter() {
    global $conn2;
    
    $sql = "UPDATE mayin SET KetNoi = 'Disconnected', TrangThai = NULL";

    if ($conn2->query($sql) === TRUE) {
        echo "Record updated successfully";
    } else {
        echo "Error updating record: " . $conn2->error;
    }
}

if (isset($_POST['disconnectPrinterButton'])) {
    disconnectPrinter();
}

$conn2->close();
?>