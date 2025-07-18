<?php
$path = rtrim(str_replace('index.php', '', $_SERVER['SCRIPT_NAME']), '/') . '/';
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <title>Đăng nhập hoặc Đăng ký</title>
    <script src="http://code.jquery.com/jquery-1.9.1.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/js/toastr.js"></script>
    <link rel="stylesheet" href="<?php echo $path ?>css/authen.css">
</head>
<body>
    <div class="container" id="authTabContainer">
        <div class="auth-form-wrapper">
            <!-- Form Đăng nhập -->
            <div class="login-container" id="loginFormContainer">
                <img src="<?php echo $path ?>img/res.png" alt="login" class="login-image">
                <form action="<?php echo $path ?>authen/home/handleLogin" method="post">
                    <h1>Đăng nhập</h1>
                    <div class="social-container">
                        <a href="#" class="social fb"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social gg"><i class="bi bi-google"></i></a>
                        <a href="#" class="social ld"><i class="bi bi-linkedin"></i></a>
                    </div>
                    <span>hoặc sử dụng tài khoản của bạn</span>
                    <input type="text" placeholder="Email hoặc Tài khoản" name="username" required />
                    <input type="password" placeholder="Mật khẩu" name="password" required />
                    <button type="submit" class="login">Đăng nhập</button>
                    <p class="mobile-switch">Chưa có tài khoản? <a href="#" data-form="signup" class="switch-to-signup">Đăng ký ngay</a></p>
                </form>
            </div>

            <!-- Form Đăng ký -->
            <div class="form-container-tab" id="signupFormContainer" style="display: none;">
                <img src="<?php echo $path ?>img/res.png" alt="signup" class="signup-image">
                <form action="<?php echo $path ?>authen/home/signup" method="post" id="signupForm" novalidate>
                    <h1>Tạo tài khoản</h1>
                    <div class="social-container">
                        <a href="#" class="social fb"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="social gg"><i class="bi bi-google"></i></a>
                        <a href="#" class="social ld"><i class="bi bi-linkedin"></i></a>
                    </div>
                    <span>hoặc sử dụng email của bạn để đăng ký</span>

                    <div class="input-group">
                        <input type="text" placeholder="Tên tài khoản" name="username" id="username" required
                            value="<?php echo (isset($data['username']) && !empty($data['username']))
                                        ? htmlspecialchars($data['username'])
                                        : (isset($_SESSION['register_from_booking']['email'])
                                            ? explode('@', $_SESSION['register_from_booking']['email'])[0]
                                            : ''); ?>" />
                        <div class="error-message" id="username-error"><?php echo isset($data['errors']['username']) ? htmlspecialchars($data['errors']['username']) : ''; ?></div>
                    </div>

                    <div class="input-group">
                        <input type="email" placeholder="Email" name="email" id="email" required
                            value="<?php echo (isset($data['email']) && !empty($data['email']))
                                        ? htmlspecialchars($data['email'])
                                        : (isset($_SESSION['register_from_booking']['email'])
                                            ? $_SESSION['register_from_booking']['email']
                                            : ''); ?>" />
                        <div class="error-message" id="email-error"><?php echo isset($data['errors']['email']) ? htmlspecialchars($data['errors']['email']) : ''; ?></div>
                    </div>

                    <div class="input-group">
                        <input type="password" placeholder="Mật khẩu" name="password" id="password" required />
                        <div class="error-message" id="password-error"><?php echo isset($data['errors']['password']) ? htmlspecialchars($data['errors']['password']) : ''; ?></div>
                    </div>

                    <div class="input-group">
                        <input type="password" placeholder="Nhập lại mật khẩu" name="confirm_password" id="confirm_password" required />
                        <div class="error-message" id="confirm-password-error"><?php echo isset($data['errors']['confirm_password']) ? htmlspecialchars($data['errors']['confirm_password']) : ''; ?></div>
                    </div>

                    <div class="input-group">
                        <input type="text" placeholder="Họ tên" name="full_name" id="full_name" required
                            value="<?php echo (isset($data['fullname']) && !empty($data['fullname']))
                                        ? htmlspecialchars($data['fullname'])
                                        : (isset($_SESSION['register_from_booking']['fullname'])
                                            ? $_SESSION['register_from_booking']['fullname']
                                            : ''); ?>" />
                        <div class="error-message" id="fullname-error"><?php echo isset($data['errors']['fullname']) ? htmlspecialchars($data['errors']['fullname']) : ''; ?></div>
                    </div>

                    <div class="input-group">
                        <input type="text" placeholder="Địa chỉ" name="address" id="address" required
                            value="<?php echo (isset($data['address']) && !empty($data['address']))
                                        ? htmlspecialchars($data['address'])
                                        : (isset($_SESSION['register_from_booking']['address'])
                                            ? $_SESSION['register_from_booking']['address']
                                            : ''); ?>" />
                        <div class="error-message" id="address-error"><?php echo isset($data['errors']['address']) ? htmlspecialchars($data['errors']['address']) : ''; ?></div>
                    </div>

                    <div class="input-group">
                        <input type="text" placeholder="Số điện thoại" name="phone_number" id="phone_number" required
                            value="<?php echo (isset($data['phone']) && !empty($data['phone']))
                                        ? htmlspecialchars($data['phone'])
                                        : (isset($_SESSION['register_from_booking']['phone'])
                                            ? $_SESSION['register_from_booking']['phone']
                                            : ''); ?>" />
                        <div class="error-message" id="phone-error"><?php echo isset($data['errors']['phone']) ? htmlspecialchars($data['errors']['phone']) : ''; ?></div>
                    </div>

                    <!-- Hiển thị lỗi chung nếu có -->
                    <?php if (isset($data['errors']['general'])): ?>
                        <div class="input-group">
                             <div class="error-message general-error" style="text-align: center; background-color: #FFD2D2; border: 1px solid #D8000C; padding: 10px; border-radius: 4px; margin-top: 10px;">
                                <?php echo htmlspecialchars($data['errors']['general']); ?>
                            </div>
                        </div>
                    <?php endif; ?>


                    <button type="submit" class="signup">Đăng ký</button>
                    <p class="mobile-switch">Đã có tài khoản? <a href="#" data-form="login" class="switch-to-login">Đăng nhập</a></p>
                </form>
            </div>
        </div>
    </div>
