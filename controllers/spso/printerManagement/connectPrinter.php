<?php
    require_once '../../../db/db_connection.php';

    if (isset($_GET['id'])) {
        $printerID = $_GET['id'];
        $sqlConnect = "UPDATE `smart_printing`.`mayin` SET KetNoi = 'Connected', TinhTrang = 'Enabled' WHERE ID = '$printerID'";
        $conn->query($sqlConnect);
        $conn->close();
        setcookie('ThongBao', 'Kết nối thành công.', time() + 5);
        header("location: managementDefault.php");
    } else {
        setcookie('ThongBao', 'Kết nối thất bại!', time() + 5);
    }

    $conn->close();
?>
