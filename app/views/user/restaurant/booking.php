<div class="py-5 container-fluid booking" style="background-color: #f8f9fa;">
  <nav aria-label="breadcrumb" style="background-color: #f8f9fa; border-radius: 10px;">
    <div class="container">
      <ol class="py-3 mb-0 breadcrumb">
        <li class="breadcrumb-item">
          <a href="<?php echo $path ?>user/home/homepage" class="text-decoration-none" style="color: #666;">
            <i class="bi bi-house-door-fill me-1"></i>Trang chủ
          </a>
        </li>
        <li class="breadcrumb-item">
          <a href="<?php echo $path ?>user/restaurant/restaurant_detail/<?php echo $data['restaurant']['rid'] ?>"
            class="text-decoration-none" style="color: #666;">
            <i class="bi bi-shop me-1"></i><?php echo $data['restaurant']['restaurant_name'] ?>
          </a>
        </li>
        <li class="breadcrumb-item active" aria-current="page">
          <i class="bi bi-calendar-check me-1"></i>Đặt nhà hàng
        </li>
      </ol>
    </div>
  </nav>
  <div class="mx-auto w-75">
    <h2 class="mb-5 text-center position-relative">
      <span class="px-4 py-2 position-relative">
        ĐẶT NHÀ HÀNG
        <div class="bottom-0 position-absolute start-0 end-0"
          style="height: 2px; background: linear-gradient(90deg, transparent, #0dcaf0, transparent);"></div>
      </span>
    </h2>
