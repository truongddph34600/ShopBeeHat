<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Giỏ hàng</title>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/css/bootstrap.min.css" rel="stylesheet">
    <style>
        :root {
            --primary-color: #ffc107;
            --secondary-color: #6c757d;
            --success-color: #198754;
            --light-color: #FFFFFF;
            --dark-color: #212529;
            --border-color: #dee2e6;
            --font-family: 'Segoe UI', Roboto, 'Helvetica Neue', sans-serif;
        }
        
        body {
                        font-family: 'Roboto', sans-serif;
                        background-color: #f9f9f9;
                        color: #444;
                        line-height: 1.7;
                    }
        
        .breadcrumbs {
            padding: 15px 0;
            background-color: #f3f4f6;
            margin-bottom: 20px;
            border-bottom: 1px solid var(--border-color);
        }
        
        .breadcrumbs p.bread {
            margin: 0;
            color: var(--secondary-color);
            font-size: 0.9rem;
        }
        
        .breadcrumbs a {
            color: var(--primary-color);
            text-decoration: none;
            transition: color 0.3s;
        }
        
        .breadcrumbs a:hover {
            color: #0d6efd;
            text-decoration: underline;
        }
        
        .process-wrap {
            display: flex;
            justify-content: space-between;
            margin-bottom: 40px;
            position: relative;
        }
        
        .process-wrap::before {
            content: '';
            position: absolute;
            top: 30px;
            left: 0;
            width: 100%;
            height: 2px;
            background: #e9ecef;
            z-index: -1;
        }
        
        .process {
            position: relative;
            width: 33.33%;
        }
        
        .process p {
            margin-bottom: 0;
        }
        
        .process span {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 60px;
            height: 60px;
            border-radius: 50%;
            background: #e9ecef;
            color: #495057;
            font-weight: bold;
            margin: 0 auto 10px;
            font-size: 1.2rem;
            transition: all 0.3s;
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .process.active span {
            background: var(--primary-color);
            color: white;
        }
        
        .process h3 {
            font-size: 1rem;
            font-weight: 600;
            margin: 5px 0;
            color: var(--secondary-color);
        }
        
        .process.active h3 {
            color: var(--primary-color);
            font-weight: 700;
        }
        
        .colorlib-product {
            padding: 30px 0;
        }
        
        .product-name {
            background: white;
            border-radius: 8px 8px 0 0;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            padding: 15px 0;
            margin-bottom: 1px;
            font-weight: 600;
            color: var(--dark-color);
            border-bottom: 2px solid var(--primary-color);
        }
        
        .product-cart {
            background: white;
            padding: 15px 0;
            margin-bottom: 1px;
            align-items: center;
            transition: all 0.2s;
            box-shadow: 0 1px 3px rgba(0,0,0,0.05);
        }
        
        .product-cart:hover {
            background-color: #f8f9fa;
            transform: translateY(-2px);
            box-shadow: 0 4px 6px rgba(0,0,0,0.1);
        }
        
        .product-img {
            width: 80px;
            height: 80px;
            background-size: cover;
            background-position: center;
            border-radius: 6px;
            margin-right: 15px;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .one-forth {
            display: flex;
            align-items: center;
            padding: 0 15px;
        }
        
        .one-forth h3 {
            font-size: 0.95rem;
            margin: 0;
            font-weight: 600;
            line-height: 1.4;
        }
        
        .one-eight {
            text-align: center;
        }
        
        .display-tc {
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100%;
        }
        
        .input-number {
            width: 60px;
            border-radius: 4px;
            text-align: center;
            border: 1px solid var(--border-color);
            height: 36px;
        }
        
        .closed {
            width: 30px;
            height: 30px;
            display: inline-block;
            background: transparent;
            position: relative;
            border: none;
            cursor: pointer;
        }
        
        .closed:after, .closed:before {
            content: "";
            position: absolute;
            top: 50%;
            left: 50%;
            width: 15px;
            height: 2px;
            background-color: #dc3545;
            transform: translate(-50%, -50%) rotate(45deg);
        }
        
        .closed:before {
            transform: translate(-50%, -50%) rotate(-45deg);
        }
        
        .closed:hover:after, .closed:hover:before {
            background-color: #c82333;
        }
        
        .total-wrap {
            background: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 2px 15px rgba(0,0,0,0.08);
            margin-top: 30px;
        }
        
        .total {
            border-top: 1px solid var(--border-color);
            padding-top: 20px;
            text-align: right;
        }
        
        .sub p, .grand-total p {
            display: flex;
            justify-content: space-between;
            margin-bottom: 10px;
        }
        
        .grand-total {
            border-top: 1px solid var(--border-color);
            padding-top: 15px;
            margin-top: 15px;
            font-weight: bold;
            font-size: 1.1em;
        }
        
        .btn-primary {
            background-color: var(--primary-color);
            border-color: var(--primary-color);
            border-radius: 4px;
            padding: 8px 20px;
            font-weight: 500;
            transition: all 0.2s;
        }
        
        .btn-primary:hover {
            background-color: #0b5ed7;
            border-color: #0a58ca;
            transform: translateY(-1px);
        }
        
        .btn-outline-success {
            color: var(--success-color);
            border-color: var(--success-color);
            border-radius: 4px;
            padding: 10px 25px;
            font-weight: 600;
            margin-top: 15px;
            transition: all 0.2s;
        }
        
        .btn-outline-success:hover {
            background-color: var(--success-color);
            color: white;
            transform: translateY(-1px);
        }
        
        .colorlib-heading {
            margin-bottom: 40px;
        }
        
        .colorlib-heading h2 {
            font-size: 1.5rem;
            font-weight: 700;
            position: relative;
            display: inline-block;
            padding-bottom: 10px;
        }
        
        .colorlib-heading h2:after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 50%;
            transform: translateX(-50%);
            width: 60px;
            height: 3px;
            background: var(--primary-color);
        }
        
        .wrapper-dt {
            margin-top: 20px;
        }
        
        .col-dt {
            padding: 10px;
        }
        
        .item {
            background: white;
            border-radius: 8px;
            overflow: hidden;
            transition: all 0.3s;
            box-shadow: 0 2px 10px rgba(0,0,0,0.05);
            height: 100%;
            position: relative;
        }
        
        .item:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 20px rgba(0,0,0,0.1);
        }
        
        .item img {
            width: 100%;
            height: 180px;
            object-fit: cover;
            transition: all 0.3s;
        }
        
        .item:hover img {
            transform: scale(1.05);
        }
        
        .product-lable {
            position: absolute;
            top: 10px;
            left: 0;
            z-index: 2;
        }
        
        .product-lable span {
            background: #ff6b6b;
            color: white;
            padding: 5px 10px;
            font-size: 0.75rem;
            border-radius: 0 4px 4px 0;
            font-weight: 600;
            box-shadow: 0 2px 5px rgba(0,0,0,0.1);
        }
        
        .item-name {
            padding: 10px 15px 5px;
        }
        
        .item-name p {
            font-weight: 600;
            margin: 0;
            font-size: 0.9rem;
            overflow: hidden;
            text-overflow: ellipsis;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            min-height: 43px;
        }
        
        .item-price {
            padding: 0 15px 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        
        .item-price p {
            color: #e63946;
            font-weight: 700;
            margin: 0;
            font-size: 1rem;
        }
        
        .item-price h6 {
            color: #6c757d;
            text-decoration: line-through;
            margin: 0;
            font-size: 0.8rem;
            font-weight: normal;
        }
        
        .custom-alert {
            position: fixed;
            bottom: 20px;
            right: 20px;
            z-index: 1050;
            display: flex;
            padding: 15px 25px;
            border-radius: 8px;
            box-shadow: 0 4px 12px rgba(0,0,0,0.15);
            animation: slideIn 0.5s forwards, fadeOut 0.5s 4.5s forwards;
            max-width: 350px;
        }
        
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
        
        @keyframes fadeOut {
            from { opacity: 1; }
            to { opacity: 0; display: none; }
        }
        
        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }
        
        .alert .close {
            font-size: 1.5rem;
            opacity: 0.5;
            transition: opacity 0.3s;
        }
        
        .alert .close:hover {
            opacity: 1;
        }
        
        a {
            text-decoration: none;
        }
    </style>
