<?php
    require_once '../../../models/db_connection.php';
    $conn = DataBase::getInstance();

    if (isset($_GET['id'])) {
        $printerID = $_GET['id'];
        $sqlConnect = "UPDATE `smart_printing`.`mayin` SET KetNoi = 'Connected', TinhTrang = 'Enabled' WHERE ID = '$printerID'";
        $conn->query($sqlConnect);
        header("location: ../../../view/management/managementDefault.php");
    }

    $conn->close();
?>
