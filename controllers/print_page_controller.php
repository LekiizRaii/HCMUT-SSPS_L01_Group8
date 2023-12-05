<?php
require_once('../models/print_page_model.php');

function validate() {
    $response = array();
    $response['status'] = 'OK';
    $username = 'B.Tran';
    $user_numberofpage = get_user_numberofpage($username);
    $print_numberofpage = 0;
    if ($_POST["pagesize"] == 'A4') {
        $print_numberofpage = (int)$_POST['numberofpages'] * (int)$_POST['numberofcopy'];
    }
    else if ($_POST["pagesize"] == 'A3') {
        $print_numberofpage = 2 * (int)$_POST['numberofpages'] * (int)$_POST['numberofcopy'];
    }
    else if ($_POST["pagesize"] == 'A2') {
        $print_numberofpage = 4 * (int)$_POST['numberofpages'] * (int)$_POST['numberofcopy'];
    }
    else if ($_POST["pagesize"] == 'A1') {
        $print_numberofpage = 8 * (int)$_POST['numberofpages'] * (int)$_POST['numberofcopy'];
    }
    else if ($_POST["pagesize"] == 'A0') {
        $print_numberofpage = 16 * (int)$_POST['numberofpages'] * (int)$_POST['numberofcopy'];
    }
    if ($_POST['twofaced'] == 'twofaced') {
        $print_numberofpage = ceil($print_numberofpage / 2);
    }

    if ($user_numberofpage < $print_numberofpage) {
        $response['status'] = 'PAGE';
    }
    else {
        $response['status'] = 'OK';
    }
    $response['info'] = '';
    header('Content-Type: application/json');
    echo json_encode($response);
}

if ($_GET['action'] == 'validate') {
    validate();
}
?>
