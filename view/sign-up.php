<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="bread"><span><a href="index.html">Trang Chủ</a></span> / <span>Đăng ký</span></p>
            </div>
        </div>
    </div>
</div>

<div id="colorlib-contact">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="contact-wrap">
                    <h3>Đăng ký</h3>
                    <form action="?view=sign_up" class="contact-form" method="post" onsubmit="return validateForm()">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="name">Họ và tên</label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Your name" required>
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Your email address" required>
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="sdt">Số điện thoại</label>
                                    <input type="text" id="sdt" name="sdt" class="form-control" placeholder="Your phone " required>
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="address">Địa chỉ</label>
                                    <input type="text" id="address" name="address" class="form-control" placeholder="Your address" required>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="password-input">
                                        <label>Mật khẩu</label>
                                        <input type="password" id="password" name="password" class="form-control" placeholder="Your password" required>
                                        <div class="toggle-password" onclick="togglePasswordVisibility('password')">

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <div class="password-input">
                                        <label>Xác nhận mật khẩu</label>
                                        <input type="password" id="confirm_password" name="confirm_password" class="form-control" placeholder="Confirm password" required>
                                        <div class="toggle-password" onclick="togglePasswordVisibility('confirm_password')">

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="w-100"></div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <input type="submit" value="Đăng Ký" name="signup" class="btn btn-primary">
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.password-input {
    position: relative;
    margin-bottom: 15px;
}

.toggle-password {
    position: absolute;
    right: 10px;
    top: 70%;
    transform: translateY(-50%);
    cursor: pointer;
    width: 24px;
    height: 24px;
}

.toggle-password svg {
    fill: #666;
    width: 100%;
    height: 100%;
    transition: fill 0.3s ease;
}

.toggle-password:hover svg {
    fill: #333;
}

.form-control {
    padding-right: 40px;
}
</style>

<script>
function togglePasswordVisibility(fieldId) {
    const passwordField = document.getElementById(fieldId);
    const type = passwordField.getAttribute('type') === 'password' ? 'text' : 'password';
    passwordField.setAttribute('type', type);
}

function validateForm() {
    // Lấy giá trị các trường
    const password = document.getElementById('password').value;
    const confirmPassword = document.getElementById('confirm_password').value;

    // Kiểm tra mật khẩu khớp
    if (password !== confirmPassword) {
        alert('Mật khẩu xác nhận không khớp!');
        return false;
    }

    // Kiểm tra các trường bắt buộc
    const requiredFields = document.querySelectorAll('[required]');
    for (let field of requiredFields) {
        if (!field.value.trim()) {
            alert('Vui lòng điền đầy đủ tất cả các trường bắt buộc');
            return false;
        }
    }

    // Xác nhận tạo tài khoản
    return confirm('Bạn có chắc chắn muốn tạo tài khoản này?');
}
</script>