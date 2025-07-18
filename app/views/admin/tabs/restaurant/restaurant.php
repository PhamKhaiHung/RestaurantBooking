<div class="overflow-x-auto relative p-6 mx-auto max-w-[1500px] bg-white shadow-md sm:rounded-lg dark:bg-gray-800">
    <div class="flex items-center justify-between mb-6">
        <div class="text-3xl font-semibold text-gray-800 dark:text-white">Danh sách nhà hàng</div>
        <!-- <a class="px-6 py-3 font-semibold text-white transition duration-300 ease-in-out transform bg-teal-500 border border-teal-500 rounded-lg shadow-md hover:bg-teal-600 hover:scale-110 hover:shadow-lg focus:outline-none"
            href="./restaurant/addRestaurant">
            Thêm nhà hàng
        </a> -->
    </div>

    <!-- Tabs -->
    <div class="mb-6 border-b border-gray-200 dark:border-gray-700">
        <ul class="flex flex-wrap -mb-px text-sm font-medium text-center" id="restaurantTabs" role="tablist">
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 rounded-t-lg active" id="active-tab" data-tab="active" type="button" role="tab" aria-controls="active" aria-selected="true">
                    Đang hoạt động
                </button>
            </li>
            <li class="mr-2" role="presentation">
                <button class="inline-block p-4 border-b-2 border-transparent rounded-t-lg hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300" id="inactive-tab" data-tab="inactive" type="button" role="tab" aria-controls="inactive" aria-selected="false">
                    Tạm dừng hoạt động
                </button>
            </li>
        </ul>
    </div>
    
    <!-- Active Restaurants Tab -->
    <div id="active-content" class="tab-content">
        <table class="w-full text-left text-gray-400 rtl:text-right">
            <thead class="text-lg text-gray-900 bg-gray-50 dark:text-white dark:bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Tên nhà hàng
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Lượt xem
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Lượt đặt
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Lượt đánh giá
                    </th>
                    <th scope="col" class="px-6 py-3">
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['restaurant_data'] as $res) { 
                    if ($res['status'] == 1) { ?>
                    <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <img class="w-10 h-10 rounded-full" src="<?php echo $res['avatar']; ?>" alt="avatar">
                            <div class="ps-3">
                                <div class="text-base font-semibold"><?php echo $res['restaurant_name']; ?></div>
                            </div>
                        </th>
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-200">
                            <?php echo $res['views_num']; ?>
                        </td>
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-200">
                            <?php echo $res['comments_num']; ?>
                        </td>
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-200">
                            <?php echo $res['booking_num']; ?>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end">
                                <a class="flex items-center justify-center px-3 py-2.5 mr-2 min-w-[100px] font-medium text-teal-500 rounded-lg border border-teal-500 transition duration-300 ease-in-out transform hover:text-white hover:bg-teal-500 hover:scale-110"
                                    href="./restaurant/restaurant_detail/<?php echo $res['rid'] ?>">
                                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12H9m3-3v6m-7 5h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    Chi tiết
                                </a>
                                
                                <a href="./restaurant/delete_Restaurant/<?php echo $res['rid'] ?>"
                                    
                                    class="flex items-center justify-center px-3 py-2.5 mr-2 min-w-[100px] font-medium text-rose-500 rounded-lg border border-rose-500 transition duration-300 ease-in-out transform cursor-pointer res-delete-btn hover:text-white hover:bg-rose-500 hover:scale-110">
                                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M6 18L18 6M6 6l12 12" />
                                    </svg>
                                    Đình chỉ
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php } } ?>
            </tbody>
        </table>
    </div>

    <!-- Inactive Restaurants Tab -->
    <div id="inactive-content" class="hidden tab-content">
        <table class="w-full text-left text-gray-400 rtl:text-right">
            <thead class="text-lg text-gray-900 bg-gray-50 dark:text-white dark:bg-gray-700">
                <tr>
                    <th scope="col" class="px-6 py-3">
                        Tên nhà hàng
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Lượt xem
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Lượt đặt
                    </th>
                    <th scope="col" class="px-6 py-3">
                        Lượt đánh giá
                    </th>
                    <th scope="col" class="px-6 py-3">
                    </th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($data['restaurant_data'] as $res) { 
                    if ($res['status'] == 0) { ?>
                    <tr class="border-b bg-gray-50 dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-100 dark:hover:bg-gray-700">
                        <th scope="row" class="flex items-center px-6 py-4 text-gray-900 whitespace-nowrap dark:text-white">
                            <img class="w-10 h-10 rounded-full" src="<?php echo $res['avatar']; ?>" alt="avatar">
                            <div class="ps-3">
                                <div class="text-base font-semibold"><?php echo $res['restaurant_name']; ?></div>
                            </div>
                        </th>
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-200">
                            <?php echo $res['views_num']; ?>
                        </td>
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-200">
                            <?php echo $res['comments_num']; ?>
                        </td>
                        <td class="px-6 py-4 text-gray-900 dark:text-gray-200">
                            <?php echo $res['booking_num']; ?>
                        </td>
                        <td class="px-6 py-4">
                            <div class="flex justify-end">
                                <a class="flex items-center justify-center px-3 py-2.5 mr-2 min-w-[100px] font-medium text-teal-500 rounded-lg border border-teal-500 transition duration-300 ease-in-out transform hover:text-white hover:bg-teal-500 hover:scale-110"
                                    href="./restaurant/restaurant_detail/<?php echo $res['rid'] ?>">
                                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15 12H9m3-3v6m-7 5h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                    </svg>
                                    Chi tiết
                                </a>
                                
                                <a href="./restaurant/activate_Restaurant/<?php echo $res['rid'] ?>"
                                  
                                    class="flex items-center justify-center px-3 py-2.5 mr-2 min-w-[100px] font-medium text-green-500 rounded-lg border border-green-500 transition duration-300 ease-in-out transform hover:text-white hover:bg-green-500 hover:scale-110">
                                    <svg class="w-4 h-4 mr-2" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                        stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M5 13l4 4L19 7" />
                                    </svg>
                                    Kích hoạt
                                </a>
                            </div>
                        </td>
                    </tr>
                <?php } } ?>
            </tbody>
        </table>
    </div>
