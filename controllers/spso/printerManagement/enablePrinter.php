<?php
    require_once '../../../db/db_connection.php';

    if (isset($_GET['id'])) {
        $printerID = $_GET['id'];

        $sqlSelect = "SELECT KetNoi FROM `smart_printing`.`mayin` WHERE ID = '$printerID'";
        $result = $conn->query($sqlSelect);

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $ketNoi = $row['KetNoi'];

            if ($ketNoi == 'Connected') {
                $sqlUpdate = "UPDATE `smart_printing`.`mayin` SET TinhTrang = 'Enabled' WHERE ID = '$printerID'";
                $conn->query($sqlUpdate);
                $conn->close();
                setcookie('ThongBao', 'Bật máy in thành công.', time() + 5);
                header("location: ../../../view/management/managementDefault.php");
            } else {
                setcookie('ThongBao', 'Máy in này hiện chưa được kết nối với hệ thống!', time() + 5);
                header("location: ../../../view/management/managementDefault.php");
            }
        } else {
            setcookie('ThongBao', 'Không tìm thấy máy in!', time() + 5);
            header("location: ../../../view/management/managementDefault.php");
        }
    } else {
        setcookie('ThongBao', 'Bật máy in thất bại!', time() + 5);
        header("location: ../../../view/management/managementDefault.php");
    }

    $conn->close();
?>
