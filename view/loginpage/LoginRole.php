<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $TenDangNhap = $_POST["TenDangNhap"];
    $Password = $_POST["Password"];

    if (!empty($TenDangNhap) && !empty($Password)) {
        $actor = $_GET["actor"];

        $loginPage = "";

        // Define the login page path based on the extracted actor role
        if ($actor === "student") {
            $_SESSION['idRole'] = 1;
            $loginPage = "../homepage/homepage.php";
        } elseif ($actor === "SPSO") {
            $_SESSION['idRole'] = 2;
            $loginPage = "../homepage/homepage.php";
        }

        // Redirect to the corresponding login page
        header("Location: $loginPage");
        exit();
    } else {
        // Display an alert or perform other error handling if there are missing fields
        echo "<script>alert('Vui lòng điền đầy đủ thông tin.');</script>";
    }
}
?>