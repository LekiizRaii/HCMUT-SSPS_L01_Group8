<?php
require_once("../models/db_connection.php");

function get_user_numberofpage($username) {
    if ($_SESSION['user_role'] == 'SPSO') {
        return 1000000;
    }
    $conn = DataBase::getInstance();
    $query = "SELECT soluonggiay AS numberofpage FROM NguoiDung WHERE tendangnhap = '$username'";
    $result = $conn->query($query);
    return $result->fetch_assoc()['numberofpage'];
}

function get_printer_list($print_numberofpage, $pagesize) {
    $conn = DataBase::getInstance();
    $query = '';
    if ($pagesize == 'A4') {
        $query = "SELECT * FROM mayin WHERE tinhtrang = 'Enabled' AND sogiayA4 >= $print_numberofpage";
    }
    else {
        $query = "SELECT * FROM mayin WHERE tinhtrang = 'Enabled' AND sogiayA3 >= $print_numberofpage";
    }
    $result = $conn->query($query);
    return $result;
}

function insert_print_history($data) {
    $conn = DataBase::getInstance();
    $query = '';

    $query = "SELECT MAX(STT) AS maxstt FROM luotin";
    $result = $conn->query($query);
    $idluotin = "LI".strval((int)($result->fetch_assoc()['maxstt']) + 1);

    $query = "INSERT INTO luotin(ID, ThoiGian, TinhTrang) VALUES ('$idluotin', '{$data['time']}', '{$data['status']}');";
    $conn->query($query);

    $query = "INSERT INTO inan(ID_LuotIn, ID_MayIn, ID_NguoiDung) VALUES ('$idluotin', '{$data['printer_id']}', '{$data['user-id']}');";
    $conn->query($query);

    $query = "INSERT INTO tailieu(Ten, ID_LuotIn, SoTrang, SoBan, LoaiGiay, QRCode, SttHangDoi) 
              VALUES ('{$data['file-name']}', '$idluotin', {$data['numberofpages']}, {$data['numberofcopy']},
                      '{$data['pagesize']}', '', 0);";
    $conn->query($query);
}

function modify_print_info($data) {
    $conn = DataBase::getInstance();
    $query = '';

    if ($_SESSION['user_role'] != 'SPSO') {
        $query = "SELECT soluonggiay AS numberofpage FROM NguoiDung WHERE ID = '{$data['user-id']}'";
        $result = $conn->query($query);
        $user_numberofpage = (int)$result->fetch_assoc()['numberofpage'];
        if ($data['pagesize'] == 'A4') {
            $user_numberofpage -= (int)$data['numberofpages'];
        }
        else {
            $user_numberofpage -= (int)$data['numberofpages'] * 2;
        }

        $query = "UPDATE NguoiDung SET soluonggiay = $user_numberofpage WHERE ID = '{$data['user-id']}';";
        $conn->query($query);
    }

    if ($data['pagesize'] == 'A4') {
        $query = "SELECT SoGiayA4 AS numberofpage FROM mayin WHERE ID = '{$data['printer_id']}'";
    }
    else {
        $query = "SELECT SoGiayA3 AS numberofpage FROM mayin WHERE ID = '{$data['printer_id']}'";
    }
    $result = $conn->query($query);
    $printer_numberofpage = (int)$result->fetch_assoc()['numberofpage'];
    $printer_numberofpage -= (int)$data['numberofpages'];

    if ($data['pagesize'] == 'A4') {
        $query = "UPDATE mayin SET SoGiayA4 = $printer_numberofpage WHERE ID = '{$data['printer_id']}';";
    }
    else {
        $query = "UPDATE mayin SET SoGiayA3 = $printer_numberofpage WHERE ID = '{$data['printer_id']}';";
    }
    $conn->query($query);
}

function set_print_state($data) {
    if (!isset($print_state)) {
        $print_state = array();
    }
    $print_state['path'] = $data['path'];

    $val_list = explode("\\", $print_state['path']);
    $len = count($val_list);
    $print_state['file-name'] = $val_list[$len - 1];
    
    $print_state['numberofcopy'] = $data['numberofcopy'];
    $print_state['numberofpages'] = $data['numberofpages'];
    $print_state['numberofpages-format'] = $data['numberofpages-format'];
    $print_state['pagesize'] = $data['pagesize'];
    $print_state['orientation'] = $data['orientation'];
    $print_state['twofaced'] = $data['twofaced'];
    $print_state['printer_id'] = $data['printer_id'];
    $print_state['printer_address'] = $data['printer_address'];
    $print_state['status'] = $data['status'];
    $_SESSION['print_state'] = $print_state;
}

function get_file_format() {
    $conn = DataBase::getInstance();
    $query = '';

    $query = "SELECT dinhdangchophep AS format FROM quanlycaidatin 
              WHERE STT = (SELECT MAX(STT) FROM quanlycaidatin);";
    $result = $conn->query($query);
    return $result->fetch_assoc()['format'];
}

function initialize_print_state() {
    if (!isset($print_state)) {
        $print_state = array();
    }
    $print_state['path'] = '';
    $print_state['file-name'] = '';
    $print_state['numberofcopy'] = 0;
    $print_state['numberofpages'] = 0;
    $print_state['numberofpages-format'] = 'All';
    $print_state['pagesize'] = 'A4';
    $print_state['orientation'] = 'portrait';
    $print_state['twofaced'] = 'true';
    $print_state['printer_id'] = '';
    $print_state['printer_address'] = '';
    $print_state['status'] = 'Not-set';
    $_SESSION['print_state'] = $print_state;
}
?>