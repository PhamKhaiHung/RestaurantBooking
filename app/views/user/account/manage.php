<nav aria-label="breadcrumb">
    <div class="bg-body-secondary hide">
        <ol class="py-2 mx-auto w-75 breadcrumb fs-6">
            <li class="breadcrumb-item">
                <a class="text-black link-underline link-underline-opacity-0 breadcrumb__item"
                    href="<?php echo $path ?>user/home/homepage">
                    Trang chủ
                </a>
            </li>
            <li class="breadcrumb-item active">
                Tài khoản
            </li>
        </ol>
    </div>
</nav>


<div class="container py-5">
    <div class="row">
        <!-- Left Sidebar -->
        <div class="col-lg-3">
            <div class="border-0 shadow-sm card rounded-3">
                <div class="p-4 text-center card-body">
                    <div class="mb-4">
                        <img src="https://static.vecteezy.com/system/resources/previews/013/042/571/original/default-avatar-profile-icon-social-media-user-photo-in-flat-style-vector.jpg"
                            class="rounded-circle img-thumbnail"
                            style="width: 120px; height: 120px; object-fit: cover;">
                        <h5 class="mt-3 mb-0">Xin chào</h5>
                    </div>

                    <div class="list-group list-group-flush">
                        <a href="<?php echo $path ?>user/account"
                            class="py-3 list-group-item list-group-item-action d-flex align-items-center">
                            <i class="bi bi-person fs-5 me-3"></i>
                            <span>Thông tin cá nhân</span>
                        </a>
                        <a href="<?php echo $path ?>user/account/manageBooking"
                            class="py-3 list-group-item list-group-item-action d-flex align-items-center active">
                            <i class="bi bi-menu-button-wide fs-5 me-3"></i>
                            <span>Quản lý đặt nhà hàng</span>
                        </a>
                        <a href="<?php echo $path ?>user/account/changePassword"
                            class="py-3 list-group-item list-group-item-action d-flex align-items-center">
                            <i class="bi bi-lock fs-5 me-3"></i>
                            <span>Đổi mật khẩu</span>
                        </a>
                        <a href="<?php echo $path ?>user/account/logout"
                            class="py-3 list-group-item list-group-item-action d-flex align-items-center text-danger">
                            <i class="bi bi-box-arrow-right fs-5 me-3"></i>
                            <span>Đăng xuất</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="col-lg-9">
            <div class="border-0 shadow-sm card rounded-3">
                <div class="py-3 bg-white card-header d-flex justify-content-between align-items-center">
                    <h5 class="mb-0 card-title fw-bold">QUẢN LÝ ĐẶT NHÀ HÀNG</h5>
                </div>
                <div class="p-4 card-body">
                    <div class="table-responsive">
                        <table class="table table-hover">
                            <thead class="table-light">
                                <tr>
                                    <th>Tên Nhà hàng</th>
                                    <th>Ngày Booking</th>
                                    <th>Ngày khởi hành</th>
                                    <th>Trạng thái</th>
                                    <th>Tổng tiền</th>
                                    <th class="text-center">Chi tiết</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if ($data['booking']):
                                    while ($row = mysqli_fetch_assoc($data['booking'])): ?>
                                        <tr>
                                            <td class="align-middle"><?= $row['restaurant_name'] ?></td>
                                            <td class="align-middle"><?= $row['createdAt'] ?></td>
                                            <td class="align-middle"><?= $row['date'] ?></td>
                                            <td class="align-middle">
                                                <?php if ($row['status'] == 0): ?>
                                                    <span class="badge bg-warning">Đang xử lý</span>
                                                <?php elseif ($row['status'] == 1): ?>
                                                    <span class="badge bg-info">Đã xác nhận</span>
                                                <?php elseif ($row['status'] == 2): ?>
                                                    <span class="badge bg-success">Đã hoàn thành</span>
                                                <?php elseif ($row['status'] == 3): ?>
                                                    <span class="badge bg-danger">Đã hủy</span>
                                                <?php endif ?>
                                            </td>
                                            <td class="align-middle fw-medium"><?= number_format($row['money'], 0, ',', '.') ?>
                                                đ
                                            </td>
                                            <td class="text-center align-middle">
                                                <button type="button" class="btn btn-sm btn-outline-primary detail-order"
                                                    data-bs-toggle="modal" data-bs-target="#exampleModal"
                                                    data-order-id="<?= $row['bid'] ?>">
                                                    <i class="bi bi-eye me-1"></i>
                                                    Chi tiết
                                                </button>
                                            </td>
                                        </tr>
                                    <?php endwhile;
                                else: ?>
                                    <tr>
                                        <td colspan="6" class="py-4 text-center">
                                            <i class="mb-3 bi bi-inbox fs-1 text-muted d-block"></i>
                                            <p class="mb-0 text-muted">Bạn chưa đặt nhà hàng nào</p>
                                        </td>
                                    </tr>
                                <?php endif ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog d-flex align-items-center justify-content-center" id="modal-dialog-user">
            <div class="modal-content" id="modal-user">

            </div>
        </div>
    </div>
</div>
</div>
</div>
<script>
    $(document).ready(function () {

        $('.detail-order').click(function () {

            var orderid = $(this).data('order-id');


            // var userid = $('#userid').val();
            // AJAX request
            $.ajax({
                url: `logic`,
                type: 'post',
                data: {
                    // userid: userid,
                    orderid: orderid,
                },
                success: function (response) {
                    // Add response in Modal body
                    console.log("Response:", response);
                    $('.modal-content').html(response);

                    // Display Modal
                    $('#exampleModal').modal('show');
                },
                error: function (xhr, status, error) {
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>