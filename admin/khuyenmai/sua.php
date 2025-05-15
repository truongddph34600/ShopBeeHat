<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quản lý khuyến mãi</title>
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
        $id=$_GET['makm'];
        $sql_sua="SELECT * FROM `khuyenmai` WHERE MaKM=$id";
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
                    <h4 class="page-title mb-1">Chỉnh sửa khuyến mãi</h4>

                </div>
            </div>
            <div>
                <a href="index.php?action=khuyenmai" class="btn btn-outline-primary btn-sm">
                    <i class="fas fa-arrow-left mr-1"></i> Quay lại
                </a>
            </div>
        </div>

        <!-- Content -->
        <div class="content-card card">
            <div class="card-header d-flex justify-content-between align-items-center">
                <h5 class="m-0">
                    <i class="fas fa-edit mr-2"></i>
                    Thông tin khuyến mãi
                </h5>
                <span class="badge badge-primary px-3 py-2">Mã KM: <?php echo $kq['MaKM'] ?></span>
            </div>
            <div class="card-body">
                <form method="GET" action="khuyenmai/xuly.php" enctype="multipart/form-data">
                    <input hidden class="form-control" name="makm" value="<?php echo $kq['MaKM'] ?>">

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="tkm">
                                    <i class="fas fa-file-signature mr-1"></i> Tên khuyến mãi
                                </label>
                                <input type="text" class="form-control" id="tkm" name="tkm" value="<?php echo $kq['TenKM'] ?>" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="mt">
                                    <i class="fas fa-align-left mr-1"></i> Mô tả
                                </label>
                                <textarea class="form-control" id="mt" name="mt" required><?php echo $kq['MoTa'] ?></textarea>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="nbd">
                                    <i class="fas fa-calendar-plus mr-1"></i> Ngày bắt đầu
                                </label>
                                <input type="date" class="form-control" id="nbd" name="nbd" value="<?php echo $kq['NgayBD'] ?>" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="nkt">
                                    <i class="fas fa-calendar-times mr-1"></i> Ngày kết thúc
                                </label>
                                <input type="date" class="form-control" id="nkt" name="nkt" value="<?php echo $kq['NgayKT'] ?>" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="t">
                                    <i class="fas fa-dollar-sign mr-1"></i> Tiền giảm giá
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="t" name="t" value="<?php echo $kq['TienKM'] ?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text">VNĐ</span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label class="form-label" for="pt">
                                    <i class="fas fa-percent mr-1"></i> giảm giá
                                </label>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="pt" name="pt" value="<?php echo $kq['KM_PT'] ?>">
                                    <div class="input-group-append">
                                        <span class="input-group-text">%</span>
                                    </div>
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