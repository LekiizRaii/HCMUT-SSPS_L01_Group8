<?php
require_once('../models/print_page_model.php');

function validate() {
    //
    $username = 'B.Tran';
    //
    $response = array();
    $response['status'] = 'OK';
    $user_numberofpage = get_user_numberofpage($username);
    $normalized_numberofpage = 0;
    if ($_POST["pagesize"] == 'A4') {
        $normalized_numberofpage = (int)$_POST['numberofpages'] * (int)$_POST['numberofcopy'];
    }
    else if ($_POST["pagesize"] == 'A3') {
        $normalized_numberofpage = 2 * (int)$_POST['numberofpages'] * (int)$_POST['numberofcopy'];
    }
    
    if ($_POST['twofaced'] == 'true') {
        $normalized_numberofpage = ceil($normalized_numberofpage / 2);
    }

    if ($user_numberofpage < $normalized_numberofpage) {
        $response['status'] = 'PAGE';
    }
    else {
        $response['status'] = 'OK';
        $data = $_POST;
        $data['printer_address'] = '';
        $data['status'] = 'pending';
        initialize_print_state();
        set_print_state($data);
    }
    $response['info'] = '';
    header('Content-Type: application/json');
    echo json_encode($response);
}

function show_printer_list() {
    //
    $username = 'B.Tran';
    //
    $print_state = $_SESSION['print_state'];
    $print_numberofpage = (int)$print_state['numberofcopy'] * (int)$print_state['numberofpages'];
    $pagesize = $print_state['pagesize'];
    $result = get_printer_list($print_numberofpage, $pagesize);
    $response = array();
    $response['pagesize'] = $pagesize;
    $response['user_numberofpage'] = get_user_numberofpage($username);
    $response['list-of-printer'] = array();
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $response['list-of-printer'][] = $row;
        }
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

if ($_GET['action'] == 'validate') {
    session_start();
    validate();
}
else if ($_GET['action'] == 'show-printer-list') {
    session_start();
    show_printer_list();
}
?>
