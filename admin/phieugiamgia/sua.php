<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý Voucher</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #4e73df;
            --secondary-color: #1cc88a;
            --accent-color: #f6c23e;
            --dark-color: #5a5c69;
            --light-color: #f8f9fc;
        }

        body {
            background-color: #f8f9fc;
            font-family: 'Nunito', sans-serif;
        }

        .page-header {
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            margin-bottom: 1.5rem;
        }

        .page-title {
            margin: 0;
            color: #333;
            font-weight: 700;
            display: flex;
            align-items: center;
        }

        .page-icon {
            width: 40px;
            height: 40px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 0.35rem;
            margin-right: 0.75rem;
            background: linear-gradient(180deg, var(--primary-color) 0%, #224abe 100%);
        }

        .breadcrumb-item {
            font-weight: 600;
        }

        .content-card {
            border: none;
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #e3e6f0;
            padding: 1rem 1.25rem;
            font-weight: 700;
            color: var(--dark-color);
        }

        .form-label {
            font-weight: 600;
            color: var(--dark-color);
            margin-bottom: 0.5rem;
        }

        .form-control {
            border: 1px solid #d1d3e2;
            border-radius: 0.35rem;
            padding: 0.75rem 1rem;
            font-size: 0.9rem;
            transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }

        .btn-submit {
            padding: 0.75rem 1rem;
            font-weight: 600;
            background: linear-gradient(180deg, var(--primary-color) 0%, #224abe 100%);
            border: none;
            border-radius: 0.35rem;
            color: #fff;
            transition: all 0.2s;
        }

        .btn-submit:hover {
            background: linear-gradient(180deg, #4262c5 0%, #1a3891 100%);
            transform: translateY(-1px);
            box-shadow: 0 0.3rem 0.5rem rgba(0, 0, 0, 0.15);
        }

        .btn-cancel {
            padding: 0.75rem 1rem;
            font-weight: 600;
            background-color: #eaecf4;
            border: none;
            border-radius: 0.35rem;
            color: var(--dark-color);
            transition: all 0.2s;
        }

        .btn-cancel:hover {
            background-color: #d9dce7;
            transform: translateY(-1px);
        }

        .form-group {
            margin-bottom: 1.5rem;
        }

        textarea.form-control {
            min-height: 100px;
        }

        .input-group-text {
            background-color: #eaecf4;
            border-color: #d1d3e2;
        }
    </style>
</head>
<body>
    <?php
        $magg=$_GET['id'];
        $sql_sua="SELECT * FROM `phieugiamgia` WHERE MaGG=$magg";
        $rs_sua=mysqli_query($conn,$sql_sua);
        $kq=mysqli_fetch_array($rs_sua)
    ?>

    <div class="container py-4">
        <!-- Header -->
        <div class="page-header bg-white p-4 d-flex justify-content-between align-items-center">
            <div class="d-flex align-items-center">
                <div class="page-icon text-white">
                    <i class="fas fa-tag"></i>
                </div>
                <div>
                    <h4 class="page-title mb-1">Chỉnh sửa Voucher</h4>

                </div>
            </div>
            <div>
                <a href="index.php?action=phieugiamgia" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-arrow-left mr-1"></i> Quay lại
                </a>
            </div>
        </div>

        <!-- Content -->
        <div class="content-card card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0">
                    <i class="fas fa-edit mr-2"></i>
                    Thông tin Voucher
                </h5>
                <span class="badge badge-primary px-3 py-2">Mã Voucher: <?php echo $kq['MaGG'] ?></span>
            </div>
            <div class="card-body">
                <form method="GET" action="phieugiamgia/xuly.php" enctype="multipart/form-data">
                    <input hidden class="form-control" name="MaGG" value="<?php echo $kq['MaGG'] ?>">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="tengg">
                                    <i class="fas fa-file-signature mr-1"></i> Tên Voucher
                                </label>
                                <input type="text" class="form-control" id="tengg" name="tengg" value="<?php echo $kq['TenGG'] ?>" required>
                            </div>
                        </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="tiengg">
                                    <i class="fas fa-dollar-sign mr-1"></i> Tiền giảm giá
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="tiengg" name="tiengg" value="<?php echo $kq['TienGG'] ?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text">VNĐ</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    <div class="row mt-4">
                        <div class="col-md-12 text-right">
                            <button type="submit" class="btn btn-submit" name="sua">
                                <i class="fas fa-save mr-1"></i> Cập nhật
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/4.6.2/js/bootstrap.bundle.min.js"></script>
</body>
</html>