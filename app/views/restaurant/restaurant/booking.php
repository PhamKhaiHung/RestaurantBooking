<?php
const status = array(
    '1' => 'Đã xác nhận',
    '2' => 'Đã hủy',
    '0' => 'Chờ xác nhận'
);
function format_date_dmy($date_string) {
    $timestamp = strtotime($date_string);
    if ($timestamp === false) {
        return null;
    }
    return date('d/m/Y', $timestamp);
}
?>
<div class="container py-5">
    <h2 class="mb-4 text-center">Quản lý Booking Nhà Hàng</h2>
    <div class="table-responsive">
        <table class="table align-middle bg-white table-bordered table-hover">
            <thead class="table-light">
                <tr>
                    <th>Tên khách</th>
                    <th>Ngày đặt</th>
                    <th>Số lượng người</th>
                    <th>SĐT</th>
                    <th>Trạng thái</th>
                    <th>Hành động</th>
                     
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($data['bookings'])): ?>
                    <?php foreach ($data['bookings'] as $booking): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($booking['fullname']); ?></td>
                            <td><?php echo format_date_dmy($booking['date']); ?></td>
                            <td><?php echo htmlspecialchars($booking['num']); ?></td>
                            <td><?php echo htmlspecialchars($booking['phone']); ?></td>
                            <td>
                                <span class="badge <?php echo $booking['status'] == '1' ? 'bg-success' : ($booking['status'] == '2' ? 'bg-danger' : 'bg-warning text-dark'); ?>">
                                    <?php echo status[$booking['status']]; ?>
                                </span>
                            </td>
                            <td>
                                <button type="button" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#bookingDetailModal<?php echo $booking['bid']; ?>">
                                    <i class="bi bi-eye me-1"></i>Chi tiết
                                </button>
                            </td>
                            
                        </tr>