</head>
<body>

<div class="breadcrumbs">
    <div class="container">
        <div class="row">
            <div class="col">
                <p class="bread"><span><a href="?view"><i class="fas fa-home"></i> Trang Chủ</a></span> / <span>Giỏ hàng</span></p>
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
                    <div class="process text-center">
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
        <div class="row row-pb-lg">
            <div class="col-md-12">
                <div class="product-name d-flex">
                    <div class="one-forth text-left px-4">
                        <span>THÔNG TIN CHI TIẾT SẢN PHẨM</span>
                    </div>
                    <div class="one-eight text-center">
                        <span>Size</span>
                    </div>
                    <div class="one-eight text-center">
                        <span>Màu</span>
                    </div>
                    <div class="one-eight text-center">
                        <span>Giá</span>
                    </div>
                    <div class="one-eight text-center">
                        <span>Số lượng</span>
                    </div>
                    <div class="one-eight text-center">
                        <span>TỔNG CỘNG</span>
                    </div>
                    <div class="one-eight text-center px-4">
                        <span>Xóa</span>
                    </div>
                </div>
                <?php if(isset($_SESSION['cart_product'])){ $subtotal=0; $dem=0;
                    foreach ($_SESSION['cart_product'] as $item_cart) { $product=mysqli_fetch_array(product($item_cart['MaSP'])); ?>
                <div class="product-cart d-flex">
                    <div class="one-forth">
                        <div class="product-img" style="background-image: url('webroot/image/sanpham/<?php echo $product['AnhNen'];?>')">
                        </div>
                        <div class="display-tc">
                            <h3><?php echo $product['TenSP'] ; ?></h3>
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                        <span class="price"><?php echo $item_cart['Size'] ; ?></span>
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                        <span class="price"><?php echo $item_cart['Mau'] ; ?></span>
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <span class="price"><?php echo $item_cart['DonGia']  ; ?></span>
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <input type="text" id="quantity" name="quantity" class="form-control input-number text-center" value="<?php echo $item_cart['SoLuong'] ; ?>" min="1" max="100">
                        </div>
                    </div>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <span class="price"><?php $number = str_replace(',', '', $item_cart['DonGia']); echo number_format($number*$item_cart['SoLuong']); ?></span>
                        </div>
                    </div>
                    <form action="?view=addtocart" method="post" id="delete_cart_product">
                        <input type="hidden" name="productID" value="<?php echo $item_cart['MaSP']  ; ?>">
                        <input type="hidden" name="size" value="<?php echo $item_cart['Size']  ; ?>">
                        <input type="hidden" name="mau" value="<?php echo $item_cart['Mau']  ; ?>">
                    </form>
                    <div class="one-eight text-center">
                        <div class="display-tc">
                            <button type="submit" name=delete_cart_product form="delete_cart_product" class="closed" value="xoa"></button>
                        </div>
                    </div>
                </div>
                <?php  $subtotal= $subtotal+$number*$item_cart['SoLuong']; $dem = $dem+$item_cart['SoLuong']; }}else{ echo '<div class="text-center py-5"><i class="fas fa-shopping-cart fa-3x mb-3 text-muted"></i><p>Chưa có sản phẩm trong giỏ hàng của bạn</p><a href="?view" class="btn btn-primary mt-2">Tiếp tục mua sắm</a></div>';} ;?>
            </div>
        </div>
        <div class="row row-pb-lg">
            <div class="col-md-12">
                <div class="total-wrap">
                    <div class="row">
                        <div class="col-sm-8">
                            <form action="#">
                                <div class="row form-group">
                                    <div class="col-sm-9">
                                        <input type="text" id="Coupon" class="form-control input-number" placeholder="Mã giảm giá ...">
                                        <p><span id="coupon2"></span></p>
                                    </div>
                                    <div class="col-sm-3">
                                        <input type="button" id="Apply_Coupon" value="Áp dụng" class="btn btn-primary">
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="col-sm-4 text-center">
                            <div class="total">
                                <div class="sub">
                                    <p><span>Tạm tính:</span> <span id="subtotal"><?php if(isset($_SESSION['cart_product'])){ echo number_format($subtotal);}else echo '0'; ?> </span></p>
                                    <p><span>Giảm giá:</span> <span id="coupon_apply"> 0</span></p>
                                </div>
                                <div class="grand-total">
                                    <p><span><strong>Tổng cộng:</strong></span> <span id="total"><?php if(isset($_SESSION['cart_product'])){ echo number_format($subtotal);}else echo '0'; ?> </span></p>
                                </div>
                                
                            </div>
                            <div class="col-sm-12">
                                <form action="?view=thanhtoan2" method="post">
                                    <input type="hidden" name="sl" value="<?php echo $dem; ?>">
                                    <input type="hidden" name="tamtinh" value="<?php echo isset($subtotal) ? number_format($subtotal) : '0'; ?>">
                                    <input type="hidden" name="tiensale" id="tiensale" value="0">
                                    <input type="hidden" name="tongtien" id="tongtien" value="<?php echo isset($subtotal) ? $subtotal : '0'; ?>">
                                    <button type="submit" class="btn btn-outline-success" name="thanhtoan" value="2" data-mdb-ripple-color="dark" onclick="return validateCart()">
                                        <i class="fas fa-credit-card me-2"></i> Thanh toán
                                    </button>
                                </form>
                            </div>

                            <script>
                            function validateCart() {
                                var sl = <?php echo isset($dem) ? $dem : 0; ?>;
                                if (sl <= 0) {
                                    alert("Bạn chưa có đơn đặt hàng nào!");
                                    return false;
                                }
                                return true;
                            }
                            </script>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="colorlib-product">
            <div class="container">
                <div class="row">
                    <div class="col-sm-8 offset-sm-2 text-center colorlib-heading colorlib-heading-sm">
                        <h2>SẢN PHẨM TƯƠNG TỰ</h2>
                    </div>
                </div>
                <?php
                $product = product_rand();
                ?>

                <div class="container">
                    <div class="row wrapper-dt">
                        <div class="col-12">
                            <div class="row pad-dt">
                                <div class="row pad-dt"><?php while ($row = mysqli_fetch_array($product)) { ?>
                                        <div class="col-3 col-dt">
                                            <a href="?view=product-detail&id=<?php echo $row['MaSP'] ?>">
                                                <div class="item">
                                                    <div class="product-lable">
                                                        <?php $price_sale = price_sale($row['MaSP'], $row['DonGia']);
                                                            if ($price_sale < $row['DonGia']) {
                                                                echo '<span>Giảm ' . number_format($row['DonGia'] - $price_sale) . 'đ </span>';
                                                            } ?>
                                                    </div>
                                                    <div><img src="webroot/image/sanpham/<?php echo $row['AnhNen']; ?>"></div>
                                                    <div class="item-name">
                                                        <p> <?php echo $row['TenSP']; ?> </p>
                                                    </div>
                                                    <div class="item-price">
                                                        <p> <?php echo number_format($price_sale, 0) . 'đ'; ?> </p>
                                                        <h6> <?php if (number_format($row['DonGia']) !== number_format($price_sale)) {
                                                                    echo number_format($row['DonGia']) . 'đ';
                                                                };  ?>
                                                        </h6>
                                                    </div>
                                                </div>
                                            </a>
                                        </div><?php }  ?>
                                    <div id="data_sp"></div>
                                </div>
                            </div>
                        </div>
                        <div id="loading" style="display:none">
                            <img src="webroot/image/loader.gif" alt="Loading..." />
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>
</div>

<?php 
    if(isset($_GET['alert'])){ ?> 
    <div id="alertDiv" class="alert alert-success alert-dismissible fade custom-alert show" role="alert">
        <strong><i class="fas fa-check-circle me-2"></i><?php if($_GET['alert']!==''){ echo ' '.$_GET['alert'];} ?></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    
    <script>
        setTimeout(function(){
            document.getElementById('alertDiv').classList.remove('show');
            setTimeout(function(){
                document.getElementById('alertDiv').style.display = 'none';
            }, 500);
        }, 5000);
    </script>
<?php  }
?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>
</body>
</html>