<?php
echo "user id";
    echo $user_id;
    ?>
    <form id="bookingForm" method="post"
      action="<?php echo $path ?>user/restaurant/booking/<?php echo $data['restaurant']['rid'] ?><?php if (isset($user_id) && $user_id !== null) {
                                                                                                       echo  '/'. htmlspecialchars($user_id); 
                                                                                                   } ?>">
      <!-- Restaurant Service Section -->
      <div class="bg-white border-0 shadow-sm rounded-4"> <!-- Bỏ col-lg-8 -->
        <div class="border-bottom" style="background: linear-gradient(45deg, #0dcaf0, #0d6efd);">
          <h5 class="p-3 mb-0 text-white">
            <i class="bi bi-building me-2"></i>Dịch vụ nhà hàng
          </h5>
        </div>

        <div class="p-4">
          <!-- Restaurant Name -->
          <div class="mb-4">
            <label class="form-label text-muted">Tên nhà hàng</label>
            <input type="text" class="form-control bg-light"
              value="<?php echo $data['restaurant']['restaurant_name'] ?>" disabled>
          </div>

          <!-- Restaurant Info -->
          <div class="mb-4 row">
            <div class="col-md-4">
              <label class="form-label text-muted">Giờ mở cửa</label>
              <input type="text" class="form-control bg-light" value="<?php echo $data['restaurant']['open_time'] ?>"
                disabled>
            </div>
            <div class="col-md-4">
              <label class="form-label text-muted">Địa chỉ</label>
              <input type="text" class="form-control bg-light" value="<?php echo $data['restaurant']['address'] ?>"
                disabled>
            </div>
            <div class="col-md-4">
              <label class="form-label text-muted">Đánh giá</label>
              <input type="text" class="form-control bg-light" value="<?php echo $data['restaurant']['res_rate'] ?> sao"
                disabled>
            </div>
          </div>

          <!-- Date & Total -->
          <!-- Date & Number of People Section -->
          <div class="mb-4 row align-items-end">
            <!-- Chọn ngày đặt -->
            <div class="mb-3 col-lg-6 col-md-12 mb-lg-0"> <!-- Tăng kích thước cột cho ngày đặt -->
              <label class="form-label text-muted">Chọn ngày đặt</label>
              <small class="text-danger d-block" id="dateErrorMessage">
                <?php
                if (!empty($data['date_error'])) {
                  echo $data['date_error'];
                }
                ?>
              </small>
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="bi bi-calendar3"></i></span>
                <input required name="depart_date" id="departDateInput" type="date" class="form-control" value=""
                  min="<?php echo date('Y-m-d', strtotime('+1 day')); ?>">
              </div>
            </div>

            <!-- Số lượng người -->
            <div class="col-lg-6 col-md-12">
              <label for="numberOfPeopleInput" class="form-label text-muted">Số lượng người</label>
              <small class="text-danger d-block" id="numberOfPeopleErrorMessage">
                <?php if (!empty($data['people_error'])) {
                  echo $data['people_error'];
                }
                ?>
              </small>
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="bi bi-people-fill"></i></span> <!-- Icon có thể thay đổi -->
                <input required type="number" class="form-control" id="numberOfPeopleInput" name="number_of_people"
                  value="<?php echo isset($data['submitted_number_of_people']) ? htmlspecialchars($data['submitted_number_of_people']) : '1'; ?>" min="1">
              </div>
            </div>
          </div>
          <!-- Booking Details -->
          <div>
            <h5 class="">Thực đơn</h5>
            <?php if (!empty($data['food'])) { ?>
              <div class="table-responsive" style="height: 450px; overflow-y: auto;">
                <table class="table table-hover">
                  <thead style="position: sticky; top: 0; background: white; z-index: 1;">
                    <tr>
                      <th scope="col">#</th>
                      <th scope="col">Tên món</th>
                      <th scope="col" class="text-end">Giá</th>
                      <th scope="col" class="text-center">Chọn món</th>
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
                        <td class="text-center">
                          <div class="form-check d-flex justify-content-center">
                            <input class="form-check-input select-food"
                              type="checkbox"
                              data-food-id="<?php echo $food['fid'] ?>"
                              data-food-name="<?php echo $food['food_name'] ?>"
                              data-food-price="<?php echo $food['food_price'] ?>">
                          </div>
                        </td>
                      </tr>
                    <?php } ?>
                  </tbody>
                </table>
              </div>
            <?php } ?>

            <!-- Danh sách món đã chọn -->
            <div class="mt-4">
              <h5 class="mb-3">Danh sách món đã chọn</h5>
              <label class="form-label text-muted">* Nếu quý khách chọn món vui lòng đặt cọc 10% tổng tiền</label>
              <div class="table-responsive">
                <table class="table" id="selectedFoodsTable">
                  <thead>
                    <tr>
                      <th scope="col" style="width: 5%">#</th>
                      <th scope="col" style="width: 25%">Tên món</th>
                      <th scope="col" style="width: 20%" class="text-end">Đơn giá</th>
                      <th scope="col" style="width: 20%" class="text-center">Số lượng</th>
                      <th scope="col" style="width: 20%" class="text-end">Thành tiền</th>
                      <th scope="col" style="width: 10%" class="text-center">Thao tác</th>
                    </tr>
                  </thead>
                  <tbody id="selectedFoodsList">
                    <!-- Các món được chọn sẽ được thêm vào đây -->
                  </tbody>
                </table>
                <!-- Tổng tiền -->
                <div class="gap-3 mt-3 d-flex justify-content-end">
                  <div class="card" style="width: 300px;">
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 card-title">Tiền đặt cọc:</h6>
                        <span class="fs-5 fw-bold text-primary" id="deposit">0 VNĐ</span>
                      </div>
                    </div>
                  </div>
                  <div class="card" style="width: 300px;">
                    <div class="card-body">
                      <div class="d-flex justify-content-between align-items-center">
                        <h6 class="mb-0 card-title">Tổng tiền:</h6>
                        <span class="fs-5 fw-bold text-primary" id="totalPrice">0 VNĐ</span>
                      </div>
                    </div>
                  </div>
                  <input type="hidden" name="food_total_price" id="foodTotalPriceInput" value="0">
                </div>
              </div>
            </div>

          </div>
        </div>

        <!-- Contact Information Section -->
        <!-- Contact Information Section -->
        <div class="bg-white border-0 shadow-sm rounded-4">
          <div class="border-bottom" style="background: linear-gradient(45deg, #ffc107, #fd7e14);">
            <h5 class="p-3 mb-0 text-white">
              <i class="bi bi-person-lines-fill me-2"></i>Thông tin liên lạc
            </h5>
          </div>

          <div class="p-4">
            <div class="mb-3">
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="bi bi-person"></i></span>
                <input required type="text" class="form-control" placeholder="Họ tên" name="fullname" id="fullnameInput">
              </div>
              <small class="text-danger" id="fullnameErrorMessage">
                <?php if (!empty($data['fullname_error'])) {
                  echo $data['fullname_error'];
                } ?>
              </small>
            </div>

            <div class="mb-3">
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="bi bi-telephone"></i></span>
                <input required type="text" class="form-control" placeholder="Số điện thoại" name="phone" id="phoneInput">
              </div>
              <small class="text-danger" id="phoneErrorMessage">
                <?php if (!empty($data['phone_error'])) {
                  echo $data['phone_error'];
                } ?>
              </small>
            </div>

            <div class="mb-3">
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="bi bi-envelope"></i></span>
                <input required type="email" class="form-control" placeholder="Email" name="email" id="emailInput"> <!-- Thay đổi type thành "email" -->
              </div>
              <small class="text-danger" id="emailErrorMessage">
                <?php if (!empty($data['email_error'])) {
                  echo $data['email_error'];
                } ?>
              </small>
            </div>

            <div class="mb-4">
              <div class="input-group">
                <span class="input-group-text bg-light"><i class="bi bi-geo-alt"></i></span>
                <textarea required name="address" class="form-control" rows="3" placeholder="Địa chỉ" id="addressInput"></textarea>
              </div>
              <small class="text-danger" id="addressErrorMessage">
                <?php if (!empty($data['address_error'])) {
                  echo $data['address_error'];
                } ?>
              </small>
            </div>
            <button class="btn btn-primary w-100" type="submit">
              <i class="bi bi-check2-circle me-2"></i>Đặt nhà hàng
            </button>
          </div>
        </div>
    </form>
  </div>
