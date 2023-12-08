<?php
function get_user_ID($username) {
    $conn = DataBase::getInstance();
    $query = "SELECT ID AS userID FROM NguoiDung WHERE tendangnhap = '$username'";
    $result = $conn->query($query);
    return $result->fetch_assoc()['userID'];
}

function get_history_student($username, $startdate, $enddate) {
    //normalize the date format
    $dateTime = DateTime::createFromFormat('m/d/Y', $startdate);
    $outputStartDate = $dateTime->format('Y-m-d');
    $dateTime = DateTime::createFromFormat('m/d/Y', $enddate);
    $outputEndDate = $dateTime->format('Y-m-d');
    
    $conn = DataBase::getInstance();
    $query = "SELECT
                    tailieu.ten AS document_name,
                    tailieu.sotrang AS document_page,
                    tailieu.soban AS document_copy,
                    tailieu.loaigiay AS document_size,
                    inan.id_luotin AS printing_session_id,
                    luotin.thoigian AS printTime,
                    luotin.tinhtrang AS printStatus,
                    mayin.id AS printer_id,
                    nguoidung.tendangnhap AS user_name
                FROM
                    nguoidung
                JOIN
                    inan ON nguoidung.id = inan.id_nguoidung
                JOIN
                    mayin ON inan.id_mayin = mayin.id
                JOIN
                    tailieu ON inan.id_luotin = tailieu.id_luotin
                JOIN
                    luotin ON inan.id_luotin = luotin.id AND luotin.thoigian BETWEEN '$outputStartDate' AND '$outputEndDate'
                WHERE
                    nguoidung.tendangnhap = '$username'";

    $result = $conn->query($query);
    return $result;
}

function get_history_SPSO($ID, $printerID, $startdate, $enddate) {
    //normalize the date format
    $dateTime = DateTime::createFromFormat('m/d/Y', $startdate);
    $outputStartDate = $dateTime->format('Y-m-d');
    $dateTime = DateTime::createFromFormat('m/d/Y', $enddate);
    $outputEndDate = $dateTime->format('Y-m-d');

    $query = "";
    
    $conn = DataBase::getInstance();
    if ($ID == "") {
        $query = "SELECT
                    tailieu.ten AS document_name,
                    tailieu.sotrang AS document_page,
                    tailieu.soban AS document_copy,
                    tailieu.loaigiay AS document_size,
                    inan.id_luotin AS printing_session_id,
                    luotin.thoigian AS printTime,
                    luotin.tinhtrang AS printStatus,
                    mayin.id AS printer_id,
                    nguoidung.id AS user_id
                FROM
                    mayin
                JOIN
                    inan ON mayin.id = inan.id_mayin
                JOIN
                    nguoidung ON inan.id_nguoidung = nguoidung.id
                JOIN
                    tailieu ON inan.id_luotin = tailieu.id_luotin
                JOIN
                    luotin ON inan.id_luotin = luotin.id AND luotin.thoigian BETWEEN '$outputStartDate' AND '$outputEndDate'
                WHERE
                    mayin.id = '$printerID'";
    }

    else if ($printerID == "") {
        $query = "SELECT
                    tailieu.ten AS document_name,
                    tailieu.sotrang AS document_page,
                    tailieu.soban AS document_copy,
                    tailieu.loaigiay AS document_size,
                    inan.id_luotin AS printing_session_id,
                    luotin.thoigian AS printTime,
                    luotin.tinhtrang AS printStatus,
                    mayin.id AS printer_id,
                    nguoidung.id AS user_id
                FROM
                    nguoidung
                JOIN
                    inan ON nguoidung.id = inan.id_nguoidung
                JOIN
                    mayin ON inan.id_mayin = mayin.id
                JOIN
                    tailieu ON inan.id_luotin = tailieu.id_luotin
                JOIN
                    luotin ON inan.id_luotin = luotin.id AND luotin.thoigian BETWEEN '$outputStartDate' AND '$outputEndDate'
                WHERE
                    nguoidung.id = '$ID'";
    }

    $result = $conn->query($query);
    return $result;
}



?>
