<?php
    require_once '../../../models/db_connection.php';
    $conn = DataBase::getInstance();

    if (isset($_GET['id'])) {
        $printerID = $_GET['id'];
        $sqlConnect = "UPDATE `smart_printing`.`mayin` SET TinhTrang = 'Enabled' WHERE ID = '$printerID'";
        $conn->query($sqlConnect);
        header("location: ../../../view/management/managementDefault.php");
    }

    $conn->close();
    // require_once '../../../models/db_connection.php';
    // $conn = DataBase::getInstance();

    // if (isset($_GET['id'])) {
    //     $printerID = $_GET['id'];

    //     $sqlSelect = "SELECT KetNoi FROM `smart_printing`.`mayin` WHERE ID = '$printerID'";
    //     $result = $conn->query($sqlSelect);

    //     if ($result->num_rows > 0) {
    //         $row = $result->fetch_assoc();
    //         $ketNoi = $row['KetNoi'];

    //         if ($ketNoi == 'Connected') {
    //             $sqlUpdate = "UPDATE `smart_printing`.`mayin` SET TinhTrang = 'Enabled' WHERE ID = '$printerID'";
    //             $conn->query($sqlUpdate);
    //             $conn->close();
    //             header("location: ../../../view/management/managementDefault.php");
    //         }
    //     } else {
    //         header("location: ../../../view/management/managementDefault.php");
    //     }
    // } else {
    //     header("location: ../../../view/management/managementDefault.php");
    // }

    // $conn->close();
?>
