<?php
require_once("../models/db_connection.php");

function get_user_numberofpage($username) {
    $conn = DataBase::getInstance();
    $query = "SELECT soluonggiay AS numberofpage FROM NguoiDung WHERE tendangnhap = '$username'";
    $result = $conn->query($query);
    return $result->fetch_assoc()['numberofpage'];
}
?>