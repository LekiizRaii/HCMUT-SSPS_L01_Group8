<?php
require_once('../models/setting_page_model.php');

function validate() {
    $returned_data = array();
    $returned_data['status'] = 'OK';
    $returned_data['error-type'] = '';
    return $returned_data;
}

function save_setting_info() {
    $check = validate();
    if ($check['status'] == 'OK') {
        
    }
}

if ($_GET['action'] == 'validate') {

}
else if ($_GET['action'] == 'save-setting-info') {

}

?>