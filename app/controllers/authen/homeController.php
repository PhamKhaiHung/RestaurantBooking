<?php

class HomeController extends Controller
{
    private $model_user;

    public function __construct()
    {
        $this->model_user = $this->model('UserModel');
    }

    public function signup()
    {
        // Khởi tạo mảng data với giá trị mặc định
        $data = [
            'page' => 'login',
            'register' => '1',
            'username' => '',
            'email' => '',
            'fullname' => '',
            'address' => '',
            'phone' => '',
            'errors' => []
        ];

        // Nếu có dữ liệu từ form được submit
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            // Lấy và làm sạch dữ liệu
            $username = filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $password = filter_var($_POST['password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $confirm_password = filter_var($_POST['confirm_password'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $email = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
            $fullname = filter_var($_POST['full_name'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $address = filter_var($_POST['address'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);
            $phone = filter_var($_POST['phone_number'], FILTER_SANITIZE_FULL_SPECIAL_CHARS);

            // Cập nhật mảng data với giá trị từ form
            $data['username'] = $username;
            $data['email'] = $email;
            $data['fullname'] = $fullname;
            $data['address'] = $address;
            $data['phone'] = $phone;

            // Validate username
            if (empty($username) || strlen($username) < 6) {
                $data['errors']['username'] = "Username phải có ít nhất 6 ký tự";
            } else {
                // Kiểm tra xem username đã tồn tại chưa
                $userCheck = $this->model_user->existUserName($username);
                if ($userCheck->num_rows > 0) {
                    $data['errors']['username'] = "Tên đăng nhập đã tồn tại";
                }
            }

            // Validate password
            if (empty($password)) {
                $data['errors']['password'] = "Mật khẩu không được để trống";
            } else if (!preg_match('/[A-Za-z]/', $password) || !preg_match('/\d/', $password)) {
                $data['errors']['password'] = "Mật khẩu phải có ít nhất 1 chữ cái và 1 số";
            }

            // Validate confirm password
            if ($password !== $confirm_password) {
                $data['errors']['confirm_password'] = "Mật khẩu nhập lại không khớp";
            }

            // Validate email
            if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $data['errors']['email'] = "Email không hợp lệ";
            } else {
                // Kiểm tra xem email đã tồn tại chưa
                $emailCheck = $this->model_user->existUser($email);
                if ($emailCheck->num_rows > 0) {
                    $data['errors']['email'] = "Email đã tồn tại";
                }
            }

            // Validate fullname
            if (empty($fullname)) {
                $data['errors']['fullname'] = "Họ tên không được để trống";
            }

            // Validate phone
            if (empty($phone)) {
                $data['errors']['phone'] = "Số điện thoại không được để trống";
            } else if (!preg_match('/^\d+$/', $phone)) {
                $data['errors']['phone'] = "Số điện thoại không hợp lệ";
            }

            // Validate address
            if (empty($address)) {
                $data['errors']['address'] = "Địa chỉ không được để trống";
            }

            // Nếu không có lỗi, tiến hành đăng ký
            if (empty($data['errors'])) {
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $result = $this->model_user->signUser($email, $username, $hash, 'U', $fullname, $phone, $address);

                if ($result) {
                    echo '<script type="text/javascript">
                        toastr.options = {
                            "positionClass": "toast-top-center",
                            "timeOut": "3000"
                        };
                        toastr.success("Đăng ký thành công! Chuyển hướng đến trang đăng nhập...");
                        setTimeout(function(){ 
                            window.location.href = "' . rtrim(str_replace('index.php', '', $_SERVER['SCRIPT_NAME']), '/') . '/authen/home/login"; 
                        }, 3000);
                    </script>';
                } else {
                    $data['errors']['general'] = "Lỗi khi lưu dữ liệu. Vui lòng thử lại!";
                    echo '<script type="text/javascript">
                        toastr.options = {
                            "positionClass": "toast-top-center",
                            "timeOut": "3000"
                        };
                        toastr.error("Lỗi khi lưu dữ liệu. Vui lòng thử lại!");
                    </script>';
                }
            } else {
                // Hiển thị form đăng ký khi có lỗi
                echo '<script type="text/javascript">
                    setTimeout(function() {
                        document.getElementById("loginFormContainer").style.display = "none";
                        document.getElementById("signupFormContainer").style.display = "flex";
                    }, 100);
                </script>';
            }
        }

        // Render view với dữ liệu đã cập nhật
        $this->renderAuthen('login', $data);
    }

    public function registerFromBooking()
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            header('Location: /');
            exit;
        }

        // Lưu thông tin từ form đặt bàn vào session để có thể điền vào form đăng ký
        $_SESSION['register_from_booking'] = [
            'fullname' => isset($_POST['fullname']) ? htmlspecialchars($_POST['fullname']) : '',
            'email' => isset($_POST['email']) ? htmlspecialchars($_POST['email']) : '',
            'phone' => isset($_POST['phone']) ? htmlspecialchars($_POST['phone']) : '',
            'address' => isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''
        ];

        // Chuyển hướng đến trang đăng nhập với tab đăng ký được kích hoạt
        $path = rtrim(str_replace('index.php', '', $_SERVER['SCRIPT_NAME']), '/') . '/';
        header('Location: ' . $path . 'authen/home/login?register=1');
        exit;
    }

    public function clearBookingSession()
    {
        // Chỉ xóa thông tin booking khỏi session, không xóa toàn bộ session
        if (isset($_SESSION['register_from_booking'])) {
            unset($_SESSION['register_from_booking']);
        }

        // Trả về 200 OK mà không có nội dung
        http_response_code(200);
        exit;
    }

    public function login()
    {
        error_reporting(0);
        $this->renderAuthen('login', ['page' => 'login']);

       
    }
    public function handleLogin()
    {
        // Đảm bảo session đã được khởi động
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER['REQUEST_METHOD'] == 'POST') {
            $acc = trim(filter_var($_POST['username'], FILTER_SANITIZE_FULL_SPECIAL_CHARS)); // Thêm trim để loại bỏ khoảng trắng thừa
            $password_input = $_POST['password']; // Lấy mật khẩu gốc, không filter trước khi verify
            $err = "";

            // Validate input
            if (empty($acc)) {
                $err = "Tên đăng nhập/Email không được để trống";
            } elseif (strlen($acc) < 6) {
                $err = "Tên đăng nhập/Email phải có ít nhất 6 ký tự";
            } elseif (empty($password_input)) {
                $err = "Mật khẩu không được để trống";
            } elseif (strlen($password_input) < 6) {
                $err = "Mật khẩu phải có ít nhất 6 ký tự";
            } else {
                $user_data = null;

                // Bước 1: Thử tìm người dùng bằng email
                // Giả sử model_user->existUser($acc) tìm theo CỘT EMAIL
                $data_by_email = $this->model_user->existUser($acc);

                if ($data_by_email && $data_by_email->num_rows > 0) {
                    $user_data = $data_by_email->fetch_assoc();
                } else {
                    // Bước 2: Nếu không tìm thấy bằng email, thử tìm bằng username
                    // Giả sử model_user->existUserName($acc) tìm theo CỘT USERNAME (uname)
                    $data_by_username = $this->model_user->existUserName($acc);
                    if ($data_by_username && $data_by_username->num_rows > 0) {
                        $user_data = $data_by_username->fetch_assoc();
                    }
                }

                // Bước 3: Nếu người dùng được tìm thấy (bằng email hoặc username)
                if ($user_data) {
                    $hash_from_db = $user_data["password"]; // Lấy mật khẩu đã hash từ CSDL

                    // Bước 4: Xác thực mật khẩu
                    if (password_verify($password_input, $hash_from_db)) {
                        // Đăng nhập thành công
                        $_SESSION['user-id'] = $user_data['uid'];
                        $_SESSION['user_role'] = $user_data['role'];

                        // Tùy chọn: Tái tạo session ID để tăng cường bảo mật sau khi đăng nhập thành công
                        // session_regenerate_id(true);

                        // Thiết lập cookie (Cân nhắc thêm HttpOnly và Secure flags)
                        // Ví dụ cho PHP 7.3+
                        $cookie_options = [
                            'expires' => time() + 86400 * 30, // 30 ngày
                            'path' => '/',
                            'domain' => '', // Để trống cho domain hiện tại
                            'secure' => isset($_SERVER['HTTPS']), // True nếu là HTTPS
                            'httponly' => true, // Ngăn JavaScript truy cập cookie
                            'samesite' => 'Lax' // Hoặc 'Strict'
                        ];
                        setcookie('Cookieid', $user_data['uid'], $cookie_options);
                        // Hoặc cách cũ hơn:
                        // setcookie('Cookieid', $user_data['uid'], time() + 86400 * 30, "/", "", isset($_SERVER['HTTPS']), true);


                        $path_base = str_replace('index.php', '', $_SERVER['SCRIPT_NAME']);
                        $redirect_url = '';


                        switch ($user_data['role']) {
                            case 'A': // Admin
                                $_SESSION['isAdmin'] = true; // Có thể vẫn giữ nếu các phần khác của app đang dùng
                                $redirect_url = $path_base . 'admin/user';
                                break;
                            case 'R':
                                // Restaurant
                                $redirect_url = $path_base . 'restaurant/home/index';
                               
                                // Đảm bảo đường dẫn này đúng
                                break;
                            default: // Các user khác (ví dụ: role 'U' cho User thông thường)
                                $redirect_url = $path_base . 'user/home/index';
                                break;
                        }
                       
                        header('Location: ' . $redirect_url);
                        exit; // Quan trọng: dừng script sau khi chuyển hướng

                    } else {
                        $err = "Mật khẩu không đúng.";
                    }
                } else {
                    $err = "Tài khoản không tồn tại."; // Nếu không tìm thấy bằng cả email và username
                }
            }

            if ($err) {
                // Chỉ hiển thị lỗi
                echo '<script type="text/javascript">toastr.error("' . htmlspecialchars($err, ENT_QUOTES, 'UTF-8') . '")</script>';
                // Trong một ứng dụng MVC đầy đủ, bạn sẽ render lại view login với thông báo lỗi $err
                // Ví dụ: $this->view('login_page_view', ['error' => $err, 'username_val' => $acc]);
            }
        }
    }
}
