<?php
if (isset($_SESSION['user-id'])) {
  $user_id = $_SESSION['user-id'];
}
?><head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>5SRestaurant</title>

  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,700;1,100;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="<?php echo $path ?>/css/page.css">
  <link rel="stylesheet" href="<?php echo $path ?>/css/style.css">
  <link rel="stylesheet" href="<?php echo $path ?>/css/user.css">
  <link rel="stylesheet" href="<?php echo $path ?>/css/responsive.css">
  <style>
    .has-fixed-nav {
      padding-top: 76px;
    }
    .modern-navbar {
      background-image: linear-gradient(to right, #0d6efd, #0dcaf0);
      padding: 0.8rem 1rem;
      box-shadow: 0 4px 6px rgba(0, 0, 0, 0.05), 0 1px 3px rgba(0, 0, 0, 0.1);
    }
    .modern-navbar .navbar-brand {
      font-weight: 600;
      letter-spacing: 0.5px;
      padding: 0.5rem 1rem;
      border-radius: 8px;
      transition: all 0.3s ease;
    }
    .modern-navbar .navbar-brand:hover {
      background-color: rgba(255, 255, 255, 0.1);
    }
    .modern-navbar .nav-link {
      font-weight: 500;
      padding: 0.8rem 1.2rem !important;
      border-radius: 8px;
      margin: 0 0.5rem;
      transition: all 0.3s ease;
      position: relative;
    }
    .modern-navbar .nav-link:hover {
      background-color: rgba(255, 255, 255, 0.1);
      transform: translateY(-2px);
    }
    .modern-navbar .nav-link.active {
      background-color: rgba(255, 255, 255, 0.2);
      font-weight: 600;
    }
    .modern-navbar .nav-link.active::after {
      content: '';
      position: absolute;
      bottom: 0;
      left: 50%;
      transform: translateX(-50%);
      width: 1.5rem;
      height: 3px;
      background-color: white;
      border-radius: 3px;
    }
    .modern-navbar .dropdown-menu {
      border-radius: 12px;
      box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
      border: none;
      padding: 0.5rem;
      margin-top: 0.8rem;
    }
    .modern-navbar .dropdown-item {
      padding: 0.8rem 1rem;
      border-radius: 8px;
      transition: all 0.2s ease;
    }
    .modern-navbar .dropdown-item:hover {
      background-color: rgba(13, 110, 253, 0.08);
      transform: translateX(5px);
    }
    .modern-navbar .dropdown-divider {
      margin: 0.5rem 0;
    }
    .center-nav-items {
      display: flex;
      justify-content: center;
      width: 100%;
    }
    @media (max-width: 991.98px) {
      .modern-navbar .nav-link {
        margin: 0.5rem 0;
      }
      .modern-navbar .nav-link.active::after {
        display: none;
      }
      .center-nav-items {
        width: auto;
        justify-content: flex-start;
      }
    }
  </style>
</head>


<!-- CONTENT CỦA TRANG CHỦ -->
<div class="container py-5">
  <nav aria-label="breadcrumb" style="background-color: #f8f9fa; border-radius: 10px;">
    <div class="container">
      <ol class="py-3 mb-0 breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo $path ?>user/home/homepage" class="text-decoration-none" style="color: #666;">
            <i class="bi bi-house-door-fill me-1"></i>Trang chủ
          </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          <i class="bi bi-shop me-1"></i><?php echo $data['restaurant']['restaurant_name']; ?>
        </li>
      </ol>
    </div>
  </nav>
  <div class="mt-4 mb-4 card" style="border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
    <div class="p-4 card-body">
      <div class="mb-4 d-flex justify-content-between align-items-center">
        <h2 class="mb-0 text-uppercase" style="color: #2c3e50;">
          <?php echo $data['restaurant']['restaurant_name'] ?>
        </h2>
      </div>
      <div class="mb-4 position-relative">
        <img src="<?php echo $data['restaurant']['avatar'] ?>" class="w-100" alt="<?php echo $data['restaurant']['restaurant_name'] ?>">
        <button class="bottom-0 m-3 btn btn-primary position-absolute end-0" data-bs-toggle="modal" data-bs-target="#editImageModal">
          <i class="bi bi-image me-1"></i>Sửa ảnh
        </button>
      </div>
    </div>
  </div>
  <div class="mt-5 card" style="border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
    <div class="p-4 card-body">
      <div class="mb-5 d-flex justify-content-between align-items-center">
        <span class="fs-2 fw-bold text-uppercase">Tổng quan</span>
        <button class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#editOverviewModal">
          <i class="bi bi-pencil-square me-1"></i>Sửa thông tin
        </button>
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
                <h5 class="card-title" style="color: #2ecc71 ;">
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
  <div class="mt-5 mb-5" style="border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1);">
    <div class="p-4 card-body">
      <div class="mb-5 d-flex justify-content-between align-items-center">
        <div>
          <span class="fs-2 fw-bold text-uppercase">Thực đơn nhà hàng</span>
        </div>
        <div class="gap-2 d-flex">
          <button class="btn btn-success" id="addFoodBtnMain">
            <i class="bi bi-plus-circle me-1"></i>Thêm món ăn
          </button>
          <div class="dropdown" id="foodCategoryFilterDropdown">
            <button class="btn btn-secondary dropdown-toggle fixed-width-btn" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
              Danh mục món ăn
            </button>
            <ul class="dropdown-menu fixed-width-menu" aria-labelledby="dropdownMenuButton">
              <li><a class="dropdown-item" href="#" data-category-id="all" style="cursor: pointer;">Tất cả món ăn</a></li>
              <?php
              if (!empty($data['cate_res'])) {
                foreach ($data['cate_res'] as $category) {
                  if (isset($category['status']) && $category['status'] == 1) {
              ?>
                    <li><a class="dropdown-item" href="#" data-category-id="<?php echo htmlspecialchars($category['cate_res_id']); ?>" style="cursor: pointer;"><?php echo htmlspecialchars($category['cate_res_name']); ?></a></li>
              <?php
                  }
                }
              }
              ?>
              <li>
                <hr class="dropdown-divider">
              </li>
              <li><a class="dropdown-item text-primary" href="#" data-bs-toggle="modal" data-bs-target="#editCategoriesModal">
                  <i class="bi bi-gear-fill me-1"></i>Quản lý danh mục
                </a></li>
            </ul>
          </div>
        </div>
      </div>
      <h4 class="mt-4">Món ăn đang hiện</h4>
      <?php if (!empty($data['food_show'])) { ?>
        <div class="table-responsive" style="height: 300px; overflow-y: auto;">
          <table class="table table-hover">
            <thead style="position: sticky; top: 0; background: white; z-index: 1; ">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Tên món</th>
                <th scope="col" class="text-end">Giá</th>
                <th scope="col" class="text-end">Hành động</th>
              </tr>
            </thead>
            <tbody>
              <?php $count = 1;
              foreach ($data['food_show'] as $food) { ?>
                <tr data-food-category="<?php echo $food['food_cate'] ?>">
                  <th scope="row"><?php echo $count++ ?></th>
                  <td><?php echo $food['food_name'] ?></td>
                  <td class="text-end"><?php echo number_format($food['food_price'], 0, ',', '.') ?> VNĐ</td>
                  <td class="text-end">
                    <button class="btn btn-sm btn-outline-primary me-1 edit-food-btn" data-food-id="<?php echo $food['fid']; ?>" data-food-name="<?php echo htmlspecialchars($food['food_name']); ?>" data-food-price="<?php echo $food['food_price']; ?>" data-food-category="<?php echo $food['food_cate']; ?>">
                      <i class="bi bi-pencil"></i>
                    </button>
                    <a href="<?php echo $path ?>restaurant/food/hideFood/<?php echo $food['fid']; ?>" class="btn btn-sm btn-outline-warning">Ẩn</a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      <?php } else { ?>
        <div class="text-center text-muted">
          <p>Không có món ăn nào đang hiện</p>
        </div>
      <?php } ?>
      <h4 class="mt-4">Món ăn bị ẩn</h4>
      <?php if (!empty($data['food_hide'])) { ?>
        <div class="table-responsive" style="height: 200px; overflow-y: auto;">
          <table class="table table-hover">
            <thead style="position: sticky; top: 0; background: white; z-index: 1; ">
              <tr>
                <th scope="col">#</th>
                <th scope="col">Tên món</th>
                <th scope="col" class="text-end">Giá</th>
                <th scope="col" class="text-end">Hành động</th>
              </tr>
            </thead>
            <tbody>
              <?php $count = 1;
              foreach ($data['food_hide'] as $food) { ?>
                <tr data-food-category="<?php echo $food['food_cate'] ?>">
                  <th scope="row"><?php echo $count++ ?></th>
                  <td><?php echo $food['food_name'] ?></td>
                  <td class="text-end"><?php echo number_format($food['food_price'], 0, ',', '.') ?> VNĐ</td>
                  <td class="text-end">
                    <a href="<?php echo $path ?>restaurant/food/showFood/<?php echo $food['fid']; ?>" class="btn btn-sm btn-outline-success">Hiện lại</a>
                  </td>
                </tr>
              <?php } ?>
            </tbody>
          </table>
        </div>
      <?php } else { ?>
        <div class="text-center text-muted">
          <p>Không có món ăn nào bị ẩn</p>
        </div>
      <?php } ?>
    </div>
  </div>
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
  .table thead th {
    background: white;
    border-bottom: 2px solid #dee2e6;
  }
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
  }
  .fixed-width-menu {
    width: 200px;
  }
  .dropdown-toggle::after {
    position: absolute;
    right: 10px;
    top: 50%;
    transform: translateY(-50%);
  }
</style>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const foodCategoryDropdown = document.getElementById('foodCategoryFilterDropdown');
    const foodCategoryButton = document.getElementById('dropdownMenuButton');

    if (foodCategoryDropdown && foodCategoryButton) {
        const foodCategoryItems = foodCategoryDropdown.querySelectorAll('.dropdown-item');

        foodCategoryItems.forEach(item => {
            item.addEventListener('click', function(e) {
                const categoryId = this.getAttribute('data-category-id');
                const href = this.getAttribute('href');
                const isModalToggle = this.getAttribute('data-bs-toggle') === 'modal';

                if (href === '#' && categoryId !== null && !isModalToggle) {
                    e.preventDefault();
                }

                if (categoryId !== null && !isModalToggle) {
                    foodCategoryButton.textContent = this.textContent.trim();

                    document.querySelectorAll('h4').forEach(h4 => {
                        if (h4.textContent.includes('Món ăn đang hiện')) {
                            const table = h4.nextElementSibling.querySelector('tbody');
                            if (table) {
                                const visibleRows = table.getElementsByTagName('tr');
                                let visibleCount = 1;
                                Array.from(visibleRows).forEach(row => {
                                    const foodCategory = row.getAttribute('data-food-category');
                                    if (categoryId === 'all' || foodCategory === categoryId) {
                                        row.style.display = '';
                                        row.querySelector('th').textContent = visibleCount++;
                                    } else {
                                        row.style.display = 'none';
                                    }
                                });
                            }
                        }
                    });
                    document.querySelectorAll('h4').forEach(h4 => {
                        if (h4.textContent.includes('Món ăn bị ẩn')) {
                            const table = h4.nextElementSibling.querySelector('tbody');
                            if (table) {
                                const hiddenRows = table.getElementsByTagName('tr');
                                let hiddenCount = 1;
                                Array.from(hiddenRows).forEach(row => {
                                    const foodCategory = row.getAttribute('data-food-category');
                                    if (categoryId === 'all' || foodCategory === categoryId) {
                                        row.style.display = '';
                                        row.querySelector('th').textContent = hiddenCount++;
                                    } else {
                                        row.style.display = 'none';
                                    }
                                });
                            }
                        }
                    });
                }
            });
        });
    }

    const addFoodBtnMain = document.getElementById('addFoodBtnMain');
    if (addFoodBtnMain) {
      addFoodBtnMain.onclick = function() {
        const editMenuModalEl = document.getElementById('editMenuModal');
        if (editMenuModalEl) {
            new bootstrap.Modal(editMenuModalEl).show();
        }
      };
    }

    const hideCategoryBtns = document.querySelectorAll('.hide-category-btn');
    hideCategoryBtns.forEach(btn => {
      btn.addEventListener('click', function() {
        const categoryId = this.getAttribute('data-category-id');
        const categoryName = this.getAttribute('data-category-name');
        const deleteConfirmModalEl = document.getElementById('deleteConfirmModal');
        if(deleteConfirmModalEl) {
            document.getElementById('deleteConfirmText').textContent = `Bạn có chắc chắn muốn ẩn danh mục "${categoryName}"?`;
            document.getElementById('deleteItemId').value = categoryId;
            document.getElementById('deleteItemForm').action = `<?php echo $path ?>restaurant/category/hideCategory/${categoryId}`;
            const deleteModal = new bootstrap.Modal(deleteConfirmModalEl);
            deleteModal.show();
        }
      });
    });

    const showCategoryBtns = document.querySelectorAll('.show-category-btn');
    showCategoryBtns.forEach(btn => {
      btn.addEventListener('click', function() {
        const categoryId = this.getAttribute('data-category-id');
        const categoryName = this.getAttribute('data-category-name');
        const deleteConfirmModalEl = document.getElementById('deleteConfirmModal');
         if(deleteConfirmModalEl) {
            document.getElementById('deleteConfirmText').textContent = `Bạn có chắc chắn muốn hiện danh mục "${categoryName}"?`;
            document.getElementById('deleteItemId').value = categoryId;
            document.getElementById('deleteItemForm').action = `<?php echo $path ?>restaurant/category/showCategory/${categoryId}`;
            const deleteModal = new bootstrap.Modal(deleteConfirmModalEl);
            deleteModal.show();
        }
      });
    });

    const restaurantImage = document.getElementById('restaurantImage');
    const imagePreview = document.getElementById('imagePreview');
    if (restaurantImage && imagePreview) {
      restaurantImage.addEventListener('change', function() {
        const file = this.files[0];
        if (file) {
          const reader = new FileReader();
          reader.onload = function(e) {
            imagePreview.src = e.target.result;
            imagePreview.classList.remove('d-none');
          }
          reader.readAsDataURL(file);
        }
      });
    }

    const addFoodForm = document.getElementById('addFoodForm');
    const cancelAddFood = document.getElementById('cancelAddFood');
    if (addFoodForm && cancelAddFood) {
      cancelAddFood.addEventListener('click', function() {
        const modalElement = document.getElementById('editMenuModal');
        if (modalElement) {
            const modalInstance = bootstrap.Modal.getInstance(modalElement);
            if (modalInstance) {
              modalInstance.hide();
            }
        }
      });
    }

    const addCategoryBtn = document.getElementById('addCategoryBtn');
    const addCategoryForm = document.getElementById('addCategoryForm');
    const cancelAddCategory = document.getElementById('cancelAddCategory');
    if (addCategoryBtn && addCategoryForm && cancelAddCategory) {
      addCategoryBtn.addEventListener('click', function() {
        addCategoryForm.classList.remove('d-none');
        addCategoryBtn.classList.add('d-none');
      });
      cancelAddCategory.addEventListener('click', function() {
        addCategoryForm.classList.add('d-none');
        addCategoryBtn.classList.remove('d-none');
      });
    }

    const editFoodBtns = document.querySelectorAll('.edit-food-btn');
    editFoodBtns.forEach(btn => {
      btn.addEventListener('click', function() {
        const foodId = this.getAttribute('data-food-id');
        const foodName = this.getAttribute('data-food-name');
        const foodPrice = this.getAttribute('data-food-price');
        const foodCategory = this.getAttribute('data-food-category');
        const editFoodItemModalEl = document.getElementById('editFoodItemModal');

        if(editFoodItemModalEl) {
            document.getElementById('editFoodId').value = foodId;
            document.getElementById('editFoodName').value = foodName;
            document.getElementById('editFoodPrice').value = foodPrice;
            document.getElementById('editFoodCategory').value = foodCategory;
            const editFoodModal = new bootstrap.Modal(editFoodItemModalEl);
            editFoodModal.show();
        }
      });
    });

    const editCategoryBtns = document.querySelectorAll('.edit-category-btn');
    editCategoryBtns.forEach(btn => {
      btn.addEventListener('click', function() {
        const categoryId = this.getAttribute('data-category-id');
        const categoryName = this.getAttribute('data-category-name');
        const editCategoryItemModalEl = document.getElementById('editCategoryItemModal');

        if(editCategoryItemModalEl) {
            document.getElementById('editCategoryId').value = categoryId;
            document.getElementById('editCategoryName').value = categoryName;
            const editCategoryModal = new bootstrap.Modal(editCategoryItemModalEl);
            editCategoryModal.show();
        }
      });
    });
});
</script>