</div>

<div id="deleteModal" class="fixed inset-0 z-50 hidden w-full h-full overflow-y-auto bg-gray-600 bg-opacity-50">
    <div class="relative p-5 mx-auto bg-white border rounded-md shadow-lg top-20 w-96">
        <div class="mt-3 text-center">
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-red-100 rounded-full">
                <svg class="w-6 h-6 text-red-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v2m0 4h.01m-6.938 4h13.856c1.54 0 2.502-1.667 1.732-3L13.732 4c-.77-1.333-2.694-1.333-3.464 0L3.34 16c-.77 1.333.192 3 1.732 3z"/>
                </svg>
            </div>
            <h3 class="mt-5 text-lg font-medium leading-6 text-gray-900">Xác nhận đình chỉ</h3>
            <div class="py-3 mt-2 px-7">
                <p class="text-sm text-gray-500">Bạn có chắc chắn muốn đình chỉ nhà hàng này?</p>
            </div>
            <div class="flex justify-center gap-4 mt-3">
                <button id="confirmDelete" class="px-4 py-2 text-base font-medium text-white bg-red-500 rounded-md shadow-sm hover:bg-red-600 focus:outline-none focus:ring-2 focus:ring-red-300">
                    Đình chỉ
                </button>
                <button id="cancelDelete" class="px-4 py-2 text-base font-medium text-gray-700 bg-gray-100 rounded-md shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Hủy
                </button>
            </div>
        </div>
    </div>
</div>

<!-- Modal kích hoạt -->
<div id="activateModal" class="fixed inset-0 z-50 hidden w-full h-full overflow-y-auto bg-gray-600 bg-opacity-50">
    <div class="relative p-5 mx-auto bg-white border rounded-md shadow-lg top-20 w-96">
        <div class="mt-3 text-center">
            <div class="flex items-center justify-center w-12 h-12 mx-auto bg-green-100 rounded-full">
                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/>
                </svg>
            </div>
            <h3 class="mt-5 text-lg font-medium leading-6 text-gray-900">Xác nhận kích hoạt</h3>
            <div class="py-3 mt-2 px-7">
                <p class="text-sm text-gray-500">Bạn có chắc chắn muốn kích hoạt nhà hàng này?</p>
            </div>
            <div class="flex justify-center gap-4 mt-3">
                <button id="confirmActivate" class="px-4 py-2 text-base font-medium text-white bg-green-500 rounded-md shadow-sm hover:bg-green-600 focus:outline-none focus:ring-2 focus:ring-green-300">
                    Kích hoạt
                </button>
                <button id="cancelActivate" class="px-4 py-2 text-base font-medium text-gray-700 bg-gray-100 rounded-md shadow-sm hover:bg-gray-200 focus:outline-none focus:ring-2 focus:ring-gray-300">
                    Hủy
                </button>
            </div>
        </div>
    </div>
</div>
<script>
document.addEventListener('DOMContentLoaded', function() {
    const tabs = document.querySelectorAll('[data-tab]');
    const contents = document.querySelectorAll('.tab-content');

    tabs.forEach(tab => {
        tab.addEventListener('click', () => {
            // Remove active class from all tabs
            tabs.forEach(t => {
                t.classList.remove('active', 'border-teal-500', 'text-teal-500');
                t.classList.add('border-transparent');
            });

            // Add active class to clicked tab
            tab.classList.add('active', 'border-teal-500', 'text-teal-500');
            tab.classList.remove('border-transparent');

            // Hide all contents
            contents.forEach(content => {
                content.classList.add('hidden');
            });

            // Show selected content
            const contentId = tab.getAttribute('data-tab') + '-content';
            document.getElementById(contentId).classList.remove('hidden');
        });
    });
    let currentUrl = '';
    const deleteModal = document.getElementById('deleteModal');
    const activateModal = document.getElementById('activateModal');

    // Xử lý nút đình chỉ
    document.querySelectorAll('a[href*="delete_Restaurant"]').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            currentUrl = this.getAttribute('href');
            deleteModal.classList.remove('hidden');
        });
    });

    // Xử lý nút kích hoạt
    document.querySelectorAll('a[href*="activate_Restaurant"]').forEach(button => {
        button.addEventListener('click', function(e) {
            e.preventDefault();
            currentUrl = this.getAttribute('href');
            activateModal.classList.remove('hidden');
        });
    });

    // Xử lý nút xác nhận đình chỉ
    document.getElementById('confirmDelete').addEventListener('click', function() {
        window.location.href = currentUrl;
    });

    // Xử lý nút xác nhận kích hoạt
    document.getElementById('confirmActivate').addEventListener('click', function() {
        window.location.href = currentUrl;
    });

    // Xử lý nút hủy
    document.getElementById('cancelDelete').addEventListener('click', function() {
        deleteModal.classList.add('hidden');
    });

    document.getElementById('cancelActivate').addEventListener('click', function() {
        activateModal.classList.add('hidden');
    });

    // Đóng modal khi click ra ngoài
    window.addEventListener('click', function(e) {
        if (e.target === deleteModal) {
            deleteModal.classList.add('hidden');
        }
        if (e.target === activateModal) {
            activateModal.classList.add('hidden');
        }
    });
});
</script>