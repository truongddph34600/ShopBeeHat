<?php
    include_once('../model/database.php');
    $mahd = $_GET['mahd'];
    $sql = "select * from chitiethoadon where MaHD=$mahd";
    $rs = mysqli_query($conn, $sql);
    $sql2 = "select * from nguoinhan where MaHD=$mahd";
    $rs2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_array($rs2);

    // Sử dụng ngày hiện tại
    $ngaytao = date('d/m/Y');
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chi tiết đơn hàng #<?php echo $mahd; ?></title>
    <!-- Bootstrap CSS -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fa;
            color: #212529;
        }

        .invoice-container {
            background-color: #fff;
            box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
            border-radius: 0.5rem;
            padding: 2rem;
            margin-top: 2rem;
            margin-bottom: 2rem;
        }

        .invoice-header {
            border-bottom: 2px solid #0d6efd;
            margin-bottom: 2rem;
            padding-bottom: 1rem;
        }

        .invoice-title {
            font-weight: 700;
            color: #0d6efd;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .invoice-id {
            background-color: #0d6efd;
            color: white;
            padding: 0.5rem 1rem;
            border-radius: 0.3rem;
            font-weight: 500;
            display: inline-block;
        }

        .customer-info {
            background-color: #f8f9fa;
            padding: 1.5rem;
            border-radius: 0.5rem;
            margin-bottom: 2rem;
            border-left: 4px solid #0d6efd;
        }

        .customer-info-title {
            color: #0d6efd;
            font-weight: 600;
            font-size: 1.1rem;
            margin-bottom: 0.75rem;
        }

        .customer-info-item {
            margin-bottom: 0.5rem;
        }

        .customer-info-label {
            font-weight: 500;
            color: #495057;
        }

        .customer-info-value {
            color: #212529;
            font-weight: 400;
        }

        .invoice-table {
            border-radius: 0.5rem;
            overflow: hidden;
            box-shadow: 0 0.125rem 0.25rem rgba(0, 0, 0, 0.075);
            margin-bottom: 2rem;
        }

        .invoice-table thead {
            background-color: #0d6efd;
            color: white;
            font-weight: 500;
        }

        .invoice-table th, .invoice-table td {
            padding: 1rem;
            vertical-align: middle;
        }

        .invoice-table tbody tr:nth-child(even) {
            background-color: rgba(13, 110, 253, 0.05);
        }

        .invoice-table tbody tr:hover {
            background-color: rgba(13, 110, 253, 0.1);
        }

        .invoice-total {
            background-color: #f8f9fa;
            padding: 1.5rem;
            border-radius: 0.5rem;
            text-align: right;
            margin-bottom: 2rem;
            border-right: 4px solid #0d6efd;
        }

        .invoice-total-label {
            font-weight: 600;
            color: #0d6efd;
            font-size: 1.25rem;
        }

        .invoice-total-value {
            font-weight: 700;
            color: #212529;
            font-size: 1.5rem;
        }

        .btn-print {
            background-color: #0d6efd;
            border-color: #0d6efd;
            padding: 0.75rem 2rem;
            font-weight: 500;
            border-radius: 0.3rem;
            transition: all 0.3s ease;
        }

        .btn-print:hover {
            background-color: #0b5ed7;
            border-color: #0b5ed7;
            transform: translateY(-2px);
            box-shadow: 0 0.5rem 1rem rgba(13, 110, 253, 0.3);
        }

        .btn-print i {
            margin-right: 0.5rem;
        }

        .footer-note {
            text-align: center;
            color: #6c757d;
            margin-top: 2rem;
            font-size: 0.9rem;
        }

        .badge-size {
            background-color: #20c997;
            color: white;
            padding: 0.3rem 0.6rem;
            border-radius: 0.25rem;
            font-weight: 500;
            font-size: 0.85rem;
        }

        .badge-color {
            background-color: #fd7e14;
            color: white;
            padding: 0.3rem 0.6rem;
            border-radius: 0.25rem;
            font-weight: 500;
            font-size: 0.85rem;
        }

        .date-display {
            text-align: right;
            color: #6c757d;
            margin-bottom: 1rem;
        }

        @media print {
            .btn-print {
                display: none;
            }

            body {
                background-color: #fff;
            }

            .invoice-container {
                box-shadow: none;
                margin: 0;
                padding: 1rem;
            }
        }
    </style>
</head>
<body>
    <div class="container invoice-container">
        <div class="row invoice-header">
            <div class="col-md-6">
                <h1 class="invoice-title">CHI TIẾT ĐƠN</h1>
            </div>
            <div class="col-md-6 text-end">
                <span class="invoice-id">Mã HĐ: <?php echo $mahd; ?></span>
            </div>
        </div>

        <div class="date-display">
            <i class="fas fa-calendar-alt me-2"></i> Ngày: <?php echo $ngaytao; ?>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="customer-info">
                    <h3 class="customer-info-title"><i class="fas fa-user me-2"></i>Thông Tin Người Nhận</h3>
                    <div class="row customer-info-item">
                        <div class="col-md-3 customer-info-label">Tên người nhận:</div>
                        <div class="col-md-9 customer-info-value"><?php echo $row2['TenNN']; ?></div>
                    </div>
                    <div class="row customer-info-item">
                        <div class="col-md-3 customer-info-label">Địa chỉ:</div>
                        <div class="col-md-9 customer-info-value"><?php echo $row2['DiaChiNN']; ?></div>
                    </div>
                    <div class="row customer-info-item">
                        <div class="col-md-3 customer-info-label">Số điện thoại:</div>
                        <div class="col-md-9 customer-info-value"><?php echo $row2['SDTNN']; ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <h3 class="mb-3"><i class="fas fa-shopping-cart me-2"></i>Chi Tiết Đơn Hàng</h3>
                <div class="table-responsive invoice-table">
                    <table class="table table-hover table-bordered m-0">
                        <thead>
                            <tr>
                                <th>Mã Sản Phẩm</th>
                                <th>Số Lượng</th>
                                <th>Đơn Giá</th>
                                <th>Thành Tiền</th>
                                <th>Size</th>
                                <th>Màu</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            $so = 0;
                            while ($row = mysqli_fetch_array($rs)) {
                                $so = $so + $row['ThanhTien'];
                            ?>
                            <tr>
                                <td><?php echo $row['MaSP']; ?></td>
                                <td><?php echo $row['SoLuong']; ?></td>
                                <td><?php echo number_format($row['DonGia']).' đ'; ?></td>
                                <td><?php echo number_format($row['ThanhTien']).' đ'; ?></td>
                                <td><span class="badge-size"><?php echo $row['Size']; ?></span></td>
                                <td><span class="badge-color"><?php echo $row['MaMau']; ?></span></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-md-6"></div>
            <div class="col-md-6">
                <div class="invoice-total">
                    <div class="row">
                        <div class="col-6 invoice-total-label">Tổng thanh toán:</div>
                        <div class="col-6 invoice-total-value"><?php echo number_format($so).' đ'; ?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-12 text-center">
                <button type="button" class="btn btn-print" onclick="window.print();">
                    <i class="fas fa-print"></i> In Hóa Đơn
                </button>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/js/bootstrap.bundle.min.js"></script>
</body>
</html>