<form action="<?php echo $path ?>admin/restaurant/add_Restaurant" method="POST" class="p-6 mx-auto space-y-8 max-w-[1500px] bg-white rounded-lg shadow-md dark:bg-gray-800 dark:text-white">
    <div class="flex justify-between items-center">
        <div class="text-3xl font-semibold text-gray-800 dark:text-white">Thông tin nhà hàng</div>
        <hr class="mb-6 border-gray-300 dark:border-gray-700">
    </div>

    <div class="grid grid-cols-2 gap-6">
        <!-- Cột trái -->
        <div class="space-y-6">
            <div class="flex flex-col">
                <label for="restaurant_name" class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Tên nhà hàng</label>
                <input type="text" name="restaurant_name" id="restaurant_name" class="p-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            </div>

            <div class="flex flex-col">
                <label for="adult_price" class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Giá người lớn</label>
                <input type="number" name="adult_price" id="adult_price" class="p-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" min='0' required>
            </div>

            <div class="flex flex-col">
                <label for="child_price" class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Giá trẻ em</label>
                <input type="number" name="child_price" id="child_price" class="p-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" min='0' required>
            </div>

            <div class="flex flex-col">
                <label for="res_include" class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Bao gồm</label>
                <textarea name="res_include" id="res_include" rows="4" class="p-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required></textarea>
            </div>

            <div class="flex flex-col">
                <label for="res_exclude" class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Không bao gồm</label>
                <textarea name="res_exclude" id="res_exclude" rows="4" class="p-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required></textarea>
            </div>

            <div class="flex flex-col">
                <label for="res_condition" class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Điều kiện đặt nhà hàng</label>
                <textarea name="res_condition" id="res_condition" rows="4" class="p-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required></textarea>
            </div>

            <div class="flex flex-col">
                <label for="description" class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Mô tả</label>
                <textarea name="description" id="description" rows="4" class="p-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required></textarea>
            </div>
        </div>

        <!-- Cột phải -->
        <div class="space-y-6">
            <div class="flex flex-col">
                <label for="address" class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Địa chỉ</label>
                <select id="address" name="address" class="p-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    <?php foreach (array(
                        "TPHCM" => "Thành phố Hồ Chí Minh",
                        "DN" => "Đà Nẵng", 
                        "VT" => "Vũng Tàu",
                        "HA" => "Hội An",
                        "HN" => "Hà Nội",
                        "H" => "Huế"
                    ) as $value => $addr) {
                        echo "<option value=\"$addr\">$addr</option>";
                    } ?>
                </select>
            </div>

            <div class="flex flex-col">
                <label for="res_rate" class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Chất lượng nhà hàng</label>
                <select id="res_rate" name="res_rate" class="p-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    <?php foreach (array(
                        "1" => '1 sao',
                        "2" => "2 sao",
                        "3" => "3 sao",
                        "4" => "4 sao",
                        "5" => "5 sao",
                    ) as $value => $danh_gia) {
                        echo "<option value=\"$value\">$danh_gia</option>";
                    } ?>
                </select>
            </div>

            <div class="flex flex-col">
                <label for="open_time" class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Giờ mở cửa</label>
                <select id="open_time" name="open_time" class="p-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    <?php foreach (array(
                        "8h" => "08:00:00",
                        "9h" => "09:00:00",
                        "10h" => "10:00:00",
                        "11h" => "11:00:00",
                        "12h" => "12:00:00",
                        "13h" => "13:00:00",
                        "14h" => "14:00:00",
                        "15h" => "15:00:00",
                        "16h" => "16:00:00",
                        "17h" => "17:00:00",
                    ) as $value => $open_time) {
                        echo "<option value=\"$open_time\">$open_time</option>";
                    } ?>
                </select>
            </div>

            <div class="flex flex-col">
                <label for="cate_id" class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Danh mục</label>
                <select id="cate_id" name="cate_id" class="p-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
                    <?php foreach ($data['category'] as $category) {
                        echo sprintf("<option value=\"%s\">%s</option>", $category['cateid'], $category['category_name']);
                    } ?>
                </select>
            </div>

            <div class="flex flex-col">
                <label for="img" class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Hình ảnh</label>
                <input type="text" name="img" id="img" class="p-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            </div>

            <div class="flex flex-col">
                <label for="location" class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Địa điểm</label>
                <input type="text" name="location" id="location" class="p-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required>
            </div>

            <div class="flex flex-col">
                <label for="location_description" class="mb-2 text-lg font-medium text-gray-900 dark:text-white">Mô tả địa điểm</label>
                <textarea name="location_description" id="location_description" rows="4" class="p-3 text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-teal-500 focus:border-teal-500 dark:bg-gray-700 dark:border-gray-600 dark:text-white" required></textarea>
            </div>
        </div>
    </div>

    <div class="flex justify-end mt-8 space-x-4">
        <button name="restaurantSubmit" type="submit" class="px-6 py-3 font-semibold text-white bg-teal-500 rounded-lg border border-teal-500 shadow-md transition duration-300 ease-in-out transform hover:bg-teal-600 hover:scale-110 hover:shadow-lg focus:outline-none">Thêm</button>
        <button type="reset" class="px-6 py-3 font-semibold text-white bg-rose-500 rounded-lg border border-rose-500 shadow-md transition duration-300 ease-in-out transform hover:bg-rose-600 hover:scale-110 hover:shadow-lg focus:outline-none">Hủy</button>
        <a href="<?php echo $path; ?>admin/restaurant" class="px-6 py-3 font-semibold text-white bg-indigo-500 rounded-lg border border-indigo-500 shadow-md transition duration-300 ease-in-out transform hover:bg-indigo-600 hover:scale-110 hover:shadow-lg focus:outline-none">
            Quay lại
        </a>
    </div>
</form>