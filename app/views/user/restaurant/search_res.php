<div class="container py-4">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="<?php echo $path ?>">Trang chủ</a></li>
            <li class="breadcrumb-item active">Kết quả tìm kiếm</li>
        </ol>
    </nav>

    <!-- Search Results Header -->
    <div class="mb-4">
        <h4>Từ khóa "<?php echo $data['search'] ?>" | Tìm thấy: (<?php echo $data['search_count'] ?>) kết quả</h4>
    </div>

    <!-- Restaurant List -->
    <div class="row g-4">
        <?php if (!empty($data['restaurant'])) {
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

            <?php }
        } else { ?>
            <div class="text-center col-12">
                <p>Không tìm thấy kết quả phù hợp</p>
            </div>
        <?php } ?>
    </div>
</div>

<style>
    .card {
        transition: transform 0.2s;
    }

    .card:hover {
        transform: translateY(-5px);
    }

    .card-img-top {
        height: 200px;
        object-fit: cover;
    }
</style>