<div class="container py-5">

  <nav aria-label="breadcrumb" style="background-color: #f8f9fa; border-radius: 10px;">
    <div class="container">
      <ol class="py-3 mb-0 breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo $path ?>user/home/homepage" class="text-decoration-none" style="color: #666;">
            <i class="bi bi-house-door-fill me-1"></i>Trang chủ
          </a>
        </li>
        <li class="breadcrumb-item">
          <a href="<?php echo $path ?>user/restaurant/list_res/<?php echo $data['restaurant']['cate_id'] ?>"
            class="text-decoration-none" style="color: #666;">
            <i class="bi bi-grid-fill me-1"></i><?php echo $data['category_name'] ?>
          </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          <i class="bi bi-shop me-1"></i><?php echo $data['restaurant']['restaurant_name']; ?>
        </li>
      </ol>
    </div>
  </nav>

  <!-- Restaurant Header -->
  <div class="mt-4 mb-4 card" style="border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
    <div class="p-4 card-body">
      <h2 class="mb-4 text-uppercase" style="color: #2c3e50;">
        <?php echo $data['restaurant']['restaurant_name'] ?>
      </h2>

      <!-- Image -->
      <div class="mb-4">
        <img src="<?php echo $data['restaurant']['avatar'] ?>" class="w-100" alt="<?php echo $data['restaurant']['restaurant_name'] ?>">
      </div>

      <!-- Restaurant Info -->


      <!-- Booking Button -->
      <div class="text-center">
        <a href="<?php echo $path ?>user/restaurant/booking/<?php echo $data['restaurant']['rid'] ?>"
          class="px-5 btn btn-lg"
          style="background: #e74c3c; color: white; border-radius: 30px; transition: all 0.3s ease;">
          <i class="bi bi-calendar-check me-2"></i>Đặt nhà hàng ngay
        </a>
      </div>
    </div>
  </div>

  <!-- Tabs Section -->
  <div class="mt-5 card" style="border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
    <div class="p-4 card-body">

      <div class="mb-5 d-flex align-items-center">

        <span class="fs-2 fw-bold text-uppercase">Tổng quan</span>
      </div>

      <div class="p-4" style="background: #f8f9fa; border-radius: 10px;">
        <h4 class="mb-4" style="color: #2c3e50;">Giới thiệu</h4>
        <p class="mb-4"><?php echo $data['restaurant']['description'] ?></p>

        <div class="mb-4 row g-4">
          <div class="col-md-4">
            <div class="card h-100" style="border: none; background: white; border-radius: 10px;">
              <div class="card-body">
                <h5 class="card-title" style="color: #2ecc71;">
                  <i class="bi bi-check-circle me-2"></i>Bao gồm
                </h5>
                <p class="card-text"><?php echo $data['restaurant']['res_include'] ?></p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card h-100" style="border: none; background: white; border-radius: 10px;">
              <div class="card-body">
                <h5 class="card-title" style="color: #e74c3c;">
                  <i class="bi bi-x-circle me-2"></i>Không bao gồm
                </h5>
                <p class="card-text"><?php echo $data['restaurant']['res_exclude'] ?></p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="card h-100" style="border: none; background: white; border-radius: 10px;">
              <div class="card-body">
                <h5 class="card-title" style="color: #3498db;">
                  <i class="bi bi-exclamation-circle me-2"></i>Yêu cầu
                </h5>
                <p class="card-text"><?php echo $data['restaurant']['res_condition'] ?></p>
              </div>
            </div>
          </div>
        </div>
        <div class="mb-4 row g-3">
          <div class="col-md-4">
            <div class="p-3 d-flex align-items-center" style="background: white; border-radius: 10px;">
              <i class="bi bi-clock fs-4 me-3" style="color: #3498db;"></i>
              <div>
                <p class="mb-0 text-muted">Giờ mở cửa</p>
                <p class="mb-0 fw-bold"><?php echo $data['restaurant']['open_time'] ?></p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="p-3 d-flex align-items-center" style="background: white; border-radius: 10px;">
              <i class="bi bi-geo-alt fs-4 me-3" style="color: #e74c3c;"></i>
              <div>
                <p class="mb-0 text-muted">Địa chỉ</p>
                <p class="mb-0 fw-bold"><?php echo $data['restaurant']['address'] ?></p>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="p-3 d-flex align-items-center" style="background: white; border-radius: 10px;">
              <i class="bi bi-star-fill fs-4 me-3" style="color: #f1c40f;"></i>
              <div>
                <p class="mb-0 text-muted">Đánh giá</p>
                <div>
                  <?php for ($i = 0; $i < $data['restaurant']['res_rate']; $i++) { ?>
                    <i class="bi bi-star-fill" style="color: #f1c40f;"></i>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <!--Food-->

  <!--Food-->
  <div class="mt-5 mb-5" style="border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
    <div class="p-4 card-body">
      <div class="mb-5 d-flex justify-content-between align-items-center">
        <div>

          <span class="fs-2 fw-bold text-uppercase">Thực đơn nhà hàng</span>
        </div>

        <div class="dropdown">
          <button class="btn btn-secondary dropdown-toggle fixed-width-btn" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
            Danh mục món ăn
          </button>
          <ul class="dropdown-menu fixed-width-menu">
            <li><a class="dropdown-item" href="#" data-category-id="all" style="cursor: pointer;">Tất cả món ăn</a></li>
            <?php if (!empty($data['cate_res'])) {
              foreach ($data['cate_res'] as $category) { ?>
                <li><a class="dropdown-item" href="#" data-category-id="<?php echo $category['cate_res_id'] ?>" style="cursor: pointer;"><?php echo $category['cate_res_name'] ?></a></li>
            <?php }
            } ?>
          </ul>
        </div>
      </div>

      <?php if (!empty($data['food'])) { ?>
        <div class="table-responsive" style="height: 450px; overflow-y: auto;">
          <table class="table table-hover">
            <thead style="position: sticky; top: 0; background: white; z-index: 1;">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Tên món</th>
                <th scope="col" class="text-end">Giá</th>
              </tr>
            </thead>
            <tbody id="foodTableBody">
              <?php
              $count = 1;
              foreach ($data['food'] as $food) { ?>
                <tr data-food-category="<?php echo $food['food_cate'] ?>">
                  <th scope="row"><?php echo $count++ ?></th>
                  <td><?php echo $food['food_name'] ?></td>
                  <td class="text-end"><?php echo number_format($food['food_price'], 0, ',', '.') ?> VNĐ</td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      <?php } else { ?>
        <div class="text-center text-muted">
          <p>Chưa có món ăn nào được thêm vào</p>
        </div>
      <?php } ?>
    </div>
  </div>




  <div class="mt-4 card" style="border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
    <div class="p-4 card-body">
      <h4 class="mb-4" style="color: #2c3e50;">Đánh giá & Bình luận</h4>

      <!-- Comment Form -->
      <form action="" method="post" class="mb-5">
        <div class="row g-3">
          <div class="col-md-4">
            <div class="form-floating">
              <input type="text" class="form-control" name="fullname" id="name" placeholder="Họ tên">
              <label for="name">Họ tên</label>
            </div>
            <p class="text-danger small">* <?php echo $data['fullname_error'] ?></p>
          </div>
          <div class="col-md-4">
            <div class="form-floating">
              <input type="email" class="form-control" name="email" id="email" placeholder="Email">
              <label for="email">Email</label>
            </div>
            <p class="text-danger small">* <?php echo $data['email_error'] ?></p>
          </div>
          <div class="col-md-4">
            <div class="form-floating">
              <input type="tel" class="form-control" name="phone_number" id="phone" placeholder="Số điện thoại">
              <label for="phone">Số điện thoại</label>
            </div>
            <p class="text-danger small">* <?php echo $data['phone_error'] ?></p>
          </div>
          <div class="col-12">
            <div class="form-floating">
              <textarea class="form-control" name="content" id="comment" placeholder="Bình luận"
                style="height: 100px"></textarea>
              <label for="comment">Bình luận</label>
            </div>
            <p class="text-danger small">* <?php echo $data['content_error'] ?></p>
          </div>
        </div>
        <button type="submit" class="mt-3 btn" style="background: #e74c3c; color: white;">
          <i class="bi bi-send me-2"></i>Gửi đánh giá
        </button>
      </form>

      <!-- Comments List -->
      <?php if ($data['comment']) {
        foreach ($data['comment'] as $comment) { ?>
          <div class="mb-3 card" style="border: none; background: #f8f9fa; border-radius: 10px;">
            <div class="card-body">
              <div class="mb-2 d-flex justify-content-between">
                <h6 class="mb-2 card-subtitle fw-bold"><?php echo $comment['name'] ?></h6>
                <small class="text-muted"><?php echo $comment['time'] ?></small>
              </div>
              <p class="mb-2 card-text"><?php echo $comment['cmt'] ?></p>
              <?php if ($comment['reply'] != '') { ?>
                <div class="p-3 ms-4" style="background: white; border-radius: 10px;">
                  <div class="mb-2 d-flex align-items-center">
                    <i class="bi bi-person-circle me-2"></i>
                    <h6 class="mb-0">Admin</h6>
                  </div>
                  <p class="mb-0 card-text"><?php echo $comment['reply'] ?></p>
                </div>
              <?php } ?>
            </div>
          </div>
        <?php }
      } else { ?>
        <div class="text-center text-muted">Chưa có bình luận nào</div>
      <?php } ?>
    </div>
  </div>
</div>

<!-- Comments Section -->

</div>

<style>
  .table-responsive::-webkit-scrollbar {
    width: 8px;
  }

  .table-responsive::-webkit-scrollbar-track {
    background: #f1f1f1;
    border-radius: 4px;
  }

  .table-responsive::-webkit-scrollbar-thumb {
    background: #888;
    border-radius: 4px;
  }

  .table-responsive::-webkit-scrollbar-thumb:hover {
    background: #555;
  }

  /* Đảm bảo header luôn có nền trắng và border phù hợp */
  .table thead th {
    background: white;
    border-bottom: 2px solid #dee2e6;
  }

  /* Style cho các dòng trong bảng */
  .table tbody tr {
    transition: background-color 0.2s;
  }

  .table tbody tr:hover {
    background-color: #f8f9fa;
  }

  .fixed-width-btn {
    width: 200px;
    text-align: left;
    white-space: nowrap;
    overflow: hidden;
    text-overflow: ellipsis;
    position: relative;
    padding-right: 30px;
    /* Tạo khoảng trống cho mũi tên */
  }

  .fixed-width-menu {
    width: 200px;
  }

  /* Style cho mũi tên dropdown */
  .dropdown-toggle::after {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
  }
</style>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const dropdownItems = document.querySelectorAll('.dropdown-item');
    const dropdownButton = document.getElementById('dropdownMenuButton');
    const foodTableBody = document.getElementById('foodTableBody');
    let count = 1;

    dropdownItems.forEach(item => {
      item.addEventListener('click', function(e) {
        e.preventDefault();
        const categoryId = this.getAttribute('data-category-id');
        dropdownButton.textContent = this.textContent.trim();

        // Lọc các món ăn
        const rows = foodTableBody.getElementsByTagName('tr');
        count = 1; // Reset số thứ tự

        Array.from(rows).forEach(row => {
          const foodCategory = row.getAttribute('data-food-category');
          if (categoryId === 'all' || foodCategory === categoryId) {
            row.style.display = '';
            row.querySelector('th').textContent = count++;
          } else {
            row.style.display = 'none';
          }
        });
      });
    });
  });
</script>