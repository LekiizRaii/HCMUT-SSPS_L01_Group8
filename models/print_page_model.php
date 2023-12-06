<?php
require_once("../models/db_connection.php");

function get_user_numberofpage($username) {
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

function set_print_state($data) {
    if (!isset($print_state)) {
        $print_state = array();
    }
    $print_state['path'] = $data['file_input'];
    $print_state['numberofcopy'] = $data['numberofcopy'];
    $print_state['numberofpages'] = $data['numberofpages'];
    $print_state['pagesize'] = $data['pagesize'];
    $print_state['orientation'] = $data['orientation'];
    $print_state['twofaced'] = $data['twofaced'];
    $print_state['printer_address'] = $data['printer_address'];
    $print_state['status'] = $data['status'];
    $_SESSION['print_state'] = $print_state;
}

function initialize_print_state() {
    if (!isset($print_state)) {
        $print_state = array();
    }
    $print_state['path'] = '';
    $print_state['numberofcopy'] = 0;
    $print_state['numberofpages'] = 0;
    $print_state['pagesize'] = 'A4';
    $print_state['orientation'] = 'portrait';
    $print_state['twofaced'] = 'true';
    $print_state['printer_address'] = '';
    $print_state['status'] = 'pending';
    $_SESSION['print_state'] = $print_state;
}
?>