<?php
function checkTenDangNhapExist($TenDangNhap) {
    $conn = @new mysqli("localhost", "root", "", "smart_printing");
    $conn->error;
    if ($conn->error) {
        die('Kết nối thất bại'.$conn->error);
    }
    $error = "";
    $sql = "SELECT TenDangNhap FROM user WHERE TenDangNhap='$TenDangNhap'";
    $user = $conn->query($sql);
    if ($user->num_rows > 0) {
        $error = "TenDangNhap đã tồn tại.";
    }
    return $error;
}
?>