</div>

<!-- Success Modal -->
<div style="<?php if ($data['isSuccess']) {
              echo 'display:block;';
            } ?>" class="modal" tabindex="-1" id="success-booking"
  aria-hidden="false">
  <div class="modal-dialog modal-dialog-centered">
    <div class="border-0 shadow modal-content">
      <div class="p-5 text-center modal-body">
        <i class="mb-4 bi bi-check-circle-fill text-success display-1"></i>
        <h4 class="mb-3 modal-title">Đặt nhà hàng thành công</h4>
        <p class="mb-4 text-muted">Cảm ơn quý khách đã tin tưởng 5SR</p>

        <?php if (!$user_id) {
         ?>
          <div class="mb-4 alert alert-info">
            <p class="mb-2">Bạn chưa có tài khoản? Đăng ký để dễ dàng quản lý đơn hàng và nhận ưu đãi!</p>
            <form id="registerForm" action="<?php echo $path ?>authen/home/registerFromBooking" method="post">
              <input type="hidden" name="fullname" value="<?php echo isset($_POST['fullname']) ? htmlspecialchars($_POST['fullname']) : ''; ?>">
              <input type="hidden" name="email" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>">
              <input type="hidden" name="phone" value="<?php echo isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : ''; ?>">
              <input type="hidden" name="address" value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?>">
              <div class="gap-3 mt-3 d-flex justify-content-center">
                <button type="submit" class="btn btn-success">
                  <i class="bi bi-person-plus me-2"></i>Đăng ký ngay
                </button>
                <a href="<?php echo $path ?>user/home/homepage" class="btn btn-outline-secondary">
                  Không, cảm ơn
                </a>
              </div>
            </form>
          </div>
        <?php } else { ?>
          <a href="<?php echo $path ?>user/home/homepage" class="px-4 btn btn-primary">
            <i class="bi bi-house me-2"></i>Về trang chủ
          </a>
        <?php } ?>
      </div>
    </div>
  </div>
</div>

