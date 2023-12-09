<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang Chọn Vai Trò</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.css"  rel="stylesheet"/>

    <style>
        #actor-buttons {
            display: flex;
            flex-direction: column;
            align-items: center;
            margin-top: 20px;
        }

        .actor-button {
            width: 80%;
            /* background-color: #1e90ff; */
            color: #fff;
            border: none;
            padding: 10px;
            border-radius: 5px;
            cursor: pointer;
            font-size: 15px;
            margin: 5px 0;
            text-align: center;
            text-decoration: none;
        }
    </style>

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
                <div class="flex items-center ml-3 mr-4" id="nav__login">
                    <button id="nav__login__button" type="button" class="mr-7 w-30 text-white bg-blue-600 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium font-bold rounded-lg text-sm px-4 py-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800" 
                        style="font-family: Montserrat;
                        font-weight: 900;">
                        ĐĂNG NHẬP
                    </button>
                </div>
            </div>
        </div>
    </nav>
    
    <section class="m-auto bg-gray-100 dark:bg-gray-900">
        <div class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 grid lg:grid-cols-1 gap-8 lg:gap-16">
            <div>
                <div class="m-auto mt-24 w-full lg:max-w-xl p-6 space-y-8 sm:p-8 bg-white rounded-lg shadow-xl dark:bg-gray-800">
                    <h2 class="text-4xl text-center font-bold text-gray-900 dark:text-white">
                        Đăng nhập dành cho
                    </h2>
                    <form class="mt-8 space-y-6" action="#">
                        <div id="actor-buttons">
                            <a class="actor-button bg-blue-600 dark:bg-blue-600" href="Login.php?actor=student" style="font-size: large;">Sinh viên</a>
                            <a class="actor-button bg-blue-600 dark:bg-blue-600" href="Login.php?actor=SPSO" style="font-size: large;">SPSO</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/flowbite/2.2.0/flowbite.min.js"></script>
    <script src="../navbar/darkmode.js"></script>
</body>