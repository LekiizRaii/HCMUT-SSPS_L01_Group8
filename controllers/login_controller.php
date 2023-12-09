<?php
require_once('../models/print_page_model.php');

if ($_GET["action"] == "login") {
    session_start();
    $_SESSION["username"] = $_GET["username"];
    $_SESSION["user_id"] = $_GET["user_id"];
    initialize_print_state();
    header("Location: ../view/homepage/homepage.php");
}
else if ($_GET["action"] == "logout") {
    session_start();
    unset($_SESSION["username"]);
    unset($_SESSION["user_id"]);
    unset($_SESSION["print_state"]);
    session_destroy();
    header("Location: ../view/homepage/homepage.php");
}
?>