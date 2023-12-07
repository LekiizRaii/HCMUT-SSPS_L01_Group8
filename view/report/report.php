<?php
    $currentDirectory = __DIR__;
    $url = dirname($currentDirectory);
    $month = $_GET['month'] ?? 11;
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Report Page</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css" rel="stylesheet" />
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/datepicker.min.js"></script>

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
    <nav class="bg-white border-gray-200 :dark:bg-gray-900">
        <div class="max-w-screen-full flex flex-wrap items-center justify-between mx-auto p-4">
            <a href="../homepage/homepage.php" class="ml-5 flex items-center space-x-3 rtl:space-x-reverse">
                <img src="../img/hcmut.png" class="h-8" alt="HCMUT Logo" />
                <div class="ml-4">
                    <div class="self-center text-base font-semibold whitespace-nowrap :dark:text-white">Ho Chi Minh
                        University of Technology</div>
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
                            id="user__student">Student</div>
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

    <div class="max-w-5xl mx-auto my-3 w-full bg-white rounded-lg shadow :dark:bg-gray-800 p-4 md:p-6">

        <!-- Button -->
        <button id="dropdownDefaultButton" data-dropdown-toggle="lastDaysdropdown" data-dropdown-placement="bottom"
            class="text-sm float-right font-medium text-gray-500 :dark:text-gray-400 hover:text-gray-900 text-center inline-flex items-center :dark:hover:text-white"
            type="button">
            <?php 
                switch ($month) {
                    case '1':
                        echo "January 2023";
                        break;
                    case '2':
                        echo "February 2023";
                        break;
                    case '3':
                        echo "March 2023";
                        break;
                    case '4':
                        echo "April 2023";
                        break;
                    case '5':
                        echo "May 2023";
                        break;
                    case '6':
                        echo "June 2023";
                        break;
                    case '7':
                        echo "July 2023";
                        break;
                    case '8':
                        echo "August 2023";
                        break;
                    case '9':
                        echo "January 2023";
                        break;
                    case '10':
                        echo "October 2023";
                        break;
                    case '11':
                        echo "November 2023";
                        break;
                    default:
                        echo "November 2023";
                }
            ?>
            <svg class="w-2.5 m-2.5 ms-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                viewBox="0 0 10 6">
                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="m1 1 4 4 4-4" />
            </svg>
        </button>
        <!-- Dropdown menu -->
        <div id="lastDaysdropdown"
            class="z-10 hidden bg-white divide-y divide-gray-100 rounded-lg shadow w-44 :dark:bg-gray-700">
            <ul class="py-2 text-sm text-gray-700 :dark:text-gray-200" aria-labelledby="dropdownDefaultButton">
                <li>
                    <!-- <a href="./report.php?month=1" -->
                    <a href="./report.php?month=1"
                        class="block px-4 py-2 hover:bg-gray-100 :dark:hover:bg-gray-600 :dark:hover:text-white">January
                        2023</a>
                </li>
                <li>
                    <a href="./report.php?month=2"
                        class="block px-4 py-2 hover:bg-gray-100 :dark:hover:bg-gray-600 :dark:hover:text-white">February
                        2023</a>
                </li>
                <li>
                    <a href="./report.php?month=3"
                        class="block px-4 py-2 hover:bg-gray-100 :dark:hover:bg-gray-600 :dark:hover:text-white">
                        March 2023</a>
                </li>
                <li>
                    <a href="./report.php?month=4"
                        class="block px-4 py-2 hover:bg-gray-100 :dark:hover:bg-gray-600 :dark:hover:text-white">April
                        2023</a>
                </li>
                <li>
                    <a href="./report.php?month=5"
                        class="block px-4 py-2 hover:bg-gray-100 :dark:hover:bg-gray-600 :dark:hover:text-white">May
                        2023
                    </a>
                </li>
                <li>
                    <a href="./report.php?month=6"
                        class="block px-4 py-2 hover:bg-gray-100 :dark:hover:bg-gray-600 :dark:hover:text-white">June
                        2023
                    </a>
                </li>
                <li>
                    <a href="./report.php?month=7"
                        class="block px-4 py-2 hover:bg-gray-100 :dark:hover:bg-gray-600 :dark:hover:text-white">July
                        2023
                    </a>
                </li>
                <li>
                    <a href="./report.php?month=8"
                        class="block px-4 py-2 hover:bg-gray-100 :dark:hover:bg-gray-600 :dark:hover:text-white">August
                        2023
                    </a>
                </li>
                <li>
                    <a href="./report.php?month=9"
                        class="block px-4 py-2 hover:bg-gray-100 :dark:hover:bg-gray-600 :dark:hover:text-white">September
                        2023
                    </a>
                </li>
                <li>
                    <a href="./report.php?month=10"
                        class="block px-4 py-2 hover:bg-gray-100 :dark:hover:bg-gray-600 :dark:hover:text-white">October
                        2023
                    </a>
                </li>
                <li>
                    <a href="./report.php?month=11"
                        class="block px-4 py-2 hover:bg-gray-100 :dark:hover:bg-gray-600 :dark:hover:text-white">November
                        2023
                    </a>
                </li>
            </ul>
        </div>
        <div class="flex flex-left">
            <h1 class="mt-4 text-3xl font-bold text-black :dark:text-white ml-4">Thống kê số lượt in</h1>
        </div>

        <div id="column-chart"></div>
        <div class="grid grid-cols-1 items-center border-gray-200 border-t :dark:border-gray-700 justify-between">
            <div class="flex justify-between items-center pt-5">
            </div>
        </div>
    </div>
    <div
        class="grid grid-cols-4 gap-20 max-w-5xl mx-auto my-3 w-full bg-white rounded-lg shadow :dark:bg-gray-800 p-4 md:p-6">
        <div class=" pb-4 mb-4 border-b border-gray-200 :dark:border-gray-700">
            <div class="flex flex-col-2 items-center">
                <div>
                    <h5 class="leading-none text-2xl font-bold text-gray-900 :dark:text-white pb-1">18.6K</h5>
                </div>
                <div
                    class="mx-auto me-0 text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md :dark:bg-green-900 :dark:text-green-300">
                    <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13V1m0 0L1 5m4-4 4 4" />
                    </svg>
                    18%
                </div>
            </div>

            <div class=" text-sm font-normal text-gray-500 :dark:text-gray-400">Successful Log-ins</div>


        </div>
        <div class=" pb-4 mb-4 border-b border-gray-200 :dark:border-gray-700">
            <div class="flex flex-col-2 items-center">
                <div>
                    <h5 class="leading-none text-2xl font-bold text-gray-900 :dark:text-white pb-1">1.051</h5>
                </div>
                <div
                    class="mx-auto text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md :dark:bg-green-900 :dark:text-green-300">
                    <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13V1m0 0L1 5m4-4 4 4" />
                    </svg>
                    25%
                </div>
            </div>

            <div class=" text-sm font-normal text-gray-500 :dark:text-gray-400">Print Counts</div>


        </div>
        <div class=" pb-4 mb-4 border-b border-gray-200 :dark:border-gray-700">
            <div class="flex flex-col-2 items-center">
                <div>
                    <h5 class="leading-none text-2xl font-bold text-gray-900 :dark:text-white pb-1">239</h5>
                </div>
                <div
                    class="mx-auto text-orange-500 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md :dark:bg-green-900 :dark:text-green-300">
                    <!-- <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13V1m0 0L1 5m4-4 4 4" />
                    </svg> -->
                    <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 1v12m0 0 4-4m-4 4L1 9" />
                    </svg>
                    7%
                </div>
            </div>

            <div class=" text-sm font-normal text-gray-500 :dark:text-gray-400">Failed to Log-ins</div>


        </div>
        <div class=" pb-4 mb-4 border-b border-gray-200 :dark:border-gray-700">
            <div class="flex flex-col-2 items-center">
                <div>
                    <h5 class="leading-none text-2xl font-bold text-gray-900 :dark:text-white pb-1">13.5K</h5>
                </div>
                <div
                    class="mx-auto  text-green-800 text-xs font-medium inline-flex items-center px-2.5 py-1 rounded-md :dark:bg-green-900 :dark:text-green-300">
                    <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                        viewBox="0 0 10 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M5 13V1m0 0L1 5m4-4 4 4" />
                    </svg>
                    12%
                </div>
            </div>

            <div class=" text-sm font-normal text-gray-500 :dark:text-gray-400">Total Sheet Used</div>


        </div>
    </div>
    <div class="my-5 grid grid-cols-12 gap-10 max-w-5xl mx-auto w-full">

        <div class="col-span-7 my-auto bg-white rounded-lg shadow :dark:bg-gray-800 p-4 md:p-6" style="max-height: 600px;">

            <div class="flex justify-between mb-3">
                <div class="flex justify-center items-center">
                    <h5 class="text-xl font-bold leading-none text-gray-900 :dark:text-white pe-1"> Thống kê các loại File
                    </h5>
                    <svg data-popover-target="chart-info" data-popover-placement="bottom"
                        class="w-3.5 h-3.5 text-gray-500 :dark:text-gray-400 hover:text-gray-900 :dark:hover:text-white cursor-pointer ms-1"
                        aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                        <path
                            d="M10 .5a9.5 9.5 0 1 0 9.5 9.5A9.51 9.51 0 0 0 10 .5Zm0 16a1.5 1.5 0 1 1 0-3 1.5 1.5 0 0 1 0 3Zm1-5.034V12a1 1 0 0 1-2 0v-1.418a1 1 0 0 1 1.038-.999 1.436 1.436 0 0 0 1.488-1.441 1.501 1.501 0 1 0-3-.116.986.986 0 0 1-1.037.961 1 1 0 0 1-.96-1.037A3.5 3.5 0 1 1 11 11.466Z" />
                    </svg>
                    <div data-popover id="chart-info" role="tooltip"
                        class="absolute z-10 invisible inline-block text-sm text-gray-500 transition-opacity duration-300 bg-white border border-gray-200 rounded-lg shadow-sm opacity-0 w-72 :dark:bg-gray-800 :dark:border-gray-600 :dark:text-gray-400">
                        <div class="p-3 space-y-2">
                            <h3 class="font-semibold text-gray-900 :dark:text-white">Activity growth - Incremental
                            </h3>
                            <p>Report helps navigate cumulative growth of community activities. Ideally, the chart
                                should have a growing trend, as stagnating chart signifies a significant decrease of
                                community activity.</p>
                            <h3 class="font-semibold text-gray-900 :dark:text-white">Calculation</h3>
                            <p>For each date bucket, the all-time volume of activities is calculated. This means
                                that activities in period n contain all activities up to period n, plus the
                                activities generated by your community in period.</p>
                            <a href="#"
                                class="flex items-center font-medium text-blue-600 :dark:text-blue-500 :dark:hover:text-blue-600 hover:text-blue-700 hover:underline">Read
                                more <svg class="w-2 h-2 ms-1.5 rtl:rotate-180" aria-hidden="true"
                                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 6 10">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round"
                                        stroke-width="2" d="m1 9 4-4-4-4" />
                                </svg></a>
                        </div>
                        <div data-popper-arrow></div>
                    </div>
                </div>
                <div>
                    <button type="button" data-tooltip-target="data-tooltip" data-tooltip-placement="bottom"
                        class="hidden sm:inline-flex items-center justify-center text-gray-500 w-8 h-8 :dark:text-gray-400 hover:bg-gray-100 :dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 :dark:focus:ring-gray-700 rounded-lg text-sm"><svg
                            class="w-3.5 h-3.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                            viewBox="0 0 16 18">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 1v11m0 0 4-4m-4 4L4 8m11 4v3a2 2 0 0 1-2 2H3a2 2 0 0 1-2-2v-3" />
                        </svg><span class="sr-only">Download data</span>
                    </button>
                    <div id="data-tooltip" role="tooltip"
                        class="absolute z-10 invisible inline-block px-3 py-2 text-sm font-medium text-white transition-opacity duration-300 bg-gray-900 rounded-lg shadow-sm opacity-0 tooltip :dark:bg-gray-700">
                        Download CSV
                        <div class="tooltip-arrow" data-popper-arrow></div>
                    </div>
                </div>
            </div>
            <!-- Donut Chart -->
            <div class="py-6" id="donut-chart"></div>

            <div class="grid grid-cols-1 items-center border-gray-200 border-t :dark:border-gray-700 justify-between">
                <div class="flex justify-between items-center pt-5">
                </div>
            </div>
        </div>
        <script>
            // fetch('/models/fileStats.php')
            fetch('../../models/fileStats.php')
                .then(response => response.json())
                .then(dataPHP => {
                // Process and convert the data into an array with {x, y} format
                    var fileTypes = [];
                    var fileCountsString = [];

                    dataPHP.forEach(item => {
                        fileTypes.push(item.file_type);
                        fileCountsString.push(item.file_count);
                    });

                    var fileCounts = fileCountsString.map(function(str) {
                        return parseInt(str, 10); // 10 specifies base 10 (decimal)
                    });

                    // Log or use the converted data as needed
                    // ApexCharts options and config
                    window.addEventListener("load", function () {
                        const getChartOptions = () => {
                            return {
                                series: fileCounts,
                                colors: ["#80CAEE", "#0FADCF", "#3C50E0", "#6577F3"],
                                chart: {
                                    height: 400,
                                    width: "100%",
                                    type: "donut",
                                },
                                stroke: {
                                    colors: ["transparent"],
                                    lineCap: "",
                                },
                                plotOptions: {
                                    pie: {
                                        donut: {
                                            labels: {
                                                show: true,
                                                name: {
                                                    show: true,
                                                    fontFamily: "Inter, sans-serif",
                                                    offsetY: 20,
                                                },
                                                total: {
                                                    showAlways: true,
                                                    show: true,
                                                    label: "Files",
                                                    fontFamily: "Inter, sans-serif",
                                                    formatter: function (w) {
                                                        const sum = w.globals.seriesTotals.reduce((a, b) => {
                                                            return a + b
                                                        }, 0)
                                                        return `${sum}`
                                                    },
                                                },
                                                value: {
                                                    show: true,
                                                    fontFamily: "Inter, sans-serif",
                                                    offsetY: -20,
                                                    formatter: function (value) {
                                                        return value
                                                    },
                                                },
                                            },
                                            size: "60%",
                                        },
                                    },
                                },
                                grid: {
                                    padding: {
                                        top: -2,
                                    },
                                },
                                labels: fileTypes,
                                dataLabels: {
                                    enabled: true,
                                },
                                legend: {
                                    position: "bottom",
                                    fontFamily: "Inter, sans-serif",
                                },
                                yaxis: {
                                    labels: {
                                        formatter: function (value) {
                                            return value 
                                        },
                                    },
                                },
                                xaxis: {
                                    labels: {
                                        formatter: function (value) {
                                            return value 
                                        },
                                    },
                                    axisTicks: {
                                        show: false,
                                    },
                                    axisBorder: {
                                        show: false,
                                    },
                                },
                            }
                        }

                        if (document.getElementById("donut-chart") && typeof ApexCharts !== 'undefined') {
                            const chart = new ApexCharts(document.getElementById("donut-chart"), getChartOptions());
                            chart.render();

                            // Get all the checkboxes by their class name
                            const checkboxes = document.querySelectorAll('#devices input[type="checkbox"]');
                        }
                    });
                })
                .catch(error => console.error('Error:', error));
        </script>
        <div class="grid grid-rows-2 col-span-5 ">

            <div class="my-3 bg-white rounded-lg shadow :dark:bg-gray-800 p-4 md:p-6">

                <div class="grid grid-cols-2 py-3">
                    <h5 class="text-lg font-bold leading-none text-gray-900 :dark:text-white pe-1">Lượt sử dụng máy in
                    </h5>
                </div>

                <div id="bar-chart"></div>
            </div>

            <script>
                fetch("../../models/printerStats.php")
                    .then(response => response.json())
                    .then(dataPHP => {
                        var printerID = [];
                        var count = [];

                        dataPHP.forEach(item => {
                            printerID.push(item.ID);
                            count.push(item.SoLuotIn);
                        });
                        // ApexCharts options and config
                        window.addEventListener("load", function () {
                            var options = {
                                series: [
                                    {
                                        name: "Printer counts",
                                        color: "#80CAEE",
                                        data: count,
                                    },
                                ],
                                chart: {
                                    sparkline: {
                                        enabled: false,
                                    },
                                    type: "bar",
                                    width: "100%",
                                    height: 200,
                                    toolbar: {
                                        show: false,
                                    }
                                },
                                fill: {
                                    opacity: 1,
                                },
                                plotOptions: {
                                    bar: {
                                        horizontal: true,
                                        columnWidth: "100%",
                                        borderRadiusApplication: "end",
                                        borderRadius: 6,
                                        dataLabels: {
                                            position: "top",
                                        },
                                    },
                                },
                                legend: {
                                    show: true,
                                    position: "bottom",
                                },
                                dataLabels: {
                                    enabled: false,
                                },
                                tooltip: {
                                    shared: true,
                                    intersect: false,
                                    formatter: function (value) {
                                        return value
                                    }
                                },
                                xaxis: {
                                    labels: {
                                        show: true,
                                        style: {
                                            fontFamily: "Inter, sans-serif",
                                            cssClass: 'text-xs font-normal fill-gray-500 :dark:fill-gray-400'
                                        },
                                        formatter: function (value) {
                                            return value
                                        }
                                    },
                                    categories: printerID,
                                    axisTicks: {
                                        show: false,
                                    },
                                    axisBorder: {
                                        show: false,
                                    },
                                },
                                yaxis: {
                                    labels: {
                                        show: true,
                                        style: {
                                            fontFamily: "Inter, sans-serif",
                                            cssClass: 'text-xs font-normal fill-gray-500 :dark:fill-gray-400'
                                        }
                                    }
                                },
                                grid: {
                                    show: true,
                                    strokeDashArray: 4,
                                    padding: {
                                        left: 2,
                                        right: 2,
                                        top: -20
                                    },
                                },
                                fill: {
                                    opacity: 1,
                                }
                            }

                            if (document.getElementById("bar-chart") && typeof ApexCharts !== 'undefined') {
                                const chart = new ApexCharts(document.getElementById("bar-chart"), options);
                                chart.render();
                            }
                        });
                    })
                    .catch(error => console.error('Error:', error));
                
            </script>
            <div class="my-3 bg-white rounded-lg shadow :dark:bg-gray-800 p-4 md:p-6">

                <div class="grid grid-cols-2 py-3">
                    <h5 class="text-lg font-bold leading-none text-gray-900 :dark:text-white pe-1">Paper Sizes
                    </h5>
                </div>

                <div id="bar-chart-1"></div>
            </div>

            <script>
                // ApexCharts options and config
                window.addEventListener("load", function () {
                    var options = {
                        series: [
                            {
                                name: "Print counts",
                                color: "#80CAEE",
                                data: ["142", "165", "182", "162", "142"],
                            },
                        ],
                        chart: {
                            sparkline: {
                                enabled: false,
                            },
                            type: "bar",
                            width: "100%",
                            height: 200,
                            toolbar: {
                                show: false,
                            }
                        },
                        fill: {
                            opacity: 1,
                        },
                        plotOptions: {
                            bar: {
                                horizontal: true,
                                columnWidth: "100%",
                                borderRadiusApplication: "end",
                                borderRadius: 6,
                                dataLabels: {
                                    position: "top",
                                },
                            },
                        },
                        legend: {
                            show: true,
                            position: "bottom",
                        },
                        dataLabels: {
                            enabled: false,
                        },
                        tooltip: {
                            shared: true,
                            intersect: false,
                            formatter: function (value) {
                                return value
                            }
                        },
                        xaxis: {
                            labels: {
                                show: true,
                                style: {
                                    fontFamily: "Inter, sans-serif",
                                    cssClass: 'text-xs font-normal fill-gray-500 :dark:fill-gray-400'
                                },
                                formatter: function (value) {
                                    return value
                                }
                            },
                            categories: ["A4", "A3", "A5", "A2", "A1"],
                            axisTicks: {
                                show: false,
                            },
                            axisBorder: {
                                show: false,
                            },
                        },
                        yaxis: {
                            labels: {
                                show: true,
                                style: {
                                    fontFamily: "Inter, sans-serif",
                                    cssClass: 'text-xs font-normal fill-gray-500 :dark:fill-gray-400'
                                }
                            }
                        },
                        grid: {
                            show: true,
                            strokeDashArray: 4,
                            padding: {
                                left: 2,
                                right: 2,
                                top: -20
                            },
                        },
                        fill: {
                            opacity: 1,
                        }
                    }

                    if (document.getElementById("bar-chart-1") && typeof ApexCharts !== 'undefined') {
                        const chart = new ApexCharts(document.getElementById("bar-chart-1"), options);
                        chart.render();
                    }
                });
            </script>
        </div>
    </div>
    <script>
        // ApexCharts options and config
        // fetch('/models/printStatsByMonth.php?month=', {
        fetch('../../models/printStatsByMonth.php?month=<?php echo $month ?>', {
            method: 'GET',
        })
        .then(response => response.json())
        .then(item => {
            const reformattedArray = item.map(({ Day, RecordsCount }) => ({
                x: new Date(Day).getDate(), // Extract the day from the date string
                y: RecordsCount,
            }));

            window.addEventListener("load", function () {
                const options = {
                    colors: ["#1A56DB", "#FDBA8C"],
                    series: [
                        {
                            name: "Print count",
                            color: "#1A56DB",
                            data: reformattedArray,
                        },

                    ],
                    chart: {
                        type: "bar",
                        height: "320px",
                        fontFamily: "Inter, sans-serif",
                        toolbar: {
                            show: false,
                        },
                    },
                    plotOptions: {
                        bar: {
                            horizontal: false,
                            columnWidth: "70%",
                            borderRadiusApplication: "end",
                            borderRadius: 8,
                        },
                    },
                    tooltip: {
                        shared: true,
                        intersect: false,
                        style: {
                            fontFamily: "Inter, sans-serif",
                        },
                    },
                    states: {
                        hover: {
                            filter: {
                                type: "darken",
                                value: 1,
                            },
                        },
                    },
                    stroke: {
                        show: true,
                        width: 0,
                        colors: ["transparent"],
                    },
                    grid: {
                        show: false,
                        strokeDashArray: 4,
                        padding: {
                            left: 2,
                            right: 2,
                            top: -14
                        },
                    },
                    dataLabels: {
                        enabled: false,
                    },
                    legend: {
                        show: false,
                    },
                    xaxis: {
                        floating: false,
                        labels: {
                            show: true,
                            style: {
                                fontFamily: "Inter, sans-serif",
                                cssClass: 'text-xs font-normal fill-gray-500 :dark:fill-gray-400'
                            }
                        },
                        axisBorder: {
                            show: false,
                        },
                        axisTicks: {
                            show: false,
                        },
                    },
                    yaxis: {
                        show: false,
                    },
                    fill: {
                        opacity: 1,
                    },
                }

                if (document.getElementById("column-chart") && typeof ApexCharts !== 'undefined') {
                    const chart = new ApexCharts(document.getElementById("column-chart"), options);
                    chart.render();
                }
            });
        })
        .catch(error => console.error('Error:', error));
    </script>


    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    <script src="/view/navbar/darkmode.js"></script>
    <script src="/view/navbar/nav.js"></script>
</body>