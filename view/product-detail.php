<?php
    if (isset($_GET['id'])==false) {header('Location:?view'); }
    $id = $_GET['id'];
    if ( product($id)==false) { header('Location:?view');}
    $product=mysqli_fetch_array(product($id));
    $price_sale=price_sale($product['MaSP'],$product['DonGia']);
    $product_detail_size=product_detail_size($id);
    $product_detail_color=product_detail_color($id);
    $product_review=product_review($id);
    if(product_detail_image($id)==false){$product_detail_image=array('Anh1'=>'loader.gif','Anh2'=>'loader.gif','Anh3'=>'loader.gif','Anh4'=>'loader.gif'); }else{ $product_detail_image=mysqli_fetch_array(product_detail_image($id));}
?>
<style>
    :root {
          --primary-color: #ffc107;
          --primary-hover: #2da89a;
          --secondary-color: #f8f9fa;
          --text-color: #444;
          --light-text: #888;
          --dark-text: #222;
          --success-color: #28a745;
        }
    body {
                font-family: 'Roboto', sans-serif;
                background-color: #f9f9f9;
                color: #444;
                line-height: 1.7;
            }
    /* Định dạng chung */
    .breadcrumbs {
        background: #f9f9f9;
        padding: 12px 0;
        margin-bottom: 30px;
        box-shadow: 0 2px 5px rgba(0,0,0,0.05);
    }

    .breadcrumbs .bread {
        margin: 0;
        font-size: 14px;
    }

    .breadcrumbs a {
        color: #4e73df;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .breadcrumbs a:hover {
        color: #224abe;
    }

    .colorlib-product {
        padding: 20px 0 60px;
    }

    /* Định dạng chi tiết sản phẩm */
    .product-detail-wrap {
        margin-bottom: 50px;
        background: #fff;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.08);
        padding: 30px;
    }

    .product-entry {
        overflow: hidden;
        border-radius: 8px;
        transition: all 0.3s ease;
    }

    .product-entry:hover {
        transform: translateY(-5px);
    }

    .prod-img img {
        border-radius: 8px;
        object-fit: cover;
        width: 100%;
        height: 450px;
        transition: all 0.5s ease;
    }

    .prod-img img:hover {
        transform: scale(1.03);
    }

    /* Định dạng thông tin sản phẩm */
    .product-desc h3 {
        font-size: 24px;
        font-weight: 600;
        margin-bottom: 15px;
        color: #333;
    }

    .price {
        display: flex;
        align-items: center;
        flex-wrap: wrap;
        margin-bottom: 20px;
    }

    .price span:first-child {
        font-size: 24px;
        font-weight: 600;
        color: #ff6b6b;
        margin-right: 15px;
    }

    .price-old {
        text-decoration: line-through;
        color: #aaa;
        font-size: 16px;
    }

    .rate {
        margin-left: auto;
    }

    .rate i {
        color: #ffd43b;
        margin-right: 2px;
    }

    /* Size và màu sắc */
    .size-wrap {
        margin-bottom: 25px;
    }

    .size-wrap h4 {
        font-size: 16px;
        font-weight: 600;
        margin-bottom: 12px;
        border-left: 3px solid #4e73df;
        padding-left: 10px;
    }

    .box-size, .box-mau {
        display: inline-block;
        margin-right: 10px;
        margin-bottom: 10px;
        position: relative;
    }

    .box-size input, .box-mau input {
        position: absolute;
        opacity: 0;
        cursor: pointer;
    }

    .box-size label, .box-mau label {
        display: inline-block;
        padding: 6px 12px;
        border: 1px solid #ddd;
        border-radius: 5px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .box-size label h6, .box-mau label h6 {
        margin: 0;
        font-size: 14px;
    }

    .box-size input:checked + label, .box-mau input:checked + label {
        background: #4e73df;
        border-color: #4e73df;
        color: white;
    }

    .box-size label:hover, .box-mau label:hover {
        border-color: #4e73df;
    }

    /* Số lượng */
    .input-group {
        margin: 25px 0;
    }

    .input-group-btn .btn {
        border: 1px solid #ddd;
        background: #f8f9fc;
        border-radius: 5px;
        width: 40px;
        height: 40px;
        display: flex;
        align-items: center;
        justify-content: center;
        transition: all 0.3s ease;
    }

    .input-group-btn .btn:hover {
        background: #eaecf4;
    }

    .input-number {
        width: 60px;
        height: 40px;
        text-align: center;
        font-weight: 600;
        margin: 0 10px;
        border: 1px solid #ddd;
        border-radius: 5px;
    }

    /* Nút thêm vào giỏ hàng */
    .btn-primary {
        background: #4e73df;
        border: none;
        padding: 12px 25px;
        border-radius: 5px;
        font-weight: 600;
        letter-spacing: 0.5px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        box-shadow: 0 4px 6px rgba(78, 115, 223, 0.25);
    }

    .btn-primary:hover {
        background: #2e59d9;
        transform: translateY(-2px);
        box-shadow: 0 6px 10px rgba(78, 115, 223, 0.3);
    }

    /* Tab nội dung */
    .pills {
        margin-top: 30px;
    }

    .nav-pills .nav-link {
        color: #666;
        font-weight: 600;
        border-radius: 5px;
        padding: 12px 25px;
        background: #f1f3f9;
        margin-right: 10px;
        transition: all 0.3s ease;
    }

    .nav-pills .nav-link.active {
        color: white;
        background: #4e73df;
        box-shadow: 0 4px 10px rgba(78, 115, 223, 0.25);
    }

    .tab-content {
        margin-top: 20px;
    }

    .tab-pane {
        padding: 25px;
        border-radius: 8px;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        line-height: 1.8;
    }

    /* Đánh giá */
    .cmt-box {
        margin-bottom: 25px;
    }

    .cmt-box textarea {
        width: 100%;
        height: 100px;
        padding: 15px;
        border: 1px solid #ddd;
        border-radius: 8px;
        margin-bottom: 15px;
        resize: none;
        transition: all 0.3s ease;
    }

    .cmt-box textarea:focus {
        border-color: #4e73df;
        outline: none;
        box-shadow: 0 0 0 3px rgba(78, 115, 223, 0.1);
    }

    .review {
        display: flex;
        margin-bottom: 20px;
        padding-bottom: 20px;
        border-bottom: 1px solid #f1f1f1;
    }

    .user-img {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        background-size: cover;
        background-position: center;
        margin-right: 20px;
        border: 3px solid #eaecf4;
    }

    .review .desc {
        flex: 1;
    }

    .review h4 {
        display: flex;
        justify-content: space-between;
        margin-bottom: 10px;
        font-size: 16px;
    }

    .review .star {
        margin-bottom: 10px;
    }

    .star i {
        color: #ffd43b;
        margin-right: 3px;
    }

    /* Sản phẩm tương tự */
    .colorlib-heading {
        margin-bottom: 30px;
    }

    .colorlib-heading h2 {
        font-size: 24px;
        font-weight: 600;
        position: relative;
        display: inline-block;
        padding-bottom: 10px;
    }

    .colorlib-heading h2:after {
        content: '';
        position: absolute;
        width: 50%;
        height: 3px;
        background: #4e73df;
        bottom: 0;
        left: 25%;
    }

    .wrapper-dt {
        margin-top: 20px;
    }

    .pad-dt {
        margin: 0 -10px;
    }

    .col-dt {
        padding: 10px;
        transition: all 0.3s ease;
    }

    .col-dt:hover {
        transform: translateY(-5px);
    }

    .col-dt a {
        text-decoration: none;
        color: inherit;
    }

    .col-dt .item {
        background: white;
        border-radius: 8px;
        overflow: hidden;
        box-shadow: 0 5px 15px rgba(0,0,0,0.05);
        transition: all 0.3s ease;
        height: 100%;
    }

    .col-dt .item:hover {
        box-shadow: 0 8px 20px rgba(0,0,0,0.1);
    }

    .product-lable {
        position: absolute;
        top: 10px;
        left: 10px;
        z-index: 1;
    }

    .product-lable span {
        background: #ff6b6b;
        color: white;
        padding: 5px 10px;
        border-radius: 4px;
        font-size: 12px;
        font-weight: 600;
    }

    .col-dt img {
        width: 100%;
        height: 200px;
        object-fit: cover;
        transition: all 0.5s ease;
    }

    .col-dt img:hover {
        transform: scale(1.05);
    }

    .item-name {
        padding: 15px 15px 5px;
    }

    .item-name p {
        font-weight: 600;
        margin: 0;
        font-size: 14px;
        color: #333;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .item-price {
        padding: 0 15px 15px;
        display: flex;
        align-items: center;
        justify-content: space-between;
    }

    .item-price p {
        font-weight: 600;
        color: #ff6b6b;
        margin: 0;
    }

    .item-price h6 {
        color: #aaa;
        text-decoration: line-through;
        margin: 0;
        font-size: 12px;
    }

    /* Responsive */
    @media (max-width: 991px) {
        .prod-img img {
            height: 350px;
        }
    }

    @media (max-width: 767px) {
        .product-detail-wrap {
            padding: 15px;
        }

        .prod-img img {
            height: 300px;
        }

        .nav-pills .nav-link {
            padding: 8px 15px;
            font-size: 14px;
        }
    }

    /* Animations */
    @keyframes fadeIn {
        from { opacity: 0; }
        to { opacity: 1; }
    }

    .product-detail-wrap {
        animation: fadeIn 0.8s ease;
    }

    /* Loading animation */
    #loading {
        text-align: center;
        margin-top: 20px;
    }

    #loading img {
        width: 50px;
        height: 50px;
    }