<!-- Booking Detail Modal (Giữ nguyên) -->
                    <div class="modal fade" id="bookingDetailModal<?php echo $booking['bid']; ?>" tabindex="-1" aria-labelledby="bookingDetailModalLabel<?php echo $booking['bid']; ?>" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="text-white modal-header bg-primary">
                                    <h5 class="modal-title" id="bookingDetailModalLabel<?php echo $booking['bid']; ?>">
                                        <i class="bi bi-info-circle me-2"></i>Chi tiết đặt bàn
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                   
                                    <div class="mb-4 row">
                                        <div class="col-md-6">
                                            <p class="mb-2"><strong>Tên khách hàng:</strong> <?php echo htmlspecialchars($booking['fullname']); ?></p>
                                            <p class="mb-2"><strong>Email:</strong> <?php echo htmlspecialchars($booking['email']); ?></p>
                                            <p class="mb-2"><strong>Số điện thoại:</strong> <?php echo htmlspecialchars($booking['phone']); ?></p>
                                            <p class="mb-2"><strong>Địa chỉ:</strong> <?php echo htmlspecialchars($booking['address']); ?></p>
                                        </div>
                                        <div class="col-md-6">
                                            <p class="mb-2"><strong>Ngày đặt:</strong> <?php echo format_date_dmy($booking['date']); ?></p>
                                            <p class="mb-2"><strong>Số lượng người:</strong> <?php echo htmlspecialchars($booking['num']); ?></p>
                                            <p class="mb-2"><strong>Tổng tiền:</strong> <?php echo number_format($booking['money'], 0, ',', '.'); ?> VNĐ</p>
                                            <p class="mb-2">
                                                <strong>Trạng thái:</strong>
                                                <span class="badge <?php echo $booking['status'] == '1' ? 'bg-success' : ($booking['status'] == '2' ? 'bg-danger' : 'bg-warning text-dark'); ?>">
                                                    <?php echo status[$booking['status']]; ?>
                                                </span>
                                            </p>
                                        </div>
                                    </div>
                                    <div id="food-items-container-detail<?php echo $booking['bid']; ?>"></div> 
                                </div>
                                <div class="modal-footer">
                                    <?php if ($booking['status'] == '0'): ?>
                                    <div class="gap-2 d-flex">
                                       
                                    </div>
                                    <?php endif; ?>
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Update Booking Modal (MỚI) -->
                    <div class="modal fade" id="updateBookingModal<?php echo $booking['bid']; ?>" tabindex="-1" aria-labelledby="updateBookingModalLabel<?php echo $booking['bid']; ?>" aria-hidden="true">
                        <div class="modal-dialog modal-xl"> 
                            <div class="modal-content">
                                <div class="text-white modal-header bg-warning">
                                    <h5 class="modal-title" id="updateBookingModalLabel<?php echo $booking['bid']; ?>">
                                        <i class="bi bi-pencil-square me-2"></i>Cập nhật đơn hàng #<?php echo $booking['bid']; ?>
                                    </h5>
                                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <h6><i class="bi bi-person-fill me-2"></i>Thông tin khách hàng: <?php echo htmlspecialchars($booking['fullname']); ?> - <?php echo htmlspecialchars($booking['phone']); ?></h6>
                                    <hr>
                                    <h6><i class="bi bi-card-list me-2"></i>Danh sách món ăn hiện tại:</h6>
                                    <div id="update-food-items-list<?php echo $booking['bid']; ?>" class="mb-3">
                                        <!-- Danh sách món ăn sẽ được load bằng AJAX -->
                                        <div class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>
                                    </div>
                                    <hr>
                                    <div class="mb-3">
                                        <button type="button" class="btn btn-primary btn-sm btn-add-food-item" data-bid="<?php echo $booking['bid']; ?>">
                                            <i class="bi bi-plus-circle me-1"></i>Thêm món ăn
                                        </button>
                                    </div>
                                    <div id="add-food-form-container<?php echo $booking['bid']; ?>" style="display:none;">
                                        <h6>Chọn món để thêm:</h6>
                                        <div class="row">
                                            <div class="mb-2 col-md-6">
                                                <select class="form-select select-all-foods" data-bid="<?php echo $booking['bid']; ?>">
                                                    <option value="">-- Chọn món --</option>
                                                    {/* Options sẽ được load bằng AJAX */}
                                                </select>
                                            </div>
                                            <div class="mb-2 col-md-3">
                                                <input type="number" class="form-control input-new-food-quantity" placeholder="Số lượng" min="1" value="1">
                                            </div>
                                            <div class="mb-2 col-md-3">
                                                <button type="button" class="btn btn-success btn-sm btn-confirm-add-food" data-bid="<?php echo $booking['bid']; ?>">Thêm vào đơn</button>
                                            </div>
                                        </div>
                                    </div>
                                    <p class="mt-3"><strong>Tổng tiền dự kiến:</strong> <span id="estimated-total-price<?php echo $booking['bid']; ?>">0</span> VNĐ</p>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
                                    <button type="button" class="btn btn-success btn-save-updated-booking" data-bid="<?php echo $booking['bid']; ?>">
                                        <i class="bi bi-save me-2"></i>Lưu thay đổi
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php else: ?>
                <tr><td colspan="7" class="text-center">Chưa có booking nào.</td></tr> {/* Sửa colspan */}
            <?php endif; ?>
        </tbody>
    </table>
</div>
Use code with caution.
</div>
<style>
/* ... style cũ ... */
.modal-xl {
    max-width: 900px; /* Hoặc kích thước bạn muốn */
}
.food-item-row {
    padding: 0.5rem 0;
    border-bottom: 1px solid #eee;
}
.food-item-row:last-child {
    border-bottom: none;
}
</style>
<script>
// Hàm định dạng tiền tệ (giữ lại hoặc dùng hàm có sẵn)
function formatCurrency(number) {
    return Number(number).toLocaleString('vi-VN');
}

