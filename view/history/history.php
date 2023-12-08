<?php
session_start();
ob_start();

$rootPath = '/HCMUT-SSPS_L01_Group8';
require_once("../../models/db_connection.php");
require_once('../../models/historyFetch.php');

$username = "A.Nguyen";
$countFlag = true;

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>History Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js"></script>

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

<body class="bg-gray-100 :dark:bg-gray-900">
    <nav class="bg-white border-gray-200 :dark:bg-gray-900">
        <div class="max-w-screen-full flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="../homepage/homepage.php" class="ml-5 flex items-center space-x-3 rtl:space-x-reverse">
                <img src="../img/hcmut.png" class="h-8" alt="HCMUT Logo" />
                <div class="ml-4">
                    <div class="self-center text-base font-semibold whitespace-nowrap :dark:text-white">Trường Đại học 
                        Bách Khoa - ĐHQG TP.HCM</div>
                    <div class="self-center text-sm whitespace-nowrap :dark:text-white">Student Smart Printing Service
                    </div>
                </div>
            </a>
            <div class="flex items-center md:order-2 space-x-3 md:space-x-0 rtl:space-x-reverse">
                <!-- Dark mode -->
                <button id="theme-toggle" type="button"
                    class=" mr-3 :dark:text-white hover:bg-gray-100 :dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 :dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                    </svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path
                            d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z"
                            fill-rule="evenodd" clip-rule="evenodd"></path>
                    </svg>
                </button>
                <div class="flex items-center ml-3 mr-4" id="nav__user">
                    <button class="mr-5">
                        <svg class="w-6 h-6 text-gray-800 :dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 21">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M10 3.464V1.1m0 2.365a5.338 5.338 0 0 1 5.133 5.368v1.8c0 2.386 1.867 2.982 1.867 4.175C17 15.4 17 16 16.462 16H3.538C3 16 3 15.4 3 14.807c0-1.193 1.867-1.789 1.867-4.175v-1.8A5.338 5.338 0 0 1 10 3.464ZM1.866 8.832a8.458 8.458 0 0 1 2.252-5.714m14.016 5.714a8.458 8.458 0 0 0-2.252-5.714M6.54 16a3.48 3.48 0 0 0 6.92 0H6.54Z" />
                        </svg>
                    </button>
                    <button class="mr-5">
                        <svg class="w-6 h-6 text-gray-800 :dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z" />
                        </svg>
                    </button>
                    <div class="mr-0.5">
                        <div class="self-center text-right text-base font-semibold whitespace-nowrap :dark:text-white">
                            Danh Hoang</div>
                        <div class="self-center text-right text-sm whitespace-nowrap :dark:text-white"
                            id="user__student">Sinh viên</div>
                        <div class="self-center text-right text-sm whitespace-nowrap :dark:text-white" id="user__SPSO">
                            SPSO</div>
                    </div>
                    <button id="dropdownInformationButton" aria-expanded="false" data-dropdown-toggle="dropdown-user"
                        class="ml-1 mr-4 :dark:text-white bg-white focus:ring-4 focus:outline-none focus:bg-blue-500 focus:ring-blue-600 font-medium rounded-lg text-sm px-1 py-1 text-center inline-flex items-center :dark:bg-gray-900 :dark:hover:bg-blue-500 :dark:focus:ring-blue-600"
                        type="button">
                        <img class="w-10 h-10 rounded-full"
                            src="https://flowbite.com/docs/images/people/profile-picture-5.jpg" alt="user photo">
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 4 4 4-4" />
                        </svg>
                    </button>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow :dark:bg-gray-700 :dark:divide-gray-600"
                        id="dropdown-user">
                        <!-- <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900 :dark:text-white" role="none">
                                Danh Hoang
                            </p>
                            <p class="text-sm font-medium text-gray-900 truncate :dark:text-gray-300" role="none">
                                name@flowbite.com
                            </p>
                        </div> -->
                        <ul class="py-1" role="none">
                            <li>
                                <a href="#" data-modal-target="default-modal" data-modal-toggle="default-modal"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 :dark:text-gray-300 :dark:hover:bg-gray-600 :dark:hover:text-white"
                                    id="userinfo" role="menuitem">Thông tin tài khoản</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 :dark:text-gray-300 :dark:hover:bg-gray-600 :dark:hover:text-white"
                                    id="signout" role="menuitem">Đăng xuất</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </nav>

    <div id="default-modal" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow :dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t :dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 :dark:text-white">
                        Thông tin tài khoản
                    </h3>
                    <button id="closeBtn" type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center :dark:hover:bg-gray-600 :dark:hover:text-white"
                        data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-4 md:p-5 space-y-4">
                    <div id="userModal"
                        class="grid grid-cols-3 gap-4 p-6 mb-6 border border-gray-200 rounded-lg shadow :dark:bg-gray-800 :dark:border-gray-700">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <section class="bg-gray-100 :dark:bg-gray-900">
        <h1 class="mt-4 text-3xl font-bold text-black :dark:text-white ml-4 xl:ml-36">Lịch sử in</h1>
        <div class="py-8 px-4 mx-auto max-w-screen-lg lg:py-6 grid lg:grid-cols-1 gap-8 lg:gap-7">
            <div id="history1">
                <div class="m-auto w-full lg:max-w-full p-6 bg-white rounded-lg shadow-xl :dark:bg-gray-800">
                    <div class="flex flex-row">
                        <form method="post">
                            <div date-rangepicker class="flex items-center">
                                <span class="mx-4 text-gray-500">From</span>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 :dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </div>
                                    <input id="startDate" name="start" type="text"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  :dark:bg-gray-700 :dark:border-gray-600 :dark:placeholder-gray-400 :dark:text-white :dark:focus:ring-blue-500 :dark:focus:border-blue-500"
                                        placeholder="dd/mm/yyyy">
                                </div>
                                <span class="mx-4 text-gray-500">To</span>
                                <div class="relative">
                                    <div class="absolute inset-y-0 start-0 flex items-center ps-3 pointer-events-none">
                                        <svg class="w-4 h-4 text-gray-500 :dark:text-gray-400" aria-hidden="true"
                                            xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                            <path
                                                d="M20 4a2 2 0 0 0-2-2h-2V1a1 1 0 0 0-2 0v1h-3V1a1 1 0 0 0-2 0v1H6V1a1 1 0 0 0-2 0v1H2a2 2 0 0 0-2 2v2h20V4ZM0 18a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2V8H0v10Zm5-8h10a1 1 0 0 1 0 2H5a1 1 0 0 1 0-2Z" />
                                        </svg>
                                    </div>
                                    <input id="endDate" name="end" type="text"
                                        class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full ps-10 p-2.5  :dark:bg-gray-700 :dark:border-gray-600 :dark:placeholder-gray-400 :dark:text-white :dark:focus:ring-blue-500 :dark:focus:border-blue-500"
                                        placeholder="dd/mm/yyyy">
                                </div>
                                <button type="submit" class="p-2.5 ms-2 text-sm font-medium text-white bg-blue-700 rounded-lg border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg class="w-4 h-4" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z"/>
                                    </svg>
                                </button>
                            </div>
                        </form>
                        <h2 class="ms-auto me-3 font-medium text-xl">ID: <?php echo get_user_ID($username) ?></h2>
                    </div>
                    <hr class="m-auto w-full lg:max-w-full my-3 border-zinc-400">
                    <div class="flex flex-col items-center relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-lg text-left rtl:text-right text-gray-500 :dark:text-gray-400">
                            <thead class="text-base text-gray-700 bg-gray-50 :dark:bg-gray-700 :dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-4 py-3 text-center">
                                        Tên File
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-center">
                                        ID Máy in
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-center">
                                        Bắt đầu
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-center">
                                        Kết thúc
                                    </th>
                                    <th scope="col" class="px-4 py-3 text-center">
                                        Trạng thái
                                    </th>

                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                                        $count = 1;
                                        $startDate = $_POST["start"];
                                        $endDate = $_POST["end"];
                                        $data = get_history_student($username, $startDate, $endDate);
                                        while ($row = mysqli_fetch_assoc($data)) {
                                            if ($count <= 4) {
                                                $count = $count + 1;
                                ?>
                                <tr
                                    class="item bg-white border-b :dark:bg-gray-800 :dark:border-gray-700 hover:bg-gray-50 :dark:hover:bg-gray-600">
                                    <th scope="row" class="flex flex-col px-6 py-4  whitespace-nowrap :dark:text-white">
                                        <p class="my-auto font-thin text-blue-600"><?php echo $row['document_name']; ?></p>
                                        <p class="my-1 font-thin text-gray-900">
                                            Số trang: <?php echo $row['document_page']; ?>, 
                                            Số bản: <?php echo $row['document_copy']; ?>, 
                                            Kích thước: <?php echo $row['document_size']; ?></p>
                                    </th>
                                    <td class="px-6 py-4 text-gray-600 text-center">
                                        <?php echo $row['printer_id']; ?>
                                    </td>
                                    <td class="px-4 py-4 text-gray-600 text-center">
                                        <?php echo $row['printTime']; ?>
                                    </td>
                                    <td class="px-4 py-4 text-gray-600 text-center">
                                        <?php echo $row['printTime']; ?>
                                    </td>
                                    <td class="px-6 py-4 text-center text-green-500">
                                        <?php echo $row['printStatus']; ?>
                                    </td>
                                </tr>
                                <?php 
                                        }
                                        else { ?>
                                            <tr class="item hidden bg-white border-b :dark:bg-gray-800 :dark:border-gray-700 hover:bg-gray-50 :dark:hover:bg-gray-600">
                                            <th scope="row" class="flex flex-col px-6 py-4  whitespace-nowrap :dark:text-white">
                                                <p class="my-auto font-thin text-blue-600"><?php echo $row['document_name']; ?></p>
                                                <p class="my-1 font-thin text-gray-900">
                                                    Số trang: <?php echo $row['document_page']; ?>, 
                                                    Số bản: <?php echo $row['document_copy']; ?>, 
                                                    Kích thước: <?php echo $row['document_size']; ?></p>
                                            </th>
                                            <td class="px-6 py-4 text-gray-600 text-center">
                                                <?php echo $row['printer_id']; ?>
                                            </td>
                                            <td class="px-4 py-4 text-gray-600 text-center">
                                                <?php echo $row['printTime']; ?>
                                            </td>
                                            <td class="px-4 py-4 text-gray-600 text-center">
                                                <?php echo $row['printTime']; ?>
                                            </td>
                                            <td class="px-6 py-4 text-center text-green-500">
                                                <?php echo $row['printStatus']; ?>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                    }
                                }
                                else {
                                    $count = 1;
                                    $startDate = "01/01/2023";
                                    $endDate = "12/31/2023";
                                    $data = get_history_student($username, $startDate, $endDate);
                                        while ($row = mysqli_fetch_assoc($data)) {
                                            if ($count <= 4) {
                                                $count = $count + 1;
                                            
                                    ?>
                                    <tr
                                        class="item bg-white border-b :dark:bg-gray-800 :dark:border-gray-700 hover:bg-gray-50 :dark:hover:bg-gray-600">
                                        <th scope="row" class="flex flex-col px-6 py-4  whitespace-nowrap :dark:text-white">
                                            <p class="my-auto font-thin text-blue-600"><?php echo $row['document_name']; ?></p>
                                            <p class="my-1 font-thin text-gray-900">
                                                Số trang: <?php echo $row['document_page']; ?>, 
                                                Số bản: <?php echo $row['document_copy']; ?>, 
                                                Kích thước: <?php echo $row['document_size']; ?></p>
                                        </th>
                                        <td class="px-6 py-4 text-gray-600 text-center">
                                            <?php echo $row['printer_id']; ?>
                                        </td>
                                        <td class="px-4 py-4 text-gray-600 text-center">
                                            <?php echo $row['printTime']; ?>
                                        </td>
                                        <td class="px-4 py-4 text-gray-600 text-center">
                                            <?php echo $row['printTime']; ?>
                                        </td>
                                        <td class="px-6 py-4 text-center text-green-500">
                                            <?php echo $row['printStatus']; ?>
                                        </td>
                                    </tr>
                                    <?php 
                                        }
                                        else { ?>
                                            <tr
                                            class="item hidden bg-white border-b :dark:bg-gray-800 :dark:border-gray-700 hover:bg-gray-50 :dark:hover:bg-gray-600">
                                            <th scope="row" class="flex flex-col px-6 py-4  whitespace-nowrap :dark:text-white">
                                                <p class="my-auto font-thin text-blue-600"><?php echo $row['document_name']; ?></p>
                                                <p class="my-1 font-thin text-gray-900">
                                                    Số trang: <?php echo $row['document_page']; ?>, 
                                                    Số bản: <?php echo $row['document_copy']; ?>, 
                                                    Kích thước: <?php echo $row['document_size']; ?></p>
                                            </th>
                                            <td class="px-6 py-4 text-gray-600 text-center">
                                                <?php echo $row['printer_id']; ?>
                                            </td>
                                            <td class="px-4 py-4 text-gray-600 text-center">
                                                <?php echo $row['printTime']; ?>
                                            </td>
                                            <td class="px-4 py-4 text-gray-600 text-center">
                                                <?php echo $row['printTime']; ?>
                                            </td>
                                            <td class="px-6 py-4 text-center text-green-500">
                                                <?php echo $row['printStatus']; ?>
                                            </td>
                                        </tr>
                                        <?php
                                        }
                                    }
                                }
                                ?>
                            </tbody>
                        </table>
                        <button type="button" id="seeMoreBtn" name="seeMoreBtn" class="text-blue-700 hover:text-white border border-blue-700 
                        hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-thin 
                        rounded-lg text-base px-5 py-2.5 my-3 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 
                        dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">Xem thêm</button>
                    </div>
                    <script>src="history.js"</script>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    <script src="../navbar/darkmode.js"></script>
    <script src="../navbar/nav.js"></script>
    <script src="./history.js"></script>
</body>