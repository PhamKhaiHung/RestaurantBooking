<?php
if (isset($_SESSION['user-id'])) {
  $user_id = $_SESSION['user-id'];
 
 
}
// echo ''.$user_id.'';
?><head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>5SRestaurant</title>

  <!-- jQuery -->
  <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

  <!-- Bootstrap CSS -->


  <!-- Bootstrap JS Bundle -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link
    href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,700;1,100;1,400;1,500;1,700;1,900&display=swap"
    rel="stylesheet">
  <link rel="stylesheet" href="<?php echo $path ?>/css/page.css">
  <link rel="stylesheet" href="<?php echo $path ?>/css/style.css">
  <link rel="stylesheet" href="<?php echo $path ?>/css/user.css">
  <link rel="stylesheet" href="<?php echo $path ?>/css/responsive.css">
  <style>
    .has-fixed-nav {
      padding-top: 76px; /* Điều chỉnh giá trị này bằng với chiều cao của navbar */
    }
    
    /* Modern navbar styling */
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
      padding: 0.8rem 1.2rem !important; /* !important để đảm bảo ghi đè nếu có xung đột */
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
    
    /* Style gốc cho dropdown menu, đảm bảo nó hoạt động với click mặc định của Bootstrap */
    .modern-navbar .dropdown-menu {
      border-radius: 12px;
      box-shadow: 0 10px 15px rgba(0, 0, 0, 0.1);
      border: none;
      padding: 0.5rem;
      margin-top: 0.8rem; /* Khoảng cách từ nút toggle đến menu khi mở */
      /* Không thêm các thuộc tính opacity, transform, pointer-events, transition liên quan đến hover ở đây */
      /* Bootstrap JS sẽ xử lý việc hiển thị/ẩn menu khi click */
    }
    
    .modern-navbar .dropdown-item {
      padding: 0.8rem 1rem;
      border-radius: 8px;
      transition: all 0.2s ease; /* Chỉ transition cho hover của item, không phải của menu */
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
      /* Không cần CSS đặc biệt cho hover trên mobile vì chúng ta muốn hành vi click mặc định */
    }

    /* CSS cho các table và scrollbar (nếu có trên trang này) */
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
    .dropdown-toggle::after { /* Style chung cho mũi tên dropdown, có thể cần điều chỉnh nếu xung đột */
        position: absolute;
        right: 10px;
        top: 50%;
        transform: translateY(-50%);
    }

</style>
</head>
<header class="navbar navbar-expand-lg navbar-dark sticky-top modern-navbar">
  <div class="container-fluid">
    <a class="navbar-brand d-flex align-items-center" href="<?php echo $path ?>restaurant/home/index">
      <i class="bi bi-shop me-2"></i>
      <span>Quản Lý Nhà Hàng</span>
    </a>
    
    <button class="border-0 navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavAltMarkup"
      aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    
    <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
      <div class="center-nav-items">
        <div class="navbar-nav d-flex">
          <a class="nav-link d-flex align-items-center <?php echo !isset($data['page']) || $data['page'] == 'restaurant/home' ? 'active' : ''; ?>" href="<?php echo $path ?>restaurant/home/index">
            <i class="bi bi-house-door me-2"></i>Trang Chủ
          </a>
          <a class="nav-link d-flex align-items-center <?php echo isset($data['page']) && $data['page'] == 'restaurant/statistics' ? 'active' : ''; ?>" href="<?php echo $path ?>restaurant/statistic/index">
            <i class="bi bi-bar-chart me-2"></i>Thống Kê
          </a>
          <a class="nav-link d-flex align-items-center <?php echo isset($data['page']) && $data['page'] == 'restaurant/bookings' ? 'active' : ''; ?>" href="<?php echo $path ?>restaurant/booking/manage">
            <i class="bi bi-calendar-check me-2"></i>Quản Lý Đặt Bàn
          </a>
          
        </div>
      </div>

      <div class="navbar-nav ms-auto">
        <?php if (isset($_SESSION['user-id'])): ?>
          <div class="nav-item dropdown">
            <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
              <i class="bi bi-person-circle me-2"></i>Tài khoản
            </a>
            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
              <li><a class="dropdown-item" href="<?php echo $path ?>restaurant/profile/index"><i class="bi bi-person me-2"></i>Hồ sơ</a></li>
              <li><a class="dropdown-item" href="<?php echo $path ?>restaurant/statistic/index"><i class="bi bi-gear me-2"></i>Cài đặt</a></li>
              <li><hr class="dropdown-divider"></li>
              <li><a class="dropdown-item" href="<?php echo $path ?>restaurant/account/logout"><i class="bi bi-box-arrow-right me-2"></i>Đăng xuất</a></li>
            </ul>
          </div>
        <?php else: ?>
          <a class="nav-link d-flex align-items-center" href="<?php echo $path ?>authen/home/login">
            <i class="bi bi-box-arrow-in-right me-2"></i>Đăng nhập
          </a>
        <?php endif; ?>
      </div>
    </div>
  </div>
</header>
