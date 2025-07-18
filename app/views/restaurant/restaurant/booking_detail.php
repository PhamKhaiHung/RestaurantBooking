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
    <div class="row">
        <div class="col-12">
            <nav aria-label="breadcrumb" class="bg-light rounded p-3 mb-4">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item">
                        <a href="<?php echo $path ?>restaurant/booking" class="text-decoration-none">
                            <i class="bi bi-arrow-left me-2"></i>Quay lại danh sách booking
                        </a>
                    </li>
                </ol>
            </nav>

            <!-- Booking Information Card -->
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-info-circle me-2"></i>Thông tin đặt bàn
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <p class="mb-2"><strong>Tên khách hàng:</strong> <?php echo htmlspecialchars($data['booking']['fullname']); ?></p>
                            <p class="mb-2"><strong>Email:</strong> <?php echo htmlspecialchars($data['booking']['email']); ?></p>
                            <p class="mb-2"><strong>Số điện thoại:</strong> <?php echo htmlspecialchars($data['booking']['phone']); ?></p>
                            <p class="mb-2"><strong>Địa chỉ:</strong> <?php echo htmlspecialchars($data['booking']['address']); ?></p>
                        </div>
                        <div class="col-md-6">
                            <p class="mb-2"><strong>Ngày đặt:</strong> <?php echo format_date_dmy($data['booking']['date']); ?></p>
                            <p class="mb-2"><strong>Số lượng người:</strong> <?php echo htmlspecialchars($data['booking']['num']); ?></p>
                            <p class="mb-2"><strong>Tổng tiền:</strong> <?php echo number_format($data['booking']['money'], 0, ',', '.'); ?> VNĐ</p>
                            <p class="mb-2">
                                <strong>Trạng thái:</strong>
                                <span class="badge <?php echo $data['booking']['status'] == '1' ? 'bg-success' : ($data['booking']['status'] == '2' ? 'bg-danger' : 'bg-warning text-dark'); ?>">
                                    <?php echo status[$data['booking']['status']]; ?>
                                </span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Food Items Card -->
            <?php if (!empty($data['food_items'])): ?>
            <div class="card shadow-sm mb-4">
                <div class="card-header bg-info text-white">
                    <h5 class="mb-0">
                        <i class="bi bi-cart me-2"></i>Danh sách món ăn đã đặt
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>STT</th>
                                    <th>Tên món</th>
                                    <th class="text-center">Số lượng</th>
                                    <th class="text-end">Đơn giá</th>
                                    <th class="text-end">Thành tiền</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $stt = 1;
                                foreach ($data['food_items'] as $item): 
                                ?>
                                <tr>
                                    <td><?php echo $stt++; ?></td>
                                    <td><?php echo htmlspecialchars($item['food_name']); ?></td>
                                    <td class="text-center"><?php echo htmlspecialchars($item['num']); ?></td>
                                    <td class="text-end"><?php echo number_format($item['food_price'], 0, ',', '.'); ?> VNĐ</td>
                                    <td class="text-end"><?php echo number_format($item['food_price'] * $item['num'], 0, ',', '.'); ?> VNĐ</td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <?php endif; ?>

            <!-- Action Buttons -->
            <?php if ($data['booking']['status'] == '0'): ?>
            <div class="d-flex justify-content-end gap-2">
                <form action="<?php echo $path ?>restaurant/booking/updateStatus/<?php echo $data['booking']['bid'] ?>" method="post" class="d-inline">
                    <input type="hidden" name="status" value="1">
                    <button type="submit" class="btn btn-success">
                        <i class="bi bi-check-circle me-2"></i>Xác nhận
                    </button>
                </form>
                <form action="<?php echo $path ?>restaurant/booking/updateStatus/<?php echo $data['booking']['bid'] ?>" method="post" class="d-inline">
                    <input type="hidden" name="status" value="2">
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-x-circle me-2"></i>Hủy
                    </button>
                </form>
            </div>
            <?php endif; ?>
        </div>
    </div>
</div> 