<?php
session_start();
ob_start();

$rootPath = '/HCMUT-SSPS_L01_Group8';

// Connect to the database
require_once '../../db/db_connection.php';
// include_once 'connectionController.php';
// include_once 'statusController.php';
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Management Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
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
    <?php
        $sqlShowPrinters = "SELECT ID, Hang, Model, DiaChiIP, KetNoi, TinhTrang, SoGiayA4, SoGiayA3 FROM mayin";
        $printers = $conn->query($sqlShowPrinters);
    ?>

    <nav class="bg-white border-gray-200 :dark:bg-gray-900">
        <div class="max-w-screen-full flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="../homepage/homepage.html" class="ml-5 flex items-center space-x-3 rtl:space-x-reverse">
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
                        class="text-gray-400 bg-transparent hover:bg-gray-100 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center :dark:hover:bg-gray-600 :dark:hover:text-white"
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
        <h1 class="mt-4 text-3xl font-bold text-black :dark:text-white ml-4 xl:ml-36">Quản lí hệ thống in</h1>
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-6 grid lg:grid-cols-1 gap-8 lg:gap-7">
            <div>
                <div class="m-auto w-full lg:max-w-full p-6 bg-white rounded-lg shadow-xl :dark:bg-gray-800">
                    <div class="flex flex-row">
                        <h3 class="text-2xl font-bold text-gray-900 :dark:text-white">
                            Danh sách máy in đã kết nối
                        </h3>
                        <!-- <h3 class="ml-auto mr-24 text-lg text-gray-500 :dark:text-white">
                            Your Paper Quantity (Sheets): 69
                        </h3> -->
                        <button type="button" data-modal-target="adding-modal" data-modal-toggle="adding-modal" class=" ml-auto mr-12 text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 
                        focus:ring-blue-300 font-extralight rounded-lg text-lg px-5 py-1 me-2 mb-2 
                        :dark:bg-blue-600 :dark:hover:bg-blue-700 focus:outline-none 
                        :dark:focus:ring-blue-800">
                            <svg style="margin-top: 4px;" class="float-left w-5 h-5 text-gray-800 dark:text-white" aria-hidden="true"
                                xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                    stroke-width="2" d="M9 1v16M1 9h16" />
                            </svg><span class="ps-2"> Add Printer</span></button>
                    </div>
                    <!-- Main modal -->
                    <div id="adding-modal" tabindex="-1" aria-hidden="true"
                        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                        <div class="relative p-4 w-full max-w-screen-lg max-h-full">
                            <!-- Modal content -->
                            <div class="relative bg-white rounded-lg shadow :dark:bg-gray-700">
                                <!-- Modal header -->
                                <div
                                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t :dark:border-gray-600">
                                    <h3 class="text-xl font-semibold text-gray-900 :dark:text-white">
                                        Danh sách máy in chưa kết nối
                                    </h3>
                                    <button type="button"
                                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center :dark:hover:bg-gray-600 :dark:hover:text-white"
                                        data-modal-hide="adding-modal">
                                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                                            fill="none" viewBox="0 0 14 14">
                                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                                        </svg>
                                        <span class="sr-only">Close modal</span>
                                    </button>
                                </div>
                                <!-- Modal body -->
                                <div class="p-4 md:p-5 space-y-4">
                                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                                        <table
                                            class="w-full text-xl text-left rtl:text-right text-gray-500 :dark:text-gray-400">
                                            <thead
                                                class="text-base text-gray-700 bg-gray-50 :dark:bg-gray-700 :dark:text-gray-400">
                                                <tr>
                                                    <th scope="col" class="px-6 py-3">
                                                        Printer ID
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-center">
                                                        Printer Model
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-center">
                                                        Status
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-center">
                                                        IP Address
                                                    </th>
                                                    <th scope="col" class="px-6 py-3 text-center">

                                                    </th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    while ($row = $printers->fetch_assoc()) {
                                                        $ketNoi = isset($row['KetNoi']) ? $row['KetNoi'] : null;
                                                        if ($ketNoi == "Disconnected") {
                                                ?>
                                                <tr
                                                    class="bg-white border-b :dark:bg-gray-800 :dark:border-gray-700 hover:bg-gray-50 :dark:hover:bg-gray-600">
                                                    <th scope="row"
                                                        class="flex px-6 py-4 font-medium text-gray-900 whitespace-nowrap :dark:text-white">
                                                        <img src="../img/printer_icon.png" alt=""
                                                            class="w-10 h-10 mr-4">
                                                        <p class="my-auto"><?=$row['ID']?></p>
                                                    </th>
                                                    <td class="px-6 py-4 text-center">
                                                        <?= $row['Hang'] . ' - ' . $row['Model'] ?>
                                                    </td>
                                                    <td class="px-6 py-4 text-center text-red-500">
                                                        <div class="bg-gray-100 rounded-full">Disconnected</div>

                                                    </td>
                                                    <td class="px-6 py-4 text-center">
                                                        <?= $row['DiaChiIP']?>
                                                    </td>
                                                    <td class="px-6 py-4 text-center">
                                                        <button type="button" class="text-blue-700 hover:text-white border border-blue-700 
                                        hover:bg-blue-800 focus:ring-1 focus:outline-none focus:ring-blue-100 
                                         rounded-lg text-lg px-5 py-1 text-center me-2 mb-2 
                                        :dark:border-blue-500 :dark:text-blue-500 :dark:hover:text-white 
                                        :dark:hover:bg-blue-500 :dark:focus:ring-blue-800">Connect</button>
                                                    </td>
                                                </tr>
                                                <?php
                                                }}?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- Main modal -->
                    <hr class="m-auto w-full lg:max-w-full my-3 border-zinc-400">
                    <?php
                    $sqlConnectedPrinter = "SELECT * FROM mayin WHERE KetNoi = 'Connected'";
                    $tmp = $conn->query($sqlConnectedPrinter);
                    if ($tmp->num_rows > 0) {
                        $totalConnectedPrinter = $tmp->num_rows;
                        $currentPage = 1;
                        if (isset($_GET['page'])) {
                            settype($_GET['page'], 'int');
                            $currentPage = $_GET['page'];
                        }
                        $limit = 7;
                        $totalPage = ceil($totalConnectedPrinter/$limit);

                        // giới hạn phân trang trong 1-totalPage
                        if ($currentPage > $totalPage) {
                            $currentPage = $totalPage;
                        } elseif ($currentPage < 1) { 
                            $currentPage = 1;
                        }                    

                        $start = ($currentPage - 1) * $limit;
                        $sqlConnectedPrinter = $sqlConnectedPrinter." LIMIT $start, $limit";
                        $printers = $conn->query($sqlConnectedPrinter);
                    ?>
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-xl text-left rtl:text-right text-gray-500 :dark:text-gray-400">
                            <thead class="text-base text-gray-700 bg-gray-50 :dark:bg-gray-700 :dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        Printer ID
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Printer Model
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Status
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Paper Quantity (Sheets)
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">

                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                    while ($row = $printers->fetch_assoc()) {
                                        $modalId = 'setting-modal-' . $row['ID'];
                                ?>
								<tr class="bg-white border-b :dark:bg-gray-800 :dark:border-gray-700 hover:bg-gray-50 :dark:hover:bg-gray-600">
                                    <td scope="row"
                                        class="flex px-6 py-4 font-medium text-gray-900 whitespace-nowrap :dark:text-white">
                                        <img src="../img/printer_icon.png" alt="" class="w-10 h-10 mr-4">
                                        <p class="my-auto"><?=$row['ID']?></p>
                                    </td>
									<td class="px-6 py-4 text-center"><?= $row['Hang'] . ' - ' . $row['Model'] ?></td>
									<td class="px-6 py-4 text-center <?php echo ($row['TinhTrang'] === 'Enabled') ? 'text-green-500' : (($row['TinhTrang'] === 'Disabled') ? 'text-red-500' : ''); ?>">
                                        <div class="bg-gray-100 rounded-full"><?=$row['TinhTrang']?></div>
                                    </td>
									<td class="px-6 py-4 text-center"><?= $row['SoGiayA4'] + 2*$row['SoGiayA3'] ?></td>
                                    <td class="px-6 py-4 text-center">
                                    <button type="button" data-modal-target="<?= $modalId ?>"
                                        data-modal-toggle="<?= $modalId ?>" class="text-blue-700 hover:text-white border border-blue-700 
                                        hover:bg-blue-800 focus:ring-1 focus:outline-none focus:ring-blue-100 
                                        rounded-lg text-lg px-5 py-1 text-center me-2 mb-2 
                                        :dark:border-blue-500 :dark:text-blue-500 :dark:hover:text-white 
                                        :dark:hover:bg-blue-500 :dark:focus:ring-blue-800">Setting</button>
                                        <!-- Main modal -->
                                        <div id="<?= $modalId ?>" tabindex="-1" aria-hidden="true"
                                            class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                                            <div class="relative p-4 w-full max-w-screen-md max-h-full">
                                                <!-- Modal content -->
                                                <div class="relative bg-white rounded-lg shadow :dark:bg-gray-700">
                                                    <!-- Modal header -->
                                                    <div
                                                        class="grid grid-cols-2 gap-4 p-4 md:p-5 border-b rounded-t :dark:border-gray-600">
                                                        <div class="text-left">
                                                            <h3 class="my-2 text-xl font-semibold text-gray-900 :dark:text-white">
                                                                Properties
                                                            </h3>

                                                            <div class="my-2 text-gray-900">
                                                                <p class="my-auto"><?='ID: '.$row['ID']?></p>
                                                            </div>

                                                            <div class="my-2 text-gray-900">
                                                                <?= 'Model: '.$row['Hang'] . ' - ' . $row['Model'] ?>
                                                            </div>

                                                            <div class="my-2 text-gray-900">
                                                                <p class="my-auto"><?='IP Address: '.$row['DiaChiIP']?></p>
                                                            </div>
                                                        </div>
                                                        <div>
                                                            <img class="float-right me-20" src="../img/printer2.png"
                                                                alt="printer 2">
                                                        </div>
                                                    </div>
                                                    <!-- Modal body -->
                                                    <div class="gap-4 p-4 md:p-5 border-b rounded-t :dark:border-gray-600">
                                                        <h3 class="text-left my-2 text-xl font-semibold text-gray-900 :dark:text-white">Connection</h3>
                                                        <div class="grid grid-cols-2 gap-4">
                                                            <div class="">
                                                                <div class="my-2 text-gray-900">
                                                                    Status: <span id="connectionToggle<?php echo $row['ID']?>">Connected to System</span>
                                                                </div>
                                                                <button type="button" id="connectionToggleButton<?php echo $row['ID']?>"
                                                                    onclick="changeConnection('connectionToggle<?php echo $row['ID']?>','connectionToggleButton<?php echo $row['ID']?>')"
                                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4
                                                                            focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 
                                                                            dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800">Disconnect</button>
                                                            </div>
                                                            <div class="">
                                                                <div class="my-2 text-gray-900">
                                                                    Mode: <span id="statusToggle<?php echo $row['ID']?>"><?php echo $row['TinhTrang']; ?></span>
                                                                </div>
                                                                <button type="button" id="statusToggleButton<?php echo $row['ID']?>"
                                                                    onclick="changeStatus('statusToggle<?php echo $row['ID']?>', 'statusToggleButton<?php echo $row['ID']?>')"
                                                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4
                                                                            focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 me-2 mb-2 dark:bg-blue-600 
                                                                            dark:hover:bg-blue-700 focus:outline-none dark:focus:ring-blue-800"><?php echo ($row['TinhTrang'] == 'Enabled') ? 'Disable' : 'Enable'; ?></button>
                                                            </div>
                                                        </div>
                                                    </div>

                                                    <div
                                                        class="gap-4 p-4 md:p-5 border-b rounded-t :dark:border-gray-600">
                                                        <div id="alert-border-5"
                                                            class="flex p-4 mb-4 text-yellow-800 border-s-4 border-yellow-300 bg-yellow-50 :dark:text-yellow-300 :dark:bg-gray-800 :dark:border-yellow-800"
                                                            role="alert">
                                                            <svg class="w-[28px] h-[28px] text-yellow-800 dark:text-yellow" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                                                <path d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5ZM9.5 4a1.5 1.5 0 1 1 0 3 1.5 1.5 0 0 1 0-3ZM12 15H8a1 1 0 0 1 0-2h1v-3H8a1 1 0 0 1 0-2h2a1 1 0 0 1 1 1v4h1a1 1 0 0 1 0 2Z"/>
                                                            </svg>
                                                            <div class="ms-3 text-lg text-left">
                                                                <div class="font-medium">Attention needed</div>
                                                                <span class="text-base">You can only enable/disable printers that are connected to the system.</span>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <!-- Modal footer -->
                                                    <div
                                                        class="text-right p-4 md:p-5 border-t border-gray-200 rounded-b :dark:border-gray-600">
                                                        <button data-modal-hide="<?= $modalId ?>" type="button"
                                                            class="text-blue-700 hover:text-white border border-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:border-blue-500 dark:text-blue-500 dark:hover:text-white dark:hover:bg-blue-500 dark:focus:ring-blue-800">Cancel</button>
                                                        <button data-modal-hide="<?= $modalId ?>" type="button"
                                                            class=" text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Apply</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
								</tr>
								<?php
								}
								?>
							</tbody>
						</table>
                    </div>
                    <?php         
                    } else {
                        echo '<div class="alert alert-warning" role="alert"><i class="fa-light fa-circle-exclamation"></i> Không tìm thấy máy in nào!</div>';
                    }
                    $conn->close();
                    ?>
                </div>
                <?php 
                    if($printers->num_rows > 0) {
                ?>
                <!-- Reponsive no giup toi voi @@ -->
                <div class="m-auto w-full lg:max-w-full p-6 bg-white rounded-lg shadow-xl :dark:bg-gray-800">
                    <!-- Phân trang -->
                    <nav class="mt-3">
                        <ul class="pagination pagination-lg d-flex justify-content-center">
                        <?php 
                            if ($currentPage > 1 && $totalPage > 1) {
                        ?>
                            <li class="page-item">
                                <a href="<?php echo $rootPath?>/view/management/managementDefault.php?page=<?php echo ($currentPage - 1); ?>" class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" data-remote="true">&lsaquo; Prev</a>
                            </li>
                        <?php
                            }
                        ?>

                        <?php
                            for ($i = 1; $i <= $totalPage; $i++) { 
                                if ($i == $currentPage) {
                        ?>
                            <li class="page-item active">
                                <span rel="prev" class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" data-remote="true"><?php echo $i ?></span>
                            </li>
                        <?php
                                }  else {
                        ?>
                            <li class="page-item">
                                <a data-remote="true" class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" href="<?php echo $rootPath ?>/view/management/managementDefault.php?page=<?php echo $i ?>"><?php echo $i ?></a>
                            </li>
                        <?php
                                } 
                            }
                        ?>
                        <?php
                            if ($currentPage < $totalPage && $totalPage > 1) {
                        ?>
                            <li class="page-item">
                                <a href="<?php echo $rootPath;?>/view/management/managementDefault.php?page=<?php echo ($currentPage + 1) ?>" class="page-link rounded-0 mr-3 shadow-sm border-top-0 border-left-0 text-dark" data-remote="true">Next &rsaquo;</a>
                            </li>
                        <?php
                            }
                        ?>
                        </ul>
                    </nav>
                </div>
                <?php
                    }
                ?>
            </div>
        </div>
    </section>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    <script src="../navbar/darkmode.js"></script>
    <script src="../navbar/nav.js"></script>
    <script>
        function changeConnection(toggle, toggleButton) {
            var x = document.getElementById(toggle);
            var y = document.getElementById(toggleButton)
            if (x.innerHTML === "Connected to System") {
                x.innerHTML = "Disconnected to System";
                y.innerHTML = "Connect"
            } else {
                x.innerHTML = "Connected to System";
                y.innerHTML = "Disconnect"

            }
        }

        function changeStatus(toggle, toggleButton) {
            var x = document.getElementById(toggle);
            var y = document.getElementById(toggleButton)
            if (x.innerHTML === "Enabled") {
                x.innerHTML = "Disabled";
                y.innerHTML = "Enable"
            } else {
                x.innerHTML = "Enabled";
                y.innerHTML = "Disable"
            }
        }

        function concac () {
            
        }
    </script>
</body>