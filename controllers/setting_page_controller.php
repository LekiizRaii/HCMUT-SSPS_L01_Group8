<?php
require_once('../models/setting_page_model.php');

function validate() {
    $returned_data = array();
    $returned_data['status'] = 'OK';
    $returned_data['error-type'] = '';
    return $returned_data;
}

function save_setting_info() {
    $response = validate();
    if ($response['status'] == 'OK') {
        $data = $_POST;
        $data['saving-date'] = date('Y-m-d');
        insert_setting_info($data);
    }
    header('Content-Type: application/json');
    echo json_encode($response);
}

if ($_GET['action'] == 'validate') {

}
else if ($_GET['action'] == 'save-setting-info') {
    session_start();
    save_setting_info();
}
?>