<!-- CÁC MODAL -->
<div class="modal fade" id="editImageModal" tabindex="-1" aria-labelledby="editImageModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editImageModalLabel">Sửa ảnh nhà hàng</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editImageForm" action="<?php echo $path ?>restaurant/home/updateImage" method="post" enctype="multipart/form-data">
          <div class="mb-3">
            <label for="restaurantImage" class="form-label">Chọn ảnh mới</label>
            <input type="file" class="form-control" id="restaurantImage" name="restaurantImage" accept="image/*" >
          </div>
          <div class="mb-3">
            <label for="restaurantImageUrl" class="form-label">Đường dẫn ảnh</label>
            <input type="text" class="form-control" id="restaurantImageUrl" name="restaurantImageUrl" value="<?php echo htmlspecialchars($data['restaurant']['avatar']); ?>" required>
          </div>
          <div class="mb-3">
            <img id="imagePreview" src="<?php echo htmlspecialchars($data['restaurant']['avatar']); ?>" class="img-fluid <?php echo empty($data['restaurant']['avatar']) ? 'd-none' : ''; ?>" alt="Ảnh xem trước">
          </div>
          <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Hủy</button>
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="editOverviewModal" tabindex="-1" aria-labelledby="editOverviewModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editOverviewModalLabel">Sửa thông tin tổng quan</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editOverviewForm" action="<?php echo $path ?>restaurant/home/updateOverview" method="post">
          <div class="mb-3">
            <label for="restaurantName" class="form-label">Tên nhà hàng</label>
            <input type="text" class="form-control" id="restaurantName" name="restaurantName" value="<?php echo htmlspecialchars($data['restaurant']['restaurant_name']); ?>" required>
          </div>
          <div class="mb-3">
            <label for="description" class="form-label">Giới thiệu</label>
            <textarea class="form-control" id="description" name="description" rows="3" required><?php echo htmlspecialchars($data['restaurant']['description']); ?></textarea>
          </div>
          <div class="mb-3">
            <label for="include" class="form-label">Bao gồm</label>
            <textarea class="form-control" id="include" name="include" rows="3"><?php echo htmlspecialchars($data['restaurant']['res_include']); ?></textarea>
          </div>
          <div class="mb-3">
            <label for="exclude" class="form-label">Không bao gồm</label>
            <textarea class="form-control" id="exclude" name="exclude" rows="3"><?php echo htmlspecialchars($data['restaurant']['res_exclude']); ?></textarea>
          </div>
          <div class="mb-3">
            <label for="condition" class="form-label">Yêu cầu</label>
            <textarea class="form-control" id="condition" name="condition" rows="3"><?php echo htmlspecialchars($data['restaurant']['res_condition']); ?></textarea>
          </div>
          <div class="mb-3">
            <label for="openTime" class="form-label">Giờ mở cửa</label>
            <input type="text" class="form-control" id="openTime" name="openTime" value="<?php echo htmlspecialchars($data['restaurant']['open_time']); ?>" required>
          </div>
          <div class="mb-3">
            <label for="address" class="form-label">Địa chỉ</label>
            <input type="text" class="form-control" id="address" name="address" value="<?php echo htmlspecialchars($data['restaurant']['address']); ?>" required>
          </div>
          <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Hủy</button>
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="editMenuModal" tabindex="-1" aria-labelledby="editMenuModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-body">
        <form id="addFoodForm" class="p-3 mb-4 border rounded " action="<?php echo $path ?>restaurant/food/addFood" method="post">
          <h6 class="mb-3">Thêm món ăn mới</h6>
          <div class="row g-3">
            <div class="col-md-4">
              <label for="foodName" class="form-label">Tên món</label>
              <input type="text" class="form-control" id="foodName" name="foodName" required>
            </div>
            <div class="col-md-4">
              <label for="foodPrice" class="form-label">Giá (VNĐ)</label>
              <input type="number" class="form-control" id="foodPrice" name="foodPrice" min="0" required>
            </div>
            <div class="col-md-4">
              <label for="foodCategory" class="form-label">Danh mục</label>
              <select class="form-select" id="foodCategory" name="foodCategory" required>
                <?php if (!empty($data['cate_res'])) {
                  foreach ($data['cate_res'] as $category) { ?>
                    <option value="<?php echo htmlspecialchars($category['cate_res_id']); ?>"><?php echo htmlspecialchars($category['cate_res_name']); ?></option>
                <?php }
                } ?>
              </select>
            </div>
          </div>
          <div class="mt-3 d-flex justify-content-end">
            <button type="button" class="btn btn-secondary me-2" id="cancelAddFood">Hủy</button>
            <button type="submit" class="btn btn-primary">Thêm món</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="editCategoriesModal" tabindex="-1" aria-labelledby="editCategoriesModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editCategoriesModalLabel">Quản lý danh mục</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="mb-3 d-flex justify-content-end">
          <button type="button" class="btn btn-success" id="addCategoryBtn">
            <i class="bi bi-plus-circle me-1"></i>Thêm danh mục mới
          </button>
        </div>
        <form id="addCategoryForm" class="p-3 mb-4 border rounded d-none" action="<?php echo $path ?>restaurant/category/addCategory" method="post">
          <h6 class="mb-3">Thêm danh mục mới</h6>
          <div class="mb-3">
            <label for="categoryName" class="form-label">Tên danh mục</label>
            <input type="text" class="form-control" id="categoryName" name="categoryName" required>
          </div>
          <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-secondary me-2" id="cancelAddCategory">Hủy</button>
            <button type="submit" class="btn btn-primary">Thêm danh mục</button>
          </div>
        </form>
        <h4 class="mt-4">Danh mục đang hiện</h4>
        <div class="mb-4 list-group">
          <?php if (!empty($data['cate_res'])) {
            $hasVisibleCategories = false;
            foreach ($data['cate_res'] as $category) {
              if ($category['status'] == 1) {
                $hasVisibleCategories = true; ?>
                <div class="list-group-item d-flex justify-content-between align-items-center">
                  <span><?php echo htmlspecialchars($category['cate_res_name']); ?></span>
                  <div>
                    <button class="btn btn-sm btn-outline-primary me-1 edit-category-btn" data-category-id="<?php echo htmlspecialchars($category['cate_res_id']); ?>" data-category-name="<?php echo htmlspecialchars($category['cate_res_name']); ?>">
                      <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-warning hide-category-btn" data-category-id="<?php echo htmlspecialchars($category['cate_res_id']); ?>" data-category-name="<?php echo htmlspecialchars($category['cate_res_name']); ?>">
                      <i class="bi bi-eye-slash"></i>
                    </button>
                  </div>
                </div>
              <?php }
            }
            if (!$hasVisibleCategories) { ?>
              <div class="py-3 text-center text-muted">
                <p class="mb-0">Không có danh mục nào đang hiện</p>
              </div>
            <?php }
          } else { ?>
            <div class="py-3 text-center text-muted">
              <p class="mb-0">Chưa có danh mục nào</p>
            </div>
          <?php } ?>
        </div>
        <h4 class="mt-4">Danh mục đang ẩn</h4>
        <div class="list-group">
          <?php if (!empty($data['cate_res'])) {
            $hasHiddenCategories = false;
            foreach ($data['cate_res'] as $category) {
              if ($category['status'] == 0) {
                $hasHiddenCategories = true; ?>
                <div class="list-group-item d-flex justify-content-between align-items-center">
                  <span><?php echo htmlspecialchars($category['cate_res_name']); ?></span>
                  <div>
                    <button class="btn btn-sm btn-outline-primary me-1 edit-category-btn" data-category-id="<?php echo htmlspecialchars($category['cate_res_id']); ?>" data-category-name="<?php echo htmlspecialchars($category['cate_res_name']); ?>">
                      <i class="bi bi-pencil"></i>
                    </button>
                    <button class="btn btn-sm btn-outline-success show-category-btn" data-category-id="<?php echo htmlspecialchars($category['cate_res_id']); ?>" data-category-name="<?php echo htmlspecialchars($category['cate_res_name']); ?>">
                      <i class="bi bi-eye"></i>
                    </button>
                  </div>
                </div>
              <?php }
            }
            if (!$hasHiddenCategories) { ?>
              <div class="py-3 text-center text-muted">
                <p class="mb-0">Không có danh mục nào đang ẩn</p>
              </div>
            <?php }
          } else { ?>
            <div class="py-3 text-center text-muted">
              <p class="mb-0">Chưa có danh mục nào</p>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="editFoodItemModal" tabindex="-1" aria-labelledby="editFoodItemModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editFoodItemModalLabel">Sửa món ăn</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editFoodItemForm" action="<?php echo $path ?>restaurant/food/updateFood" method="post">
          <input type="hidden" id="editFoodId" name="foodId">
          <div class="mb-3">
            <label for="editFoodName" class="form-label">Tên món</label>
            <input type="text" class="form-control" id="editFoodName" name="foodName" required>
          </div>
          <div class="mb-3">
            <label for="editFoodPrice" class="form-label">Giá (VNĐ)</label>
            <input type="number" class="form-control" id="editFoodPrice" name="foodPrice" min="0" required>
          </div>
          <div class="mb-3">
            <label for="editFoodCategory" class="form-label">Danh mục</label>
            <select class="form-select" id="editFoodCategory" name="foodCategory" required>
              <?php if (!empty($data['cate_res'])) {
                foreach ($data['cate_res'] as $category) { ?>
                  <option value="<?php echo htmlspecialchars($category['cate_res_id']); ?>"><?php echo htmlspecialchars($category['cate_res_name']); ?></option>
              <?php }
              } ?>
            </select>
          </div>
          <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Hủy</button>
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="editCategoryItemModal" tabindex="-1" aria-labelledby="editCategoryItemModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="editCategoryItemModalLabel">Sửa danh mục</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="editCategoryItemForm" action="<?php echo $path ?>restaurant/category/updateCategory" method="post">
          <input type="hidden" id="editCategoryId" name="categoryId">
          <div class="mb-3">
            <label for="editCategoryName" class="form-label">Tên danh mục</label>
            <input type="text" class="form-control" id="editCategoryName" name="categoryName" required>
          </div>
          <div class="d-flex justify-content-end">
            <button type="button" class="btn btn-secondary me-2" data-bs-dismiss="modal">Hủy</button>
            <button type="submit" class="btn btn-primary">Lưu thay đổi</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>
<div class="modal fade" id="deleteConfirmModal" tabindex="-1" aria-labelledby="deleteConfirmModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="deleteConfirmModalLabel">Xác nhận </h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="deleteConfirmText">Bạn có chắc chắn muốn ẩn?</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Hủy</button>
        <form id="deleteItemForm" method="post">
          <input type="hidden" id="deleteItemId" name="itemId">
          <button type="submit" class="btn btn-danger">Đồng ý</button>
        </form>
      </div>
    </div>
  </div>
</div>