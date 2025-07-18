

<div class="container py-5">

  <nav aria-label="breadcrumb" style="background-color: #f8f9fa; border-radius: 10px;">
    <div class="container">
      <ol class="py-3 mb-0 breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo $path ?>user/home/homepage" class="text-decoration-none" style="color: #666;">
            <i class="bi bi-house-door-fill me-1"></i>Trang chủ
          </a>
        </li>
        <li class="breadcrumb-item active"><i class="bi bi-shop me-1"></i>Nhà hàng</li>
      </ol>
    </div>
  </nav>

  <!-- Header Section -->
  <div class="mb-5 text-center">
    <h2 class="text-uppercase fw-bold position-relative d-inline-block" style="color: #2c3e50;">
      <?php echo $data['category_name'] ?>
      <div style="height: 4px; width: 50px; background: #e74c3c; margin: 15px auto;"></div>
    </h2>
  </div>

  <!-- Restaurant List -->
  <div class="row g-4">
    <?php if ($data['restaurant']) {
      foreach ($data['restaurant'] as $res) { ?>
        <div class="col-md-6 col-lg-4">
          <div class="card h-100"
            style="border-radius: 15px; overflow: hidden; box-shadow: 0 5px 15px rgba(0,0,0,0.1); transition: all 0.3s ease;">
            <!-- Restaurant Image -->
            <div class="position-relative">
              <img src="<?php echo $res['avatar'] ?>" class="card-img-top" style="height: 250px; object-fit: cover;"
                alt="<?php echo $res['restaurant_name'] ?>">

            </div>

            <!-- Restaurant Info -->
            <div class="p-4 card-body">
              <h5 class="mb-3 card-title">
                <a href="<?php echo $path ?>user/restaurant/restaurant_detail/<?php echo $res['rid'] ?>"
                  class="text-decoration-none" style="color: #2c3e50;">
                  <?php echo $res['restaurant_name'] ?>
                </a>
              </h5>

              <!-- Stats Row -->
              <div class="mb-4 d-flex justify-content-between" style="color: #666;">
                <div class="d-flex align-items-center">
                  <i class="bi bi-bag-check me-2"></i>
                  <span><?php echo $res['booking_num'] ?> đặt bàn</span>
                </div>
                <div class="d-flex align-items-center">
                  <i class="bi bi-eye me-2"></i>
                  <span><?php echo $res['views_num'] ?></span>
                </div>
                <div class="d-flex align-items-center">
                  <i class="bi bi-chat me-2"></i>
                  <span><?php echo $res['comments_num'] ?></span>
                </div>
              </div>

              <!-- Action Button -->
              <div class="d-grid">
                <a href='<?php echo $path ?>user/restaurant/booking/<?php echo $res['rid'] ?>' class="btn btn-primary"
                  style="background: #e74c3c; border: none; padding: 12px; border-radius: 10px; transition: all 0.3s ease;">
                  <i class="bi bi-calendar-check me-2"></i>Đặt nhà hàng ngay
                </a>
              </div>
            </div>
          </div>
        </div>
      <?php } ?>

      <!-- Pagination -->
      <div class="mt-5 d-flex justify-content-center">
        <nav aria-label="Page navigation">
          <ul class="pagination" style="gap: 5px;">
            <!-- Previous Button -->
            <li class="page-item <?php if ($data['currentPage'] == 1) {
              echo "disabled";
            } ?>">
              <a href="<?php echo $path ?>user/restaurant/list_res/<?php echo $data['category_id'] ?>/<?php echo $data['currentPage'] - 1 ?>/<?php echo $data['search'] ?>"
                class="page-link" style="border-radius: 8px; color: #e74c3c; border: 1px solid #e74c3c;">
                <i class="bi bi-chevron-left"></i>
              </a>
            </li>

            <!-- Page Numbers -->
            <?php for ($i = 1; $i <= $data['maxPage']; $i++) { ?>
              <li class="page-item <?php if ($i == $data['currentPage']) {
                echo 'active';
              } ?>">
                <a <?php if ($i != $data['currentPage']) { ?>
                    href="<?php echo $path ?>user/restaurant/list_res/<?php echo $data['category_id'] ?>/<?php echo $i ?>/<?php echo $data['search'] ?>"
                  <?php } ?> class="page-link" style="border-radius: 8px; <?php if ($i == $data['currentPage']) {
                       echo 'background: #e74c3c; border-color: #e74c3c;';
                     } else {
                       echo 'color: #e74c3c; border: 1px solid #e74c3c;';
                     } ?>">
                  <?php echo $i ?>
                </a>
              </li>
            <?php } ?>

            <!-- Next Button -->
            <li class="page-item <?php if ($data['currentPage'] == $data['maxPage']) {
              echo "disabled";
            } ?>">
              <a href="<?php echo $path ?>user/restaurant/list_res/<?php echo $data['category_id'] ?>/<?php echo $data['currentPage'] + 1 ?>/<?php echo $data['search'] ?>"
                class="page-link" style="border-radius: 8px; color: #e74c3c; border: 1px solid #e74c3c;">
                <i class="bi bi-chevron-right"></i>
              </a>
            </li>
          </ul>
        </nav>
      </div>

    <?php } else { ?>
      <!-- No Results Message -->
      <div class="py-5 text-center">
        <i class="bi bi-search" style="font-size: 3rem; color: #ccc;"></i>
        <h4 class="mt-3" style="color: #666;">Không tìm thấy kết quả phù hợp</h4>
      </div>
    <?php } ?>
  </div>
</div>