</style>



<div class="colorlib-product">
    <div class="container">
        <div class="row row-pb-lg product-detail-wrap">
            <div class="col-sm-8">
                <div class="owl-carousel">
                    <div class="item">
                        <div class="product-entry border">
                            <a href="#" class="prod-img">
                                <img src="webroot/image/sanpham/<?php echo $product_detail_image['Anh1'] ?>" class="img-fluid" alt="Hình ảnh sản phẩm">
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="product-entry border">
                            <a href="#" class="prod-img">
                                <img src="webroot/image/sanpham/<?php echo $product_detail_image['Anh2'] ?>" class="img-fluid" alt="Hình ảnh sản phẩm">
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="product-entry border">
                            <a href="#" class="prod-img">
                                <img src="webroot/image/sanpham/<?php echo $product_detail_image['Anh3'] ?>" class="img-fluid" alt="Hình ảnh sản phẩm">
                            </a>
                        </div>
                    </div>
                    <div class="item">
                        <div class="product-entry border">
                            <a href="#" class="prod-img">
                                <img src="webroot/image/sanpham/<?php echo $product_detail_image['Anh4'] ?>" class="img-fluid" alt="Hình ảnh sản phẩm">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <form class="col-sm-4" action="?view=addtocart" method="post" id="form1">
                <div class="product-desc">
                    <h3><?php echo $product['TenSP']; ?></h3>
                    <p class="price">
                        <span><?php echo number_format($price_sale,0).'₫'; ?></span>
                        <?php if(number_format($product['DonGia']) !== number_format($price_sale)){ ?>
                        <span class="price-old"><?php echo  number_format($product['DonGia'], 0 ).' '.' ₫' ; ?></span> <?php } ?>
                        <span class="rate">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </span>
                    </p>
                </div>
                <div class="size-wrap">
                    <div class="block-26 mb-2">
                        <h4>Size</h4>
                        <div class="size-options">
                            <?php while ($row=(mysqli_fetch_array($product_detail_size))) {?>
                                <div class="box-size">
                                    <input type="radio" class="custom-control-input" id="<?php echo $row['MaSize'];?>" name="size" value="<?php echo $row['MaSize'];?>" required>
                                    <label class="custom-control-label" for="<?php echo $row['MaSize'];?>"><h6><?php echo $row['MaSize'];?></h6></label>
                                </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <div class="size-wrap">
                    <div class="block-26 mb-2">
                        <h4>Màu</h4>
                        <div class="color-options">
                            <?php while ($row=(mysqli_fetch_array($product_detail_color))) {?>
                            <div class="box-mau">
                                <input type="radio" class="custom-control-input" id="<?php echo $row['MaMau'];?>" name="mau" value="<?php echo $row['MaMau'];?>" required>
                                <label class="custom-control-label" for="<?php echo $row['MaMau'];?>"><h6><?php echo $row['MaMau'];?></h6></label>
                            </div>
                            <?php }?>
                        </div>
                    </div>
                </div>
                <div class="input-group mb-4">
                    <span class="input-group-btn">
                        <button type="button" class="quantity-left-minus btn" id="tru"><i class="fas fa-minus"></i></button>
                    </span>
                    <input type="text" id="soluong" name="soluong" class="form-control input-number" value="1" min="1" max="10">
                    <span class="input-group-btn ml-1">
                        <button type="button" class="quantity-right-plus btn" id="cong"><i class="fas fa-plus"></i></button>
                    </span>
                </div>
                <input type="hidden" name="idproduct" form="form1" value='<?php echo $product['MaSP'] ?>'>
                <input type="hidden" name="dongia" form="form1" value='<?php echo number_format($price_sale) ?>'>
                <div class="col-sm-12 text-center">
                    <p class="addtocart"><button type="submit" form="form1" name='addtocart' class="btn col-sm-12 btn-primary">Thêm vào giỏ hàng</button></p>
                </div>
            </form>
        </div>
        <div class="row">
            <div class="col-sm-12">
                <div class="row">
                    <div class="col-md-12 pills">
                        <div class="bd-example bd-example-tabs">
                            <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="pills-description-tab" data-toggle="pill" href="#pills-description" role="tab" aria-controls="pills-description" aria-expanded="true">Mô tả</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" id="pills-review-tab" data-toggle="pill" href="#pills-review" role="tab" aria-controls="pills-review" aria-expanded="true">Đánh giá</a>
                                </li>
                            </ul>
                            <div class="tab-content" id="pills-tabContent">
                                <div class="tab-pane border fade show active" id="pills-description" role="tabpanel" aria-labelledby="pills-description-tab">
                                    <p><?php echo $product['MoTa'] ?></p>
                                    <div class="care-instructions">
                                        <h5>Hướng dẫn bảo quản:</h5>
                                        <ul>
                                            <li>Không dùng hóa chất tẩy.</li>
                                            <li>Ủi ở nhiệt độ thích hợp, hạn chế dùng máy sấy.</li>
                                            <li>Giặt ở chế độ bình thường, với đồ có màu tương tự.</li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-pane border fade" id="pills-review" role="tabpanel" aria-labelledby="pills-review-tab">
                                    <div class="cmt-box">
                                        <form action="?view=addtoreview" method="post" id='form2'>
                                            <textarea name="noidung" id="noidung" placeholder="Viết đánh giá của bạn..."></textarea>
                                            <input type="hidden" name="masp" form="form2" value='<?php echo $product['MaSP'] ?>'>
                                            <button form='form2' name="action" value="binhluan" type="submit" class="btn btn-primary">Gửi đánh giá</button>
                                        </form>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <h3 class="head"><?php if($product_review==false){ echo "Chưa có đánh giá nào";}else{ echo mysqli_num_rows($product_review) .' Đánh giá'  ;?></h3>
                                            <?php while($row=mysqli_fetch_array($product_review))  { $rowkh=selectKH($row['MaKH']) ?>
                                            <div class="review">
                                                <div class="user-img" style="background-image: url('webroot/image/logo/user.png')"></div>
                                                <div class="desc">
                                                    <h4>
                                                        <span class="text-left"><?php echo $rowkh['TenKH'] ?></span>
                                                        <span class="text-right"><?php echo $row['ThoiGian'] ?></span>
                                                    </h4>
                                                    <p class="star">
                                                        <span>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        <i class="fas fa-star"></i>
                                                        </span>
                                                    </p>
                                                    <p><?php echo $row['NoiDung'] ?></p>
                                                </div>
                                            </div>
                                            <?php } }?>
                                        </div>
                                    </div>
                                </div>
                            </div>
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
                                                <div class="product-image">
                                                    <img src="webroot/image/sanpham/<?php echo $row['AnhNen']; ?>" alt="<?php echo $row['TenSP']; ?>">
                                                </div>
                                                <div class="item-name">
                                                    <p><?php echo $row['TenSP']; ?></p>
                                                </div>
                                                <div class="item-price">
                                                    <p><?php echo number_format($price_sale, 0) . 'đ'; ?></p>
                                                    <h6><?php if (number_format($row['DonGia']) !== number_format($price_sale)) {
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

<script>
    // Script để tăng giảm số lượng
    document.addEventListener('DOMContentLoaded', function() {
        const quantityInput = document.getElementById('soluong');
        const minusBtn = document.getElementById('tru');
        const plusBtn = document.getElementById('cong');

        // Set min, max values
        const minValue = 1;
        const maxValue = 10;

        // Decrease quantity
        minusBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue > minValue) {
                quantityInput.value = currentValue - 1;
            }
        });

        // Increase quantity
        plusBtn.addEventListener('click', function() {
            let currentValue = parseInt(quantityInput.value);
            if (currentValue < maxValue) {
                quantityInput.value = currentValue + 1;
            }
        });

        // Validate input
        quantityInput.addEventListener('change', function() {
            let currentValue = parseInt(quantityInput.value);
            if (isNaN(currentValue) || currentValue < minValue) {
                quantityInput.value = minValue;
            } else if (currentValue > maxValue) {
                quantityInput.value = maxValue;
            }
        });
    });
</script>