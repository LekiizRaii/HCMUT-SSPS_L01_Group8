<!DOCTYPE html>
<html lang="en">

<?php session_start(); ?>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang cung cấp thông tin in</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css"  rel="stylesheet"/>
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.js"
        integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.7.20/dist/sweetalert2.all.min.js"></script>
    <!-- <script src="https://unpkg.com/pdfjs-dist/build/pdf.min.js"></script> -->

    <!-- Dark mode -->
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark');
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
        <h1 class="mt-4 text-3xl font-bold text-black dark:text-white ml-4 sm:ml-40 text-align:left">Cung cấp thông tin in</h1>
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-6 grid lg:grid-cols-2 gap-8 lg:gap-7">
            <div>
                <div class="m-auto w-full lg:max-w-xl p-6 bg-white rounded-lg shadow-xl dark:bg-gray-800">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                        Xem trước bản in
                    </h3>
                    <hr class="m-auto w-full lg:max-w-xl my-3 border-zinc-400">
                    <div class="m-auto p-6">
                        <img id="default-preview-image" src="../img/image1.png" alt="print_preview">

                        <div id="preview"></div>
                    </div>
                </div>
            </div>
            <div>
                <div class="m-auto w-full lg:max-w-xl p-6 bg-white rounded-lg shadow-xl dark:bg-gray-800">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                        Cấu hình in
                    </h3>
                    <hr class="m-auto w-full lg:max-w-xl my-3 border-zinc-400">
                    <form class="" action="controllers/print_page_controller.php" method="post">
                        <div class="mb-2">     
                            <label class="block mb-2 text-lg font-medium text-gray-900 dark:text-white" for="file_input">Tải tệp lên</label>
                            <!-- <input name='file_input' data-modal-target="upload-modal" data-modal-toggle="upload-modal" accept=".docx, .pdf, .jpg, .png" class="block w-full text-lg text-gray-900 border border-gray-300 rounded cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file" onchange="previewFile(this);"/> -->
                            <input name='file_input' accept=".docx, .pdf, .jpg, .png" class="block w-full text-lg text-gray-900 border border-gray-300 rounded cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400" id="file_input" type="file" onchange="previewFile(this);"/>
                            <p class="mt-1 text-sm text-gray-500 dark:text-gray-300" id="file_input_help">DOCX, PDF, JPG hoặc PNG (tối đa 500MBs)</p>
                        </div>
                        <div class="mb-2">
                            <label for="numberofcopy" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Số lượng bản in</label>
                            <input name="numberofcopy" required="required" type="text" id="numberofcopy" class="bg-gray-50 border border-gray-300 pl-3 sm:pl-5 text-gray-900 text-lg rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Nhập số lượng bản in">
                        </div>
                        <div class="flex flew-col sm:flex-row mb-2">
                            <div class="mr-auto" style="width: 48%">
                                <label for="pages" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Số trang</label>
                                <input name="numberofpages" type="text" id="pages" class="bg-gray-50 border border-gray-300 pl-3 sm:pl-5 text-gray-900 sm:text-lg rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="VD: tất cả, chẵn, 1-14">
                            </div>
                            <div class="ml-auto" style="width: 48%">
                                <label for="size" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Cỡ giấy</label>
                                <select name="pagesize" id="size" class="bg-gray-50 border border-gray-300 pl-3 sm:pl-5 w-20 text-gray-400 text-lg rounded focus:ring-blue-500 focus:border-blue-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                    <option>A4</option>
                                    <option>A3</option>
                                    <!-- <option>A2</option>
                                    <option>A1</option>
                                    <option>A0</option> -->
                                </select>
                            </div>
                        </div>
                        <div class="flex flew-col sm:flex-row mb-2">
                            <div class="mr-auto" style="width: 48%">
                                <label for="pages" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Chế độ in</label>
                                <fieldset class="flex m-auto">
                                    <div class="flex items-center mb-4 mr-auto">
                                        <input name="orientation" id="option-1" type="radio" value="portrait" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600" checked>
                                        <label for="option-1" class="block ms-2  text-lg text-gray-900 dark:text-gray-300">
                                            In dọc
                                        </label>
                                    </div>
                                    <div class="flex items-center mb-4 m-auto">
                                        <input name="orientation" id="option-2" type="radio" value="landscape" class="w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="option-2" class="block ms-2 text-lg text-gray-900 dark:text-gray-300">
                                            In ngang
                                        </label>
                                    </div>
                                </fieldset>
                            </div>
                            <div class="ml-auto" style="width: 48%">
                                <label for="size" class="block mb-2 text-lg font-medium text-gray-900 dark:text-white">Tùy chọn</label>
                                <label class="relative inline-flex items-center cursor-pointer m-auto">
                                    <input name="twofaced" id="twofaced" type="checkbox" value="twofaced" class="sr-only peer">
                                    <div class="w-11 h-6 bg-gray-200 peer-focus:outline-none peer-focus:ring-4 peer-focus:ring-blue-300 dark:peer-focus:ring-blue-800 rounded-full peer dark:bg-gray-700 peer-checked:after:translate-x-full rtl:peer-checked:after:-translate-x-full peer-checked:after:border-white after:content-[''] after:absolute after:top-[2px] after:start-[2px] after:bg-white after:border-gray-300 after:border after:rounded-full after:h-5 after:w-5 after:transition-all dark:border-gray-600 peer-checked:bg-blue-600"></div>
                                    <span class="ms-3 text-lg text-gray-900 dark:text-gray-300">In cả 2 mặt</span>
                                </label>
                            </div>
                        </div>
                        <div class="flex flex-col justify-center mb-2">
                            <a data-modal-target="bug-modal" data-modal-toggle="bug-modal" href="#" id="save-button" type="button" class="text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded text-xl w-full sm:w-auto px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Lưu</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <div id="bug-modal" data-modal-backdrop="static" tabindex="-1" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="space-y-0">
                    <div id="Modal1"
                        class="grid grid-cols-1 gap-4 p-6 border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                        <div id="bodyModal"></div>
                        <button id="bug1" type="button" data-modal-hide="bug-modal" class="block text-lg m-auto px-4 sm:px-28 py-2 
                            bg-blue-500 text-white rounded-md mb-3">
                            Trở về trang Cài đặt in
                        </button>
                        <div class="flex flex-row m-auto" id="bug2">
                            <button type="button" data-modal-hide="bug-modal" class="block text-lg text-center m-auto px-2 sm:px-8 py-2 
                                bg-white border border-blue-500 text-blue-500 rounded-md mb-3 mx-6">
                                Điều chỉnh lại
                            </button>
                            <a href="../homepage/homepage.html" type="button" class="block text-lg text-center m-auto px-2 sm:px-8 py-2 
                                bg-blue-500 text-white rounded-md mb-3 mx-6">
                                Mua thêm giấy
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <div id="upload-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
        <div class="relative p-4 w-full max-w-2xl max-h-full">
            <div class="relative bg-white rounded shadow dark:bg-gray-700">
                <div class="flex items-center justify-between p-4 md:p-5 border-b rounded dark:border-gray-600">
                    <h3 class="text-xl text-gray-900 dark:text-white">
                        Tải lên tệp của bạn
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="upload-modal">
                        <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                            <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                        </svg>
                        <span class="sr-only">Close modal</span>
                    </button>
                </div>
                <div class="p-4 md:p-5 space-y-4">
                    <div class="flex items-center justify-center w-full">
                        <label for="dropzone-file" class="flex flex-col items-center justify-center w-full h-64 border-2 border-blue-600 border-dashed rounded cursor-pointer bg-gray-50 dark:hover:bg-bray-800 dark:bg-gray-700 hover:bg-gray-100 dark:border-blue-600 dark:hover:border-gray-500 dark:hover:bg-gray-600">
                            <div class="flex flex-col items-center justify-center pt-5 pb-6">
                                <svg class="w-8 h-8 mb-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 16">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 13h3a3 3 0 0 0 0-6h-.025A5.56 5.56 0 0 0 16 6.5 5.5 5.5 0 0 0 5.207 5.021C5.137 5.017 5.071 5 5 5a4 4 0 0 0 0 8h2.167M10 15V6m0 0L8 8m2-2 2 2"/>
                                </svg>
                                <p class="mb-2 text-lg text-gray-500 dark:text-gray-400"><span class="font-semibold">Click to upload</span> or drag and drop</p>
                                <p class="text-lg text-gray-500 dark:text-gray-400">DOCX, PDF, JPG or PNG</p>
                                <p class="text-lg text-gray-500 dark:text-gray-400">(max, 500MBs)</p>
                            </div>
                            <input id="dropzone file" type="file" class="hidden"/>
                        </label>
                    </div> 
                </div>
                <div class="flex items-center p-4 md:p-5 border-t border-gray-200 rounded-b dark:border-gray-600">
                    <button data-modal-hide="upload-modal" type="button" class="ml-auto text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 rounded text-xl px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Upload</button>
                </div>
            </div>
        </div>
    </div> -->

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    <script src="../navbar/darkmode.js"></script>
    <script src="../navbar/nav.js"></script>
    <script src="./print_page.js"></script>
</body>