document.addEventListener('DOMContentLoaded', function() {
    // --- Xử lý Modal Chi Tiết (Sửa lại ID container) ---
    const detailModals = document.querySelectorAll('[id^="bookingDetailModal"]');
    detailModals.forEach(function(modal) {
        modal.addEventListener('show.bs.modal', function (event) {
            const bid = this.id.replace('bookingDetailModal', '');
            const container = document.getElementById('food-items-container-detail' + bid); // Sửa ID
            // ... (Logic fetch chi tiết món ăn cho modal chi tiết giữ nguyên) ...
             if (container && !container.dataset.loaded) {
                fetch('<?php echo $path; ?>restaurant/booking/getBookingDetail/' + bid)
                    .then(response => response.json())
                    .then(data => {
                        if (data.food_items && data.food_items.length > 0) {
                            let html = `<div class=\"mt-4\">
                                <h6 class=\"mb-3\"><i class=\"bi bi-cart me-2\"></i>Danh sách món ăn đã đặt</h6>
                                <div class=\"table-responsive\">
                                    <table class=\"table table-sm table-hover\">
                                        <thead class=\"table-light\">
                                            <tr>
                                                <th>STT</th>
                                                <th>Tên món</th>
                                                <th class=\"text-center\">Số lượng</th>
                                                <th class=\"text-end\">Đơn giá</th>
                                                <th class=\"text-end\">Thành tiền</th>
                                            </tr>
                                        </thead>
                                        <tbody>`;
                            data.food_items.forEach((item, idx) => {
                                html += `<tr>
                                    <td>${idx + 1}</td>
                                    <td>${item.food_name}</td>
                                    <td class=\"text-center\">${item.num}</td>
                                    <td class=\"text-end\">${formatCurrency(item.food_price)} VNĐ</td>
                                    <td class=\"text-end\">${formatCurrency(item.food_price * item.num)} VNĐ</td>
                                </tr>`;
                            });
                            html += `</tbody></table></div></div>`;
                            container.innerHTML = html;
                        } else {
                            container.innerHTML = '<div class="mt-4 text-muted">Không có món ăn nào được đặt.</div>';
                        }
                        container.dataset.loaded = '1';
                    });
            }
        });
        modal.addEventListener('hidden.bs.modal', function () {
            const bid = this.id.replace('bookingDetailModal', '');
            const container = document.getElementById('food-items-container-detail' + bid); // Sửa ID
            if (container) {
                container.innerHTML = '';
                delete container.dataset.loaded;
            }
        });
    });


    // --- Xử lý Modal Cập Nhật (MỚI) ---
    const updateModals = document.querySelectorAll('[id^="updateBookingModal"]');
    let allRestaurantFoods = $data['food']; // Lưu trữ danh sách tất cả món ăn của nhà hàng

    // Hàm fetch tất cả món ăn của nhà hàng (chỉ fetch một lần)
 // Gọi khi trang tải


    updateModals.forEach(function(modal) {
        const bid = modal.id.replace('updateBookingModal', '');
        const foodListContainer = modal.querySelector('#update-food-items-list' + bid);
        const addFoodFormContainer = modal.querySelector('#add-food-form-container' + bid);
        const selectAllFoodsDropdown = modal.querySelector('.select-all-foods');
        const estimatedTotalPriceSpan = modal.querySelector('#estimated-total-price' + bid);

        let currentBookingItems = []; // Lưu trữ các món đang chỉnh sửa

        // Hàm render danh sách món ăn đang chỉnh sửa
        function renderUpdateFoodList() {
            if (!foodListContainer) return;
            if (currentBookingItems.length === 0) {
                foodListContainer.innerHTML = '<p class="text-muted">Chưa có món ăn nào trong đơn hàng.</p>';
                updateEstimatedTotal();
                return;
            }

            let html = '<ul class="list-group list-group-flush">';
            currentBookingItems.forEach((item, index) => {
                html += `<li class="list-group-item d-flex justify-content-between align-items-center food-item-row" data-food-id="${item.food_id || item.id}">
                            <div>
                                <strong>${item.food_name || item.name}</strong><br>
                                <small>Đơn giá: ${formatCurrency(item.food_price || item.price)} VNĐ</small>
                            </div>
                            <div class="d-flex align-items-center">
                                <input type="number" class="form-control form-control-sm me-2 update-item-quantity" value="${item.num}" min="1" style="width: 70px;" data-index="${index}">
                                <button type="button" class="btn btn-danger btn-sm btn-remove-item" data-index="${index}"><i class="bi bi-trash"></i></button>
                            </div>
                         </li>`;
            });
            html += '</ul>';
            foodListContainer.innerHTML = html;
            updateEstimatedTotal();
        }

        // Hàm tính và cập nhật tổng tiền dự kiến
        function updateEstimatedTotal() {
            let total = 0;
            currentBookingItems.forEach(item => {
                total += (item.food_price || item.price) * item.num;
            });
            estimatedTotalPriceSpan.textContent = formatCurrency(total);
        }


        modal.addEventListener('show.bs.modal', async function (event) {
            foodListContainer.innerHTML = '<div class="text-center"><div class="spinner-border text-primary" role="status"><span class="visually-hidden">Loading...</span></div></div>';
            addFoodFormContainer.style.display = 'none'; // Ẩn form thêm món ban đầu
            currentBookingItems = []; // Reset

            try {
                const response = await fetch('<?php echo $path; ?>restaurant/booking/getBookingDetail/' + bid);
                const data = await response.json();
                if (data.food_items) {
                    // Quan trọng: Sao chép sâu để không ảnh hưởng mảng gốc
                    currentBookingItems = data.food_items.map(item => ({ ...item, food_id: item.food_id || item.id, food_name: item.food_name || item.name, food_price: item.food_price || item.price }));
                }
                renderUpdateFoodList();
                populateAllFoodsDropdown();
            } catch (error) {
                console.error('Lỗi khi lấy chi tiết booking để cập nhật:', error);
                foodListContainer.innerHTML = '<p class="text-danger">Không thể tải danh sách món ăn.</p>';
            }
        });

        // Sự kiện thay đổi số lượng món ăn
        foodListContainer.addEventListener('change', function(event) {
            if (event.target.classList.contains('update-item-quantity')) {
                const index = parseInt(event.target.dataset.index);
                const newQuantity = parseInt(event.target.value);
                if (newQuantity >= 1 && index >= 0 && index < currentBookingItems.length) {
                    currentBookingItems[index].num = newQuantity;
                    updateEstimatedTotal();
                } else {
                    event.target.value = currentBookingItems[index].num; // Reset nếu giá trị không hợp lệ
                }
            }
        });

        // Sự kiện xóa món ăn
        foodListContainer.addEventListener('click', function(event) {
            const removeButton = event.target.closest('.btn-remove-item');
            if (removeButton) {
                const index = parseInt(removeButton.dataset.index);
                if (index >= 0 && index < currentBookingItems.length) {
                    currentBookingItems.splice(index, 1);
                    renderUpdateFoodList(); // Render lại danh sách
                }
            }
        });


        // Nút "Thêm món ăn"
        const btnAddFood = modal.querySelector('.btn-add-food-item');
        if(btnAddFood) {
            btnAddFood.onclick = function() {
                addFoodFormContainer.style.display = addFoodFormContainer.style.display === 'none' ? 'block' : 'none';
                populateAllFoodsDropdown();
            }
        }

        // Populate dropdown tất cả món ăn
        function populateAllFoodsDropdown() {
            if (selectAllFoodsDropdown && allRestaurantFoods.length > 0) {
                // Chỉ populate nếu chưa có options (trừ option mặc định)
                if (selectAllFoodsDropdown.options.length <= 1) {
                    allRestaurantFoods.forEach(food => {
                        const option = new Option(`${food.name} (${formatCurrency(food.price)} VNĐ)`, food.id);
                        selectAllFoodsDropdown.add(option);
                    });
                }
            }
        }


        // Nút "Thêm vào đơn" (xác nhận thêm món mới)
        const btnConfirmAdd = modal.querySelector('.btn-confirm-add-food');
        if(btnConfirmAdd) {
            btnConfirmAdd.onclick = function() {
                const selectedFoodId = selectAllFoodsDropdown.value;
                const newQuantityInput = modal.querySelector('.input-new-food-quantity');
                const newQuantity = parseInt(newQuantityInput.value);

                if (!selectedFoodId) {
                    alert('Vui lòng chọn một món ăn.');
                    return;
                }
                if (isNaN(newQuantity) || newQuantity < 1) {
                    alert('Vui lòng nhập số lượng hợp lệ.');
                    return;
                }

                const foodToAdd = allRestaurantFoods.find(f => f.id == selectedFoodId);
                if (foodToAdd) {
                    // Kiểm tra xem món đã có trong currentBookingItems chưa
                    const existingItemIndex = currentBookingItems.findIndex(item => (item.food_id || item.id) == selectedFoodId);
                    if (existingItemIndex > -1) {
                        // Nếu đã có, cộng dồn số lượng
                        currentBookingItems[existingItemIndex].num += newQuantity;
                    } else {
                        // Nếu chưa có, thêm mới
                        currentBookingItems.push({
                            food_id: foodToAdd.id, // hoặc food_id tùy theo cấu trúc data
                            food_name: foodToAdd.name,
                            num: newQuantity,
                            food_price: foodToAdd.price
                        });
                    }
                    renderUpdateFoodList();
                    newQuantityInput.value = '1'; // Reset input số lượng
                    selectAllFoodsDropdown.value = ''; // Reset dropdown
                    addFoodFormContainer.style.display = 'none'; // Ẩn form sau khi thêm
                }
            }
        }


        // Nút "Lưu thay đổi"
        const btnSave = modal.querySelector('.btn-save-updated-booking');
        if(btnSave) {
            btnSave.onclick = async function() {
                const bookingId = this.dataset.bid;
                // Chuẩn bị dữ liệu gửi đi
                const itemsToUpdate = currentBookingItems.map(item => ({
                    food_id: item.food_id || item.id, // Đảm bảo gửi đúng ID
                    quantity: item.num
                }));

                console.log('Dữ liệu gửi đi để cập nhật:', { bookingId, items: itemsToUpdate });

                try {
                    const response = await fetch('<?php echo $path; ?>restaurant/booking/updateItems/' + bookingId, {
                        method: 'POST', // Hoặc PUT
                        headers: {
                            'Content-Type': 'application/json',
                            // Nếu có CSRF token, thêm vào đây
                        },
                        body: JSON.stringify({ items: itemsToUpdate })
                    });
                    const result = await response.json();

                    if (result.success) {
                        alert('Cập nhật đơn hàng thành công!');
                        // Đóng modal
                        var currentModalInstance = bootstrap.Modal.getInstance(modal);
                        if (currentModalInstance) {
                            currentModalInstance.hide();
                        }
                        // Tùy chọn: Tải lại danh sách booking hoặc cập nhật dòng hiện tại
                        // location.reload(); // Cách đơn giản nhất
                    } else {
                        alert('Lỗi: ' + (result.message || 'Không thể cập nhật đơn hàng.'));
                    }
                } catch (error) {
                    console.error('Lỗi khi lưu cập nhật booking:', error);
                    alert('Đã xảy ra lỗi. Vui lòng thử lại.');
                }
            }
        }


        // Reset khi modal ẩn (để đảm bảo dữ liệu mới khi mở lại)
        modal.addEventListener('hidden.bs.modal', function () {
            foodListContainer.innerHTML = ''; // Xóa danh sách món ăn
            addFoodFormContainer.style.display = 'none';
            if(selectAllFoodsDropdown) selectAllFoodsDropdown.value = '';
            const newQuantityInput = modal.querySelector('.input-new-food-quantity');
            if(newQuantityInput) newQuantityInput.value = '1';
            currentBookingItems = [];
            estimatedTotalPriceSpan.textContent = '0';
            // Không cần reset allRestaurantFoods vì nó được dùng chung
        });
    });
});
</script>
