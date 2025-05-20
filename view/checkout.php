<?php
if (isset($_SESSION['laclac_khachang'])==false) {
	header('location:?view=login'); 
}else{
    $kh = $_SESSION['laclac_khachang'];
}
?>
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thanh Toán</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #ffc107;
            --secondary-color: #f5f5f5;
            --text-color: #333;
            --light-text: #777;
            --border-color: #e1e1e1;
            --success-color: #28a745;
            --hover-color: #2a4db7;
            --danger-color: #e53935;
            --momo-color: #ae2070;
            --gray-bg: #f8f9fa;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f9f9f9;
            color: #444;
            line-height: 1.7;
        }

        .container {
            max-width: 1200px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -15px;
        }

        .col, .col-md-6, .col-md-12, .col-lg-4, .col-lg-8, .col-md-10 {
            position: relative;
            width: 100%;
            padding: 0 15px;
        }

        .col-md-6 {
            flex: 0 0 50%;
            max-width: 50%;
        }

        .col-md-10 {
            flex: 0 0 83.333333%;
            max-width: 83.333333%;
        }

        .col-md-12 {
            flex: 0 0 100%;
            max-width: 100%;
        }

        .offset-md-1 {
            margin-left: 8.333333%;
        }

        @media (min-width: 992px) {
            .col-lg-4 {
                flex: 0 0 33.333333%;
                max-width: 33.333333%;
            }
            .col-lg-8 {
                flex: 0 0 66.666667%;
                max-width: 66.666667%;
            }
        }

        .text-center {
            text-align: center;
        }

        .w-100 {
            width: 100%;
        }

        /* Breadcrumbs */
        .breadcrumbs {
            background-color: var(--secondary-color);
            padding: 15px 0;
            margin-bottom: 30px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.05);
        }

        .bread {
            margin: 0;
            font-size: 14px;
        }

        .bread a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s;
        }

        .bread a:hover {
            color: var(--hover-color);
        }

        .bread span {
            padding: 0 5px;
        }

        /* Process Steps */
        .process-wrap {
            display: flex;
            justify-content: space-between;
            margin-bottom: 50px;
        }

        .process {
            flex: 1;
            position: relative;
        }

        .process::after {
            content: '';
            position: absolute;
            top: 30px;
            right: -30%;
            width: 60%;
            height: 2px;
            background-color: var(--border-color);
            z-index: -1;
        }

        .process:last-child::after {
            display: none;
        }

        .process span {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            background-color: var(--border-color);
            border-radius: 50%;
            color: var(--light-text);
            font-size: 20px;
            font-weight: bold;
            margin: 0 auto 15px;
            transition: all 0.3s;
        }

        .process.active span {
            background-color: var(--primary-color);
            color: white;
        }

        .process h3 {
            font-size: 16px;
            color: var(--light-text);
            margin: 0;
            transition: all 0.3s;
        }

        .process.active h3 {
            color: var(--text-color);
            font-weight: bold;
        }

        /* Form */
        .colorlib-form {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
            margin-bottom: 30px;
        }

        .colorlib-form h2 {
            margin-top: 0;
            margin-bottom: 25px;
            font-weight: 600;
            font-size: 22px;
            position: relative;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border-color);
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: 500;
            font-size: 14px;
            color: var(--text-color);
        }

        .form-control {
            display: block;
            width: 100%;
            padding: 12px 15px;
            font-size: 15px;
            line-height: 1.5;
            color: var(--text-color);
            background-color: #fff;
            background-clip: padding-box;
            border: 1px solid var(--border-color);
            border-radius: 6px;
            transition: border-color 0.3s ease;
        }

        .form-control:focus {
            border-color: var(--primary-color);
            outline: 0;
            box-shadow: 0 0 0 3px rgba(62, 100, 255, 0.15);
        }

        /* Cart Detail */
        .cart-detail {
            background-color: white;
            padding: 25px;
            border-radius: 8px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.08);
            margin-bottom: 30px;
        }

        .cart-detail h2 {
            margin-top: 0;
            margin-bottom: 20px;
            font-weight: 600;
            font-size: 20px;
            position: relative;
            padding-bottom: 10px;
            border-bottom: 1px solid var(--border-color);
        }

        .cart-detail ul {
            list-style: none;
            padding: 0;
            margin: 0;
        }

        .cart-detail ul li {
            display: flex;
            justify-content: space-between;
            padding: 12px 0;
            border-bottom: 1px dashed var(--border-color);
            color: var(--light-text);
            font-size: 15px;
        }

        .orderTotal {
            font-weight: bold;
            color: var(--text-color);
            font-size: 18px;
        }

        /* Radio Buttons */
        .radio {
            padding: 10px 0;
        }

        .radio label {
            display: flex;
            align-items: center;
            font-size: 15px;
            cursor: pointer;
        }

        .radio input[type="radio"] {
            margin-right: 10px;
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            display: inline-block;
            width: 20px;
            height: 20px;
            padding: 2px;
            background-clip: content-box;
            border: 2px solid var(--border-color);
            background-color: white;
            border-radius: 50%;
        }

        .radio input[type="radio"]:checked {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            padding: 5px;
        }

        .radio input[type="radio"]:disabled {
            background-color: #eee;
            border-color: #ddd;
            cursor: not-allowed;
        }

        /* Button */
        .btn {
            display: inline-block;
            font-weight: 500;
            text-align: center;
            white-space: nowrap;
            vertical-align: middle;
            user-select: none;
            border: 1px solid transparent;
            padding: 12px 25px;
            font-size: 16px;
            line-height: 1.5;
            border-radius: 6px;
            transition: all 0.3s ease;
            cursor: pointer;
            margin-top: 15px;
            width: 100%;
        }

        .btn-primary {
            color: #fff;
            background-color: var(--primary-color);
            border-color: var(--primary-color);
        }

        .btn-primary:hover {
            background-color: var(--hover-color);
            border-color: var(--hover-color);
            box-shadow: 0 4px 10px rgba(62, 100, 255, 0.25);
            transform: translateY(-2px);
        }

        .btn-danger {
            color: #fff;
            background-color: var(--danger-color);
            border-color: var(--danger-color);
        }

        .btn-danger:hover {
            background-color: #c62828;
            border-color: #c62828;
            box-shadow: 0 4px 10px rgba(229, 57, 53, 0.25);
            transform: translateY(-2px);
        }

        .btn-momo {
            color: #fff;
            background-color: var(--momo-color);
            border-color: var(--momo-color);
        }

        .btn-momo:hover {
            background-color: #8e1a5c;
            border-color: #8e1a5c;
            box-shadow: 0 4px 10px rgba(174, 32, 112, 0.25);
            transform: translateY(-2px);
        }

        .row-pb-lg {
            padding-bottom: 50px;
        }

        /* Voucher Input */
        .voucher-container {
            margin-bottom: 15px;
            padding: 15px;
            background-color: var(--gray-bg);
            border-radius: 6px;
            border: 1px dashed var(--border-color);
        }

        .voucher-input-group {
            display: flex;
            margin-bottom: 10px;
        }

        .voucher-input {
            flex: 1;
            border-top-right-radius: 0;
            border-bottom-right-radius: 0;
            margin-right: -1px;
        }

        .voucher-button {
            border-top-left-radius: 0;
            border-bottom-left-radius: 0;
            padding: 12px 15px;
            background-color: var(--primary-color);
            color: white;
            border: 1px solid var(--primary-color);
            cursor: pointer;
            transition: all 0.3s;
            font-weight: 500;
        }

        .voucher-button:hover {
            background-color: var(--hover-color);
            border-color: var(--hover-color);
        }

        .voucher-info {
            font-size: 13px;
            color: var(--light-text);
            margin-top: 5px;
        }

        .payment-methods {
            margin-top: 20px;
        }

        .payment-method {
            margin-bottom: 15px;
        }

        .payment-icon {
            margin-right: 10px;
            font-size: 18px;
        }

        /* Responsive */
        @media (max-width: 992px) {
            .process::after {
                right: -15%;
                width: 30%;
            }

            .process span {
                width: 50px;
                height: 50px;
                font-size: 18px;
            }
        }

        @media (max-width: 768px) {
            .offset-md-1 {
                margin-left: 0;
            }

            .process-wrap {
                flex-direction: column;
                align-items: center;
            }

            .process {
                margin-bottom: 30px;
                width: 100%;
                display: flex;
                align-items: center;
            }

            .process::after {
                display: none;
            }

            .process span {
                margin: 0 20px 0 0;
            }

            .col-md-6 {
                flex: 0 0 100%;
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <div class="breadcrumbs">
        <div class="container">
            <div class="row">
                <div class="col">
                    <p class="bread"><span><a href="?view">Trang Chủ</a></span> / <span>THANH TOÁN</span></p>
                </div>
            </div>
        </div>
    </div>

    <div class="colorlib-product">
        <div class="container">
            <div class="row row-pb-lg">
                <div class="col-md-10 offset-md-1">
                    <div class="process-wrap">
                        <div class="process text-center active">
                            <p><span>01</span></p>
                            <h3>Giỏ hàng</h3>
                        </div>
                        <div class="process text-center active">
                            <p><span>02</span></p>
                            <h3>Thanh toán</h3>
                        </div>
                        <div class="process text-center">
                            <p><span>03</span></p>
                            <h3>Đặt hàng thành công</h3>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <form action="?view=order" method="post" class="colorlib-form" id="form_order">
                        <h2><i class="fas fa-user-circle"></i> Chi tiết thanh toán</h2>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="fname"><i class="fas fa-user"></i> Họ và Tên</label>
                                    <input type="text" id="fname" name="fname" class="form-control" placeholder="Nhập họ và tên của bạn" required value="<?php echo $kh['TenKH']?>">
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="address"><i class="fas fa-map-marker-alt"></i> Địa Chỉ</label>
                                    <input type="text" id="address" name="address" class="form-control" placeholder="Nhập địa chỉ giao hàng" required value="<?php echo $kh['DiaChi']?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="email"><i class="fas fa-envelope"></i> E-mail</label>
                                    <input type="email" id="email" name="email" class="form-control" placeholder="Nhập email của bạn" required value="<?php echo $kh['Email']?>">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="phone"><i class="fas fa-phone"></i> Số điện thoại</label>
                                    <input type="text" id="phone" name="phone" class="form-control" placeholder="Nhập số điện thoại" required value="<?php echo $kh['SDT']?>">
                                </div>
                            </div>
                            <input type="hidden" name="tongtien" value="<?php echo $_POST['tongtien'] ;?>">
                        </div>
                    </form>
                </div>

                <div class="col-lg-4">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="cart-detail">
                                <h2><i class="fas fa-shopping-cart"></i> Giỏ hàng</h2>



                                <ul>
                                    <li>
                                        <span><i class="fas fa-box"></i> <?php echo $_POST['sl'].' sản phẩm'; ?></span>
                                        <span><?php echo $_POST['tamtinh'].' đ'; ?></span>
                                    </li>
                                    <li>
                                        <span><i class="fas fa-tag"></i> Mã giảm giá</span>
                                        <span id="discount-amount"><?php echo number_format($_POST['tiensale']).' đ'; ?></span>
                                    </li>
                                    <li>
                                        <span class="orderTotal"><i class="fas fa-money-bill-wave"></i> Tổng cộng</span>
                                        <span class="orderTotal" id="total-amount"><?php echo number_format($_POST['tongtien']).' đ'; ?></span>
                                    </li>
                                </ul>
                            </div>
                        </div>

                        <div class="w-100"></div>

                        <div class="col-md-12">
                            <div class="cart-detail">
                                <h2><i class="fas fa-credit-card"></i> Phương thức thanh toán</h2>

                                <div class="payment-methods">
                                    <!-- Thanh toán khi nhận hàng -->
                                    <div class="payment-method">
                                        <button class="btn btn-primary" type="submit" name="order" form="form_order">
                                            <i class="fas fa-truck payment-icon"></i> Thanh Toán Khi Nhận Hàng
                                        </button>
                                    </div>

                                    <!-- Thanh toán MoMo QR -->
                                    <div class="payment-method">
                                        <form method="POST" target="_blank" enctype="application/x-www-form-urlencoded" action="view/xulythanhtoanmomo.php">
                                            <input type="hidden" value="<?php echo $_POST['tongtien'] ?>" name="tongtien">
                                            <button type="submit" name="momo" class="btn btn-momo">
                                                <i class="fas fa-qrcode payment-icon"></i> Thanh Toán MoMo QR Code
                                            </button>
                                        </form>
                                    </div>

                                    <!-- Thanh toán MoMo ATM -->
                                    <div class="payment-method">
                                        <form method="POST" target="_blank" enctype="application/x-www-form-urlencoded" action="view/xulythanhtoanmomo_atm.php">
                                            <input type="hidden" value="<?php echo $_POST['tongtien'] ?>" name="tongtien">
                                            <button type="submit" name="momo" class="btn btn-momo">
                                                <i class="fas fa-university payment-icon"></i> Thanh Toán MoMo ATM
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        // Script xử lý mã giảm giá (mẫu - cần tích hợp với backend)
        document.getElementById('apply-voucher').addEventListener('click', function() {
            const voucherCode = document.getElementById('voucher-code').value;
            if (voucherCode.trim() === '') {
                alert('Vui lòng nhập mã giảm giá!');
                return;
            }

            // Đây là phần mẫu, bạn cần xử lý AJAX hoặc form submit để kiểm tra mã giảm giá
            alert('Đang kiểm tra mã giảm giá: ' + voucherCode);

            // Giả lập xử lý mã giảm giá thành công
            // document.getElementById('discount-amount').textContent = '50,000 đ';
            // Tính toán lại tổng tiền sau khi áp dụng mã giảm giá
            // const newTotal = ...; // Logic tính tổng tiền mới
            // document.getElementById('total-amount').textContent = newTotal + ' đ';
        });
    </script>
</body>
</html>