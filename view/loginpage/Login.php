<?php
session_start();
ob_start();

// Connect to the database (replace with your actual database credentials)
$servername = "localhost:3307";
$username = "root";
$dbpassword = "";
$dbname = "smart_printing";

$conn = new mysqli($servername, $username, $dbpassword, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT TenDangNhap, Password FROM quantrivien";
// $sql = "SELECT TenDangNhap FROM quantrivien";
$ketqua = $conn->query($sql);
?>

<?php
require("validate.php");
$TenDangNhap = '';
$Password = '';
$ThongBao = '';

if (isset($_POST['login_user'])) {
    $is_validated = true;
    $errorTenDangNhap = $errorPassword = "";
    $TenDangNhap = $_POST['TenDangNhap'];
    $Password = $_POST['Password'];

    if ($TenDangNhap == "" || $Password == "") {
        $is_validated = false;
        $ThongBao = "Vui lòng nhập các ô còn thiếu";
    }

    if (checkTenDangNhapExist($TenDangNhap) == "") {
        $is_validated = false;
        $errorTenDangNhap = "TenDangNhap không tồn tại";
    }

    while ($row = $ketqua->fetch_assoc()) {
        //   if ($row["TenDangNhap"] == $TenDangNhap && password_verify($Password, $row["Password"])) {
        if ($row["TenDangNhap"] == $TenDangNhap && $Password === $row["Password"]) {
            $_SESSION["TenDangNhap_user"] = $TenDangNhap;
            header('location: ../homepage/homepage.php');
            $is_validated = true;
        } else {
            $is_validated = false;
            $ThongBao = 'Sai TenDangNhap hoặc mật khẩu';
        }
    }

    if ($is_validated) {
        $_SESSION["TenDangNhap_user"] = $TenDangNhap;
        header('location: ../homepage/homepage.php');
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Đăng Nhập</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />

    <!-- Dark mode -->
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
</head>

<body class="bg-gray-100 dark:bg-gray-900">
    <nav class="bg-white border-gray-200 dark:bg-gray-900">
        <div class="max-w-screen-full flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="../homepage/homepage.php" class="ml-5 flex items-center space-x-3 rtl:space-x-reverse">
                <img src="../img/hcmut.png" class="h-8" alt="HCMUT Logo" />
                <div class="ml-4">
                    <div class="self-center text-base font-semibold whitespace-nowrap dark:text-white">Trường Đại học Bách Khoa - ĐHQG TP.HCM</div>
                    <div class="self-center text-sm whitespace-nowrap dark:text-white">Student Smart Printing Service</div>
                </div>
            </a>
            <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <!-- Dark mode -->
                <button id="theme-toggle" type="button" class=" mr-3 dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                        <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>
                <div class="flex items-center ml-3 mr-4" id="nav__login">
                    <button id="nav__login__button" type="button" class="mr-7 w-30 text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium font-bold rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" style="font-family: Montserrat;
                        font-weight: 900;">
                        ĐĂNG NHẬP
                    </button>
                </div>
            </div>
        </div>
    </nav>

    <section class="mx-auto bg-gray-100 dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-6 grid lg:grid-cols-1 gap-8 lg:gap-7">
            <h1 class="text-3xl font-bold text-black dark:text-white m-auto w-full lg:max-w-xl space-y-0">Đăng nhập</h1>
            <div>
                <div class="m-auto w-full lg:max-w-xl p-6 sm:pt-14 sm:pl-20 sm:pr-16 bg-white rounded-lg shadow-xl dark:bg-gray-800">
                    <h3 class="text-base font-semibold text-gray-900 dark:text-white">
                        Đăng nhập để sử dụng dịch vụ SPSS
                    </h3>
                    <h2 class="text-4xl font-bold text-gray-900 dark:text-white">
                        Đăng nhập vào SPSS
                    </h2>
                    <form class="mt-8 space-y-6" action="<?php echo $_SERVER['PHP_SELF'] ?>" accept-charset="UTF-8" method="post">
                        <div>
                            <label for="username" class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Tên đăng nhập</label>
                            <input type="text" name="TenDangNhap" value="<?php echo $TenDangNhap; ?>" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nhập tên đăng nhập của bạn" required>
                        </div>
                        <div>
                            <label for="password" class="block mb-2 text-base font-medium text-gray-900 dark:text-white">Mật khẩu</label>
                            <input type="password" name="Password" value="<?php echo $Password; ?>" placeholder="6+ ký tự, 1 ký tự in hoa" class="form-control bg-gray-50 border border-gray-300 text-gray-900 text-base rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" required>
                        </div>
                        <?php
                        if (!empty($ThongBao)) {
                            echo '<div class="alert alert-danger">' . $ThongBao . '</div>';
                        } else if (!empty($errorTenDangNhap)) {
                            echo '<div class="alert alert-danger">' . $errorTenDangNhap . '</div>';
                        } else if (!empty($errorPassword)) {
                            echo '<div class="alert alert-danger">' . $errorPassword . '</div>';
                        }
                        ?>
                        <div class="flex flex-col justify-center">
                            <button type="submit" class="login_user text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-base w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Đăng nhập</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    <script src="../navbar/darkmode.js"></script>
</body>