<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>5SR</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="<?php echo $path ?>css/user.css">
    <style>
        /* CSS to hide the sidebar when the class 'hidden' is added */
        .hidden {
            transform: translateX(-100%);
        }
        body {
            background-color: #0a191c ; /* Thay mã màu theo ý muốn (ví dụ: #f0f0f0 cho màu xám sáng) */
        }
    </style>
</head>

<body>
    <script>
        function toggleSidebar() {
            const sidebar = document.getElementById('default-sidebar');
            sidebar.classList.toggle('hidden');
        }
    </script>

    <button data-drawer-target="default-sidebar" data-drawer-toggle="default-sidebar" aria-controls="default-sidebar" type="button" class="inline-flex items-center p-2 mt-2 text-sm text-gray-500 rounded-lg ms-3 sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200" >
        <span class="sr-only">Open sidebar</span>
        <svg class="w-6 h-6" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
            <path clip-rule="evenodd" fill-rule="evenodd" d="M2 4.75A.75.75 0 012.75 4h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 4.75zm0 10.5a.75.75 0 01.75-.75h7.5a.75.75 0 010 1.5h-7.5a.75.75 0 01-.75-.75zM2 10a.75.75 0 01.75-.75h14.5a.75.75 0 010 1.5H2.75A.75.75 0 012 10z"></path>
        </svg>
    </button>

    <aside id="default-sidebar" class="fixed top-0 left-0 z-40 w-64 h-screen transition-transform -translate-x-full sm:translate-x-0" aria-label="Sidebar">
        <div class="h-full px-3 py-4 overflow-y-auto bg-gray-800">
            <ul class="space-y-2 font-medium">
                <li>
                    <a href="<?php echo $path ?>admin/user" class="flex items-center p-3 text-gray-200 rounded-lg hover:bg-gray-700">
                        <svg class="w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 21">
                            <path d="M14 2a3.963 3.963 0 0 0-1.4.267 6.439 6.439 0 0 1-1.331 6.638A4 4 0 1 0 14 2Zm1 9h-1.264A6.957 6.957 0 0 1 15 15v2a2.97 2.97 0 0 1-.184 1H19a1 1 0 0 0 1-1v-1a5.006 5.006 0 0 0-5-5ZM6.5 9a4.5 4.5 0 1 0 0-9 4.5 4.5 0 0 0 0 9ZM8 10H5a5.006 5.006 0 0 0-5 5v2a1 1 0 0 0 1 1h11a1 1 0 0 0 1-1v-2a5.006 5.006 0 0 0-5-5Z" />
                        </svg>
                        <span class="ms-3">Quản lý người dùng</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="<?php echo $path ?>admin/comment" class="flex items-center p-3 text-gray-200 rounded-lg hover:bg-gray-700">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M21 6h-18c-1.104 0-2 .896-2 2v10c0 1.104.896 2 2 2h4v4l4-4h10c1.104 0 2-.896 2-2v-10c0-1.104-.896-2-2-2zm-2 10h-14v-8h14v8z"/>
                    </svg>
                        <span class="flex-1 whitespace-nowrap ms-3">Quản lý bình luận</span>
                    </a>
                </li> -->
                <!-- <li>
                    <a href="<?php echo $path?>admin/customer" class="flex items-center p-3 text-gray-200 rounded-lg hover:bg-gray-700">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z"/>
                    </svg>
                        <span class="flex-1 whitespace-nowrap ms-3">Quản lý khách hàng</span>
                    </a>
                </li> -->
                <li>
                    <a href="<?php echo $path ?>admin/general" class="flex items-center p-3 text-gray-200 rounded-lg hover:bg-gray-700">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M12 2a10 10 0 1 0 10 10A10 10 0 0 0 12 2zm0 18a8 8 0 1 1 8-8 8 8 0 0 1-8 8zm-1-13h2v2h-2zm0 4h2v6h-2z"/>
                    </svg>
                        <span class="flex-1 whitespace-nowrap ms-3">Thông tin liên hệ</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $path ?>admin/category" class="flex items-center p-3 text-gray-200 rounded-lg hover:bg-gray-700">
                        <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 18 18">
                            <path d="M6.143 0H1.857A1.857 1.857 0 0 0 0 1.857v4.286C0 7.169.831 8 1.857 8h4.286A1.857 1.857 0 0 0 8 6.143V1.857A1.857 1.857 0 0 0 6.143 0Zm10 0h-4.286A1.857 1.857 0 0 0 10 1.857v4.286C10 7.169 10.831 8 11.857 8h4.286A1.857 1.857 0 0 0 18 6.143V1.857A1.857 1.857 0 0 0 16.143 0Zm-10 10H1.857A1.857 1.857 0 0 0 0 11.857v4.286C0 17.169.831 18 1.857 18h4.286A1.857 1.857 0 0 0 8 16.143v-4.286A1.857 1.857 0 0 0 6.143 10Zm10 0h-4.286A1.857 1.857 0 0 0 10 11.857v4.286c0 1.026.831 1.857 1.857 1.857h4.286A1.857 1.857 0 0 0 18 16.143v-4.286A1.857 1.857 0 0 0 16.143 10Z" />
                        </svg>
                        <span class="flex-1 whitespace-nowrap ms-3">Quản lý danh mục</span>
                    </a>
                </li>
                <li>
                    <a href="<?php echo $path ?>admin/restaurant" class="flex items-center p-3 text-gray-200 rounded-lg hover:bg-gray-700">
                    <svg class="flex-shrink-0 w-6 h-6 text-gray-500 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M3 22V2h18v20H3zm2-2h14V4H5v16zm4-10h2v2H9v-2zm0 4h2v2H9v-2zm4-4h2v2h-2v-2zm0 4h2v2h-2v-2z"/>
                    </svg>
                        <span class="flex-1 whitespace-nowrap ms-3">Quản lý nhà hàng</span>
                    </a>
                </li>
                <!-- <li>
                    <a href="<?php echo $path ?>admin/booking" class="flex items-center p-3 text-gray-200 rounded-lg hover:bg-gray-700">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M19 4h-1V2h-2v2H8V2H6v2H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 16H5V10h14v10zm0-12H5V6h14v2z"/>
                    </svg>
                        <span class="flex-1 whitespace-nowrap ms-3">Quản lý đặt nhà hàng</span>
                    </a>
                </li> -->
                <li>
                    <a href="<?php echo $path ?>user/account/logout" class="flex items-center p-3 text-gray-200 rounded-lg hover:bg-gray-700">
                    <svg class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 24 24">
                        <path d="M9 3v2h6v14H9v2h8V3H9zm-1 7H3v4h5v3l5-5-5-5v3z"/>
                    </svg>
                        <span class="flex-1 whitespace-nowrap ms-3">Đăng xuất</span>
                    </a>
                </li>
            </ul>
        </div>
    </aside>
    <div class="p-4 sm:ml-64">