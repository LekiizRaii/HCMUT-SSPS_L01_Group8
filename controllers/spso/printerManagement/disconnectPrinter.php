<?php
    require_once '../../../db/db_connection.php';

    if (isset($_GET['id'])) {
        $printerID = $_GET['id'];
        $sqlConnect = "UPDATE `smart_printing`.`mayin` SET KetNoi = 'Disconnected', TinhTrang = NULL WHERE ID = '$printerID'";
        $conn->query($sqlConnect);
        $conn->close();
        setcookie('ThongBao', 'Ngắt kết nối thành công.', time() + 5);
        header("location: ../../../view/management/managementDefault.php");
    } else {
        setcookie('ThongBao', 'Ngắt kết nối thất bại!', time() + 5);
    }

    $conn->close();
?>
