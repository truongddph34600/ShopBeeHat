<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản Lý Nhân Viên</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" />
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .form-container {
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            padding: 30px;
            margin-top: 20px;
            margin-bottom: 20px;
        }
        .card-header {
            background-color: #4e73df;
            color: white;
            border-radius: 10px 10px 0 0;
            padding: 15px 20px;
            font-weight: 600;
            font-size: 1.2rem;
        }
        .form-label {
            font-weight: 500;
            color: #5a5c69;
        }
        .form-control {
            border-radius: 5px;
            padding: 10px 15px;
            border: 1px solid #d1d3e2;
            transition: border-color 0.2s;
        }
        .form-control:focus {
            border-color: #4e73df;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }
        .btn-submit {
            background-color: #4e73df;
            border: none;
            padding: 10px 25px;
            border-radius: 5px;
            font-weight: 600;
            transition: all 0.3s;
        }
        .btn-submit:hover {
            background-color: #2e59d9;
            transform: translateY(-2px);
            box-shadow: 0 5px 10px rgba(46, 89, 217, 0.3);
        }
        .input-group-text {
            background-color: #4e73df;
            color: white;
            border: none;
        }
        .divider {
            height: 0;
            margin: 1.5rem 0;
            overflow: hidden;
            border-top: 1px solid #e3e6f0;
        }
        .form-floating > .form-control {
            padding-top: 1.625rem;
            padding-bottom: 0.625rem;
        }
        .form-floating > label {
            padding: 1rem 0.75rem;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="form-container">
                <div class="card-header d-flex justify-content-between align-items-center mb-4">
                    <span><i class="fas fa-user-plus me-2"></i>Thêm Nhân Viên Mới</span>
                </div>

                <?php
                $sql1 = "select * from quyen";
                $rs1 = mysqli_query($conn, $sql1);
                ?>

                <form method="POST" action="nhanvien/xuly.php" enctype="multipart/form-data">
                    <div class="row g-3">
                        <!-- Thông tin cá nhân -->
                        <div class="col-12 mb-3">
                            <h5 class="text-muted"><i class="fas fa-id-card me-2"></i>Thông tin cá nhân</h5>
                            <hr class="mt-0">
                        </div>

                        <div>
                            <label for="tennv"><i class="fas fa-user me-2"></i>Họ Tên</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="tennv" name="tennv" placeholder="Nguyễn Văn A" required autofocus>
                            </div>
                        </div><hr>

                        <div>
                            <label for="email"><i class="fas fa-envelope me-2"></i>Email</label>
                            <div class="form-floating">
                                <input type="email" class="form-control" id="email" name="email" placeholder="example@company.com" required>
                            </div>
                        </div><hr>

                        <div>
                            <label for="sdt"><i class="fas fa-phone me-2"></i>Số Điện Thoại</label>
                            <div class="form-floating">
                                <input type="tel" class="form-control" id="sdt" name="sdt" placeholder="0123456789" required>

                            </div>
                        </div><hr>

                        <div>
                            <label for="dc"><i class="fas fa-map-marker-alt me-2"></i>Địa Chỉ</label>
                            <div class="form-floating">
                                <input type="text" class="form-control" id="dc" name="dc" placeholder="123 Đường ABC" required>
                            </div>
                        </div><hr>

                          <div>
                              <label for="q"><i class="fas fa-shield-alt me-2"></i>Quyền</label>
                            <div class="form-floating">
                                <select class="browser-default custom-select" name="q" id="">
                                              <option value=""></option>
                                              <?php while ($row=mysqli_fetch_array($rs1)) { ?>
                                              <option value="<?php echo $row['id'] ?>"><?php echo $row['id'].' - '.$row['Ten'] ?></option>}
                                       <?php   } ?>
                                </select>
                            </div>
                        </div><hr>

                        <div >
                            <label for="mk"><i class="fas fa-key me-2"></i>Mật Khẩu</label>
                            <div class="form-floating">
                                <input type="password" class="form-control" id="mk" name="mk" required>
                                <div class="form-text text-muted">Mật khẩu phải có ít nhất 6 ký tự</div>
                            </div>
                        </div>

                        <div class="col-12 mt-4 text-center">
                            <button type="submit" name="them" class="btn btn-submit btn-lg px-5">
                                <i class="fas fa-save me-2"></i>Thêm Nhân Viên
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
<script>
    // Hiển thị/ẩn mật khẩu
    document.addEventListener('DOMContentLoaded', function() {
        // Thêm validation trên form khi submit
        const form = document.querySelector('form');

        form.addEventListener('submit', function(event) {
            const password = document.getElementById('mk').value;

            if (password.length < 6) {
                event.preventDefault();
                alert('Mật khẩu phải có ít nhất 6 ký tự!');
            }
        });
    });
</script>
</body>
</html>