<style>
  .booking {
    background-image: linear-gradient(to right top, rgba(13, 202, 240, 0.05), rgba(13, 110, 253, 0.05));
  }

  .form-control:disabled {
    background-color: #f8f9fa !important;
    opacity: 1;
  }

  .form-control:focus {
    border-color: #0dcaf0;
    box-shadow: 0 0 0 0.25rem rgba(13, 202, 240, 0.25);
  }

  .input-group-text {
    border: none;
  }

  .modal-dialog {
    margin-top: 10vh;
  }

  .quantity-input {
    min-width: 60px;
    max-width: 60px;
  }

  .btn-decrease,
  .btn-increase {
    width: 32px;
    height: 32px;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  #selectedFoodsTable th,
  #selectedFoodsTable td {
    vertical-align: middle;
  }
</style>

<script>
  document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.select-food');
    const selectedFoodsList = document.getElementById('selectedFoodsList');

    checkboxes.forEach(checkbox => {
      checkbox.addEventListener('change', function() {
        const foodId = this.dataset.foodId;
        const foodName = this.dataset.foodName;
        const foodPrice = this.dataset.foodPrice;


        if (this.checked) {
          // Thêm món vào danh sách đã chọn
          addToSelectedList(foodId, foodName, foodPrice);
        } else {
          // Xóa món khỏi danh sách
          removeFromSelectedList(foodId);
          updateTotalPrice();
        }
        updateRowNumbers();
      });
    });

    function addToSelectedList(foodId, foodName, foodPrice) {
      if (document.querySelector(`tr[data-selected-food-id="${foodId}"]`)) {
        return;
      }

      const newRow = document.createElement('tr');
      newRow.setAttribute('data-selected-food-id', foodId);
      newRow.setAttribute('data-price', foodPrice);

      newRow.innerHTML = `
            <td class="row-number"></td>
            <td>${foodName}</td>
            <td class="text-end">${formatPrice(foodPrice)} VNĐ</td>
            <td>
                <div class="gap-2 d-flex justify-content-center align-items-center">
                    <button type="button" class="btn btn-outline-secondary btn-decrease">-</button>
                    <input type="number" class="text-center form-control quantity-input" 
                           name="food_quantity[${foodId}]" 
                           value="1" 
                           min="1" 
                           style="width: 60px;">
                    <button type="button" class="btn btn-outline-secondary btn-increase">+</button>
                </div>
            </td>
            <td class="text-end food-subtotal">${formatPrice(foodPrice)} VNĐ</td>
            <td class="text-center">
                <button type="button" class="btn btn-danger btn-sm btn-remove">
                    <i class="bi bi-trash"></i>
                </button>
            </td>
        `;

      selectedFoodsList.appendChild(newRow);

      // Thêm event listeners
      const quantityInput = newRow.querySelector('.quantity-input');

      function updateSubtotal() {
        const quantity = parseInt(quantityInput.value);
        const subtotal = foodPrice * quantity;
        newRow.querySelector('.food-subtotal').textContent = formatPrice(subtotal) + ' VNĐ';
        updateTotalPrice();
      }

      newRow.querySelector('.btn-decrease').addEventListener('click', () => {
        if (quantityInput.value > 1) {
          quantityInput.value = parseInt(quantityInput.value) - 1;
          updateSubtotal();
        }
      });

      newRow.querySelector('.btn-increase').addEventListener('click', () => {
        quantityInput.value = parseInt(quantityInput.value) + 1;
        updateSubtotal();
      });

      quantityInput.addEventListener('change', () => {
        if (quantityInput.value < 1) quantityInput.value = 1;
        updateSubtotal();
      });

      newRow.querySelector('.btn-remove').addEventListener('click', () => {
        const checkbox = document.querySelector(`.select-food[data-food-id="${foodId}"]`);
        if (checkbox) checkbox.checked = false;
        newRow.remove();
        updateRowNumbers();
        updateTotalPrice();
      });

      updateRowNumbers();
      updateTotalPrice();
    }

    function removeFromSelectedList(foodId) {
      const row = document.querySelector(`tr[data-selected-food-id="${foodId}"]`);
      if (row) {
        row.remove();
        updateRowNumbers();
      }
    }

    function updateRowNumbers() {
      const rows = selectedFoodsList.querySelectorAll('tr');
      rows.forEach((row, index) => {
        row.querySelector('.row-number').textContent = index + 1;
      });
    }

    // Hàm format giá tiền
    function formatPrice(price) {
      return new Intl.NumberFormat('vi-VN').format(price);
    }

    // Hàm tính và cập nhật tổng tiền
    function updateTotalPrice() {
      let total = 0;
      const rows = selectedFoodsList.querySelectorAll('tr');

      rows.forEach(row => {
        const price = parseFloat(row.getAttribute('data-price'));
        const quantity = parseInt(row.querySelector('.quantity-input').value);
        total += price * quantity;
      });

      document.getElementById('totalPrice').textContent = formatPrice(total) + ' VNĐ';
      document.getElementById('deposit').textContent = formatPrice(total * 0.1) + ' VNĐ';
      document.getElementById('foodTotalPriceInput').value = total;
    }
    // Hàm xử lý sự kiện khi người dùng nhập vào ô nhập liệu
    const bookingForm = document.getElementById('bookingForm');


    if (bookingForm) {

      const fieldsToValidate = [{
          inputId: 'departDateInput',
          errorId: 'dateErrorMessage',
          serverError: '<?php echo addslashes($data['date_error'] ?? ""); ?>',
          requiredMessage: 'Vui lòng chọn ngày đặt.'
        },
        {
          inputId: 'fullnameInput',
          errorId: 'fullnameErrorMessage',
          serverError: '<?php echo addslashes($data['fullname_error'] ?? ""); ?>',
          requiredMessage: 'Vui lòng nhập họ tên .'
        },
        {
          inputId: 'phoneInput',
          errorId: 'phoneErrorMessage',
          serverError: '<?php echo addslashes($data['phone_error'] ?? ""); ?>',
          requiredMessage: 'Vui lòng nhập số điện thoại .',
          typeMessage: 'Số điện thoại không hợp lệ .'
        },
        {
          inputId: 'emailInput',
          errorId: 'emailErrorMessage',
          serverError: '<?php echo addslashes($data['email_error'] ?? ""); ?>',
          requiredMessage: 'Vui lòng nhập email .',
          typeMessage: 'Định dạng email không hợp lệ .'
        },
        {
          inputId: 'addressInput',
          errorId: 'addressErrorMessage',
          serverError: '<?php echo addslashes($data['address_error'] ?? ""); ?>',
          requiredMessage: 'Vui lòng nhập địa chỉ .'
        }
      ];

      fieldsToValidate.forEach(field => {
        const inputElement = document.getElementById(field.inputId);
        const errorElement = document.getElementById(field.errorId);

        if (inputElement && errorElement) {

          inputElement.addEventListener('input', function() {
            if (errorElement.textContent === field.requiredMessage ||
              (field.typeMessage && errorElement.textContent === field.typeMessage) ||
              (field.serverError && errorElement.textContent === field.serverError)) {
              errorElement.textContent = '';
            }

            if (inputElement.validity.customError) {
              inputElement.setCustomValidity('');
            }
          });


          inputElement.addEventListener('invalid', function(event) {
            event.preventDefault();
            errorElement.textContent = '';

            if (inputElement.validity.valueMissing) {
              errorElement.textContent = field.requiredMessage;
            } else if (inputElement.validity.typeMismatch && field.typeMessage) {

              errorElement.textContent = field.typeMessage;
            }


            inputElement.focus();
          });
        }
      });


      bookingForm.addEventListener('submit', function(event) {
        let formIsValid = true;
        let firstInvalidElement = null;

        fieldsToValidate.forEach(field => {
          const errorElement = document.getElementById(field.errorId);
          if (errorElement.textContent === field.requiredMessage ||
            (field.typeMessage && errorElement.textContent === field.typeMessage)) {
            errorElement.textContent = '';
          }
        });



        for (const field of fieldsToValidate) {
          const inputElement = document.getElementById(field.inputId);
          if (inputElement && !inputElement.checkValidity()) {
            formIsValid = false;
            if (!firstInvalidElement && inputElement.offsetParent !== null) {
              firstInvalidElement = inputElement;
            }
          }
        }

        if (!formIsValid) {
          event.preventDefault();
          if (firstInvalidElement) {
            firstInvalidElement.focus();
          }
        }

      });
    }
  });
</script>