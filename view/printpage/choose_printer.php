<!DOCTYPE html>
<html lang="en">

<?php session_start(); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang In</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css"  rel="stylesheet"/>
    <!-- <script src="https://cdn.tailwindcss.com"></script> -->
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
                    <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path></svg>
                    <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path></svg>
                </button>
                <div class="flex items-center ml-3 mr-4" id="nav__user"> 
                    <button class="mr-5">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 21">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M10 3.464V1.1m0 2.365a5.338 5.338 0 0 1 5.133 5.368v1.8c0 2.386 1.867 2.982 1.867 4.175C17 15.4 17 16 16.462 16H3.538C3 16 3 15.4 3 14.807c0-1.193 1.867-1.789 1.867-4.175v-1.8A5.338 5.338 0 0 1 10 3.464ZM1.866 8.832a8.458 8.458 0 0 1 2.252-5.714m14.016 5.714a8.458 8.458 0 0 0-2.252-5.714M6.54 16a3.48 3.48 0 0 0 6.92 0H6.54Z" />
                        </svg>
                    </button>
                    <button class="mr-5">
                        <svg class="w-6 h-6 text-gray-800 dark:text-white" aria-hidden="true"
                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2"
                                d="M5 5h5M5 8h2m6-3h2m-5 3h6m2-7H2a1 1 0 0 0-1 1v9a1 1 0 0 0 1 1h3v5l5-5h8a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1Z" />
                        </svg>
                    </button>
                    <div class="mr-0.5">
                        <div class="self-center text-right text-base font-semibold whitespace-nowrap dark:text-white">Danh Hoang</div>
                        <div class="self-center text-right text-sm whitespace-nowrap dark:text-white" id="user__student">Sinh viên</div>
                        <div class="self-center text-right text-sm whitespace-nowrap dark:text-white" id="user__SPSO">SPSO</div>
                    </div>
                    <button id="dropdownInformationButton" aria-expanded="false" data-dropdown-toggle="dropdown-user" class="ml-1 mr-4 dark:text-white bg-white focus:ring-4 focus:outline-none focus:bg-blue-500 focus:ring-blue-600 font-medium rounded-lg text-sm px-1 py-1 text-center inline-flex items-center dark:bg-gray-900 dark:hover:bg-blue-500 dark:focus:ring-blue-600" type="button">
                        <img class="w-10 h-10 rounded-full"
                                src="https://flowbite.com/docs/images/people/profile-picture-5.jpg"
                                alt="user photo">
                        <svg class="w-2.5 h-2.5 ms-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 10 6">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                        </svg>
                    </button>
                    <div class="z-50 hidden my-4 text-base list-none bg-white divide-y divide-gray-100 rounded shadow dark:bg-gray-700 dark:divide-gray-600"
                        id="dropdown-user">
                        <!-- <div class="px-4 py-3" role="none">
                            <p class="text-sm text-gray-900 dark:text-white" role="none">
                                Danh Hoang
                            </p>
                            <p class="text-sm font-medium text-gray-900 truncate dark:text-gray-300" role="none">
                                name@flowbite.com
                            </p>
                        </div> -->
                        <ul class="py-1" role="none">
                            <li>
                                <a href="#" data-modal-target="default-modal" data-modal-toggle="default-modal"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
                                    id="userinfo" role="menuitem">Thông tin tài khoản</a>
                            </li>
                            <li>
                                <a href="#"
                                    class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-100 dark:text-gray-300 dark:hover:bg-gray-600 dark:hover:text-white"
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
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div
                    class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                        Thông tin tài khoản
                    </h3>
                    <button id="closeBtn" type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                        data-modal-hide="default-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg"
                            fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-4 md:p-5 space-y-4">
                    <div id="userModal"
                        class="grid grid-cols-3 gap-4 p-6 mb-6 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <section class="bg-gray-100 dark:bg-gray-900">
        <h1 class="mt-4 text-3xl font-bold text-black dark:text-white ml-4 xl:ml-36">In Ngay</h1>
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-6 grid lg:grid-cols-1 gap-8 lg:gap-7">
            <div>
                <div class="m-auto w-full lg:max-w-full p-6 bg-white rounded-lg shadow-xl dark:bg-gray-800">
                    <div class="flex flex-row">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-white">
                            Danh sách máy in
                        </h3>
                        <h3 class="ml-auto mr-24 text-lg text-gray-500 dark:text-white">
                            Số lượng giấy hiện có (Tờ): 69
                        </h3>
                    </div>
                    <hr class="m-auto w-full lg:max-w-full my-3 border-zinc-400">
                    <div class="relative overflow-x-auto shadow-md sm:rounded-lg">
                        <table class="w-full text-xl text-left rtl:text-right text-gray-500 dark:text-gray-400">
                            <thead class="text-base text-gray-700 bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">
                                        ID Máy In
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Mẫu Máy In
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Trạng thái
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        Số lượng giấy (Tờ)
                                    </th>
                                    <th scope="col" class="px-6 py-3 text-center">
                                        <span class="sr-only">Chọn</span>
                                    </th>
                                </tr>
                            </thead>
                            <tbody id='list-of-printer'>
                                
                                <!-- <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="flex px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <img src="../img/printer_icon.png" alt="" class="w-10 h-10 mr-4">
                                        <p class="my-auto">Printer#1</p>
                                    </th>
                                    <td class="px-6 py-4 text-center">
                                        HP Laser Jet Pro M20w
                                    </td>
                                    <td class="px-6 py-4 text-center text-green-500">
                                        Sẵn sàng
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        590
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <a id="choose-printer" data-modal-target="print-modal" data-modal-toggle="print-modal" href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Chọn</a>
                                    </td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="flex px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <img src="../img/printer_icon.png" alt="" class="w-10 h-10 mr-4">
                                        <p class="my-auto">Printer#2</p>
                                    </th>
                                    <td class="px-6 py-4 text-center">
                                        Canon 2900 LBM
                                    </td>
                                    <td class="px-6 py-4 text-center text-green-500">
                                        Sẵn sàng
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        467
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <a id="choose-printer" data-modal-target="print-modal" data-modal-toggle="print-modal" href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Chọn</a>
                                    </td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="flex px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <img src="../img/printer_icon.png" alt="" class="w-10 h-10 mr-4">
                                        <p class="my-auto">OptimusPrime</p>
                                    </th>
                                    <td class="px-6 py-4 text-center">
                                        MayInVjpPr0
                                    </td>
                                    <td class="px-6 py-4 text-center text-green-500">
                                        Sẵn sàng
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        420
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <a id="choose-printer" data-modal-target="print-modal" data-modal-toggle="print-modal" href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Chọn</a>
                                    </td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="flex px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <img src="../img/printer_icon.png" alt="" class="w-10 h-10 mr-4">
                                        <p class="my-auto">BoySiTinh2k3</p>
                                    </th>
                                    <td class="px-6 py-4 text-center">
                                        iPrint 69 Pro Max
                                    </td>
                                    <td class="px-6 py-4 text-center text-green-500">
                                        Sẵn sàng
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        389
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <a id="choose-printer" data-modal-target="print-modal" data-modal-toggle="print-modal" href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Chọn</a>
                                    </td>
                                </tr>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="flex px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <img src="../img/printer_icon.png" alt="" class="w-10 h-10 mr-4">
                                        <p class="my-auto">NormalPrinter</p>
                                    </th>
                                    <td class="px-6 py-4 text-center">
                                        Undefined Printer
                                    </td>
                                    <td class="px-6 py-4 text-center text-green-500">
                                        Sẵn sàng
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        230
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        <a id="choose-printer" data-modal-target="print-modal" data-modal-toggle="print-modal" href="#" class="font-medium text-blue-600 dark:text-blue-500 hover:underline">Chọn</a>
                                    </td>
                                </tr> -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div id="print-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="space-y-0">
                    <div id="Modal1"
                        class="grid grid-cols-1 gap-4 p-6 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <div id="bodyModal"></div>
                        <a id="return-home" href="../homepage/homepage.php" type="button" class="block text-lg m-auto px-4 sm:px-24 py-2 
                            bg-blue-500 text-center text-white rounded-md mb-3">
                            Oke con dê! Đưa tôi về trang chủ
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    <script src="../navbar/darkmode.js"></script>
    <script src="../navbar/nav.js"></script>
    <script src="./choose_printer.js"></script>
</body>