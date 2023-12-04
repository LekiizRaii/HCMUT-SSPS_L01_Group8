<?php
session_start();
ob_start();
unset($_SESSION["TenDangNhap_user"]);
header('location: login.php');
?>