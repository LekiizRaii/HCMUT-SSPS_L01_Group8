<?php
require_once('../models/print_page_model.php');

function validate() {
    $response = array();
    if ($_POST['path'] == '') {
        $response['status'] = 'ERROR';
        $response['error-type'] = 'FILE';
    }
    else if ($_POST['numberofcopy'] == '') {
        $response['status'] = 'ERROR';
        $response['error-type'] = 'COPY-NUMBER';
    }
    else if (!preg_match("/^[1-9][0-9]*$/i", $_POST['numberofcopy'])) {
        $response['status'] = 'ERROR';
        $response['error-type'] = 'COPY-FORMAT';
    }
    else if ($_POST['numberofpages'] == '') {
        $response['status'] = 'ERROR';
        $response['error-type'] = 'PAGE-NUMBER';
    }
    else if ($_POST['numberofpages'] != 'All'
             and !preg_match("/^[1-9][0-9]*$/i", $_POST['numberofpages'])
             and !preg_match("/^[1-9][0-9]*-[1-9][0-9]*$/i", $_POST['numberofpages'])
             and !preg_match("/^[1-9][0-9]*-[1-9][0-9]*-[1-9][0-9]*$/i", $_POST['numberofpages'])) {
            $response['status'] = 'ERROR';
            $response['error-type'] = 'PAGE-FORMAT';
    }
    else {
        //
        $username = $_SESSION["username"];
        //
        $flag = TRUE;
        $numberofpages = 0;
        $pagestr = '';
        if ($_POST['numberofpages'] == 'All') {
            for ($i = 1; $i <= 12; $i += 1) {
                $numberofpages += 1;
                $pagestr = $pagestr.strval($i).',';
            }
        }
        else {
            $val_list = explode('-', $_POST['numberofpages']);
            $len = count($val_list);
            $step = 0;
            if ($len < 3) {
                $step = 1;
                if ($len == 1) {
                    for($i = 1; $i <= (int)$val_list[0]; $i += $step) {
                        $numberofpages += 1;
                        $pagestr = $pagestr.strval($i).',';
                    }
                }
                else {
                    if ((int)$val_list[1] >= (int)$val_list[0]) {
                        for($i = (int)$val_list[0]; $i <= (int)$val_list[1]; $i += $step) {
                            $numberofpages += 1;
                            $pagestr = $pagestr.strval($i).',';
                        }
                    }
                    else {
                        $flag = FALSE;
                        $response['status'] = 'ERROR';
                        $response['error-type'] = 'PAGE-LOGIC';
                    }
                }
            }
            else {
                if ((int)$val_list[1] >= (int)$val_list[0]) {
                    $step = (int)$val_list[2];
                    for($i = (int)$val_list[0]; $i <= (int)$val_list[1]; $i += $step) {
                        $numberofpages += 1;
                        $pagestr = $pagestr.strval($i).',';
                    }   
                }
                else {
                    $flag = FALSE;
                    $response['status'] = 'ERROR';
                    $response['error-type'] = 'PAGE-LOGIC';
                }
            }      
        }
        if ($flag) {
            $user_numberofpage = get_user_numberofpage($username);
            $normalized_numberofpage = 0;
            if ($_POST["pagesize"] == 'A4') {
                $normalized_numberofpage = $numberofpages * (int)$_POST['numberofcopy'];
            }
            else if ($_POST["pagesize"] == 'A3') {
                $normalized_numberofpage = 2 * $numberofpages * (int)$_POST['numberofcopy'];
            }
            
            if ($_POST['twofaced'] == 'true') {
                $normalized_numberofpage = ceil($normalized_numberofpage / 2);
            }

            if ($user_numberofpage < $normalized_numberofpage) {
                $response['status'] = 'ERROR';
                $response['error-type'] = 'USER';
            }
            else {
                $response['status'] = 'OK';
                $response['error-type'] = '';

                $data = $_POST;
                $data['numberofpages'] = $numberofpages;
                $data['numberofpages-format'] = $_POST['numberofpages'];
                $data['printer_id'] = '';
                $data['printer_address'] = '';
                $data['status'] = 'Working';
                set_print_state($data);
            }
        }
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function show_printer_list() {
    //
    $username = $_SESSION["username"];
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

function do_print() {
    $response = 'OK';
    $data = $_SESSION['print_state'];
    //
    $print_status = TRUE;
    $user_id = $_SESSION["user_id"];
    $user_name = $_SESSION["username"];
    //
    $data['time'] = date("Y-m-d h:i:s");
    $data['user-id'] = $user_id;
    $data['printer_address'] = $_POST['printer_address'];
    $data['printer_id'] = $_POST['printer_id'];
    if ($print_status) {
        $files = glob('../uploads/*');
        foreach ($files as $file) {
            if(is_file($file)) {
                unlink($file);
            }
        }
        $data['status'] = 'In thành công';
        set_print_state($data);
        insert_print_history($data);
        modify_print_info($data);
    }
    else {
        $data['status'] = 'Error';
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

function upload_file() {
    $response = array();
    if(isset($_FILES['file-properties']['name'])) {
        // file name
        $filename = $_FILES['file-properties']['name'];
     
        // Location
        $location = "../uploads/".$filename;
     
        // file extension
        $file_extension = pathinfo($location, PATHINFO_EXTENSION);
        $file_extension = strtolower($file_extension);
     
        // Valid extensions
        $format_str = get_file_format();
        $format_str = strtolower($format_str);
        $valid_ext = explode(",", $format_str);
     
        if(in_array($file_extension,$valid_ext)){
            // Upload file
            if(move_uploaded_file($_FILES['file-properties']['tmp_name'],$location)) {
            $response['status'] = 'OK';
            $response['error-type'] = '';
            }
        }
        else {
            $response['status'] = 'ERROR';
            $response['error-type'] = 'SYSTEM';
        }
    } 
    header('Content-Type: application/json');
    echo json_encode($response);
}

function load_file_format() {
    $format_str = get_file_format();
    $response = explode(",", $format_str);
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
else if ($_GET['action'] == 'do-print') {
    session_start();
    do_print();
}
else if ($_GET['action'] == 'upload') {
    session_start();
    upload_file();
}
else if ($_GET['action'] == 'load-format') {
    session_start();
    load_file_format();
}
?>
