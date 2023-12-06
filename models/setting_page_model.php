<?php
require_once("../models/db_connection.php");

function insert_setting_info($data) {
    $conn = DataBase::getInstance();
    $query = "INSERT INTO quanlycaidatin(SoGiayMoiHK, ThoiGianCungCap, DinhDangChoPhep, ThoiGianThayDoi) VALUES 
    ({$data['semester-pages']}, '{$data['page-giving-date']}', '{$data['supported-formats']}', '{$data['saving-date']}');";
    $conn->query($query);
}
?>