</body>
<script>
    // TOÀN BỘ JAVASCRIPT CỦA BẠN GIỮ NGUYÊN NHƯ TRƯỚC
    document.addEventListener('DOMContentLoaded', function() {
        const tabButtons = document.querySelectorAll('.auth-tab-button');
        const loginFormContainer = document.getElementById('loginFormContainer');
        const signupFormContainer = document.getElementById('signupFormContainer');
        const switchToSignupLinks = document.querySelectorAll('.switch-to-signup');
        const switchToLoginLinks = document.querySelectorAll('.switch-to-login');

        function showForm(formType) {
            if (formType === 'login') {
                loginFormContainer.style.display = 'flex';
                signupFormContainer.style.display = 'none';
                tabButtons.forEach(btn => btn.classList.remove('active'));
                document.querySelector('.auth-tab-button[data-form="login"]') &&
                    document.querySelector('.auth-tab-button[data-form="login"]').classList.add('active');
            } else if (formType === 'signup') {
                loginFormContainer.style.display = 'none';
                signupFormContainer.style.display = 'flex';
                tabButtons.forEach(btn => btn.classList.remove('active'));
                document.querySelector('.auth-tab-button[data-form="signup"]') &&
                    document.querySelector('.auth-tab-button[data-form="signup"]').classList.add('active');
            }
        }

        tabButtons.forEach(button => {
            button.addEventListener('click', function() {
                const formType = this.dataset.form;
                showForm(formType);
            });
        });

        switchToSignupLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                showForm('signup');
            });
        });

        switchToLoginLinks.forEach(link => {
            link.addEventListener('click', function(e) {
                e.preventDefault();
                showForm('login');
            });
        });

        // Kiểm tra tham số URL hoặc tham số từ controller để hiển thị form đăng ký
        // Ưu tiên tham số từ PHP (khi server reload với lỗi)
        const shouldShowSignup = <?php echo (isset($data['register']) && $data['register'] === '1' && !empty($data['errors'])) ? 'true' : 'false'; ?>;
        const urlParams = new URLSearchParams(window.location.search);
        const registerParamFromUrl = urlParams.get('register');


        if (shouldShowSignup) { // Nếu server yêu cầu hiện form signup (do có lỗi)
            showForm('signup');
        } else if (registerParamFromUrl === '1') { // Nếu URL có tham số register=1
            showForm('signup');
        }
        else {
            showForm('login'); // Mặc định hiển thị form đăng nhập
        }


        <?php if (isset($_SESSION['register_from_booking'])): ?>
            setTimeout(function() {
                fetch('<?php echo $path ?>authen/home/clearBookingSession', {
                    method: 'POST'
                });
            }, 1000);
        <?php endif; ?>

        const signupForm = document.getElementById('signupForm');
        if (signupForm) {
            signupForm.addEventListener('submit', function(e) {
                let hasError = false;
                document.querySelectorAll('.error-message').forEach(el => {
                    // Chỉ reset lỗi client, không xóa lỗi server nếu nó là lỗi general
                    if (!el.classList.contains('general-error')) {
                        el.textContent = '';
                    }
                });

                const username = document.getElementById('username');
                if (!username.value.trim() || username.value.trim().length < 6) {
                    document.getElementById('username-error').textContent = 'Tên đăng nhập phải có ít nhất 6 ký tự';
                    hasError = true;
                }
                const email = document.getElementById('email');
                if (!email.value.trim() || !email.value.includes('@') || !email.value.includes('.')) {
                    document.getElementById('email-error').textContent = 'Email không hợp lệ';
                    hasError = true;
                }
                const password = document.getElementById('password');
                const hasLetter = /[a-zA-Z]/.test(password.value);
                const hasNumber = /\d/.test(password.value);
                if (!password.value || !hasLetter || !hasNumber) {
                    document.getElementById('password-error').textContent = 'Mật khẩu phải có ít nhất 1 chữ cái và 1 số';
                    hasError = true;
                }
                const confirmPassword = document.getElementById('confirm_password');
                if (password.value !== confirmPassword.value) {
                    document.getElementById('confirm-password-error').textContent = 'Mật khẩu nhập lại không khớp';
                    hasError = true;
                }
                const fullname = document.getElementById('full_name');
                if (!fullname.value.trim()) {
                    document.getElementById('fullname-error').textContent = 'Họ tên không được để trống';
                    hasError = true;
                }
                const phone = document.getElementById('phone_number');
                if (!phone.value.trim() || !/^\d+$/.test(phone.value.trim())) {
                    document.getElementById('phone-error').textContent = 'Số điện thoại không hợp lệ';
                    hasError = true;
                }
                const address = document.getElementById('address');
                if (!address.value.trim()) {
                    document.getElementById('address-error').textContent = 'Địa chỉ không được để trống';
                    hasError = true;
                }

                if (hasError) {
                    e.preventDefault();
                }
            });

            const inputFields = signupForm.querySelectorAll('input');
            inputFields.forEach(input => {
                input.addEventListener('input', function() {
                    const errorId = this.id + '-error';
                    const errorElement = document.getElementById(errorId.replace('_', '-'));
                    if (errorElement && !errorElement.classList.contains('general-error')) { // Không xóa lỗi general khi user nhập
                        errorElement.textContent = '';
                    }
                });
            });
        }
    });
</script>
</html>