
<aside id="colorlib-hero">
    <div class="flexslider">
        <ul class="slides">
            <li style="background-image: url('webroot/image/slider/slide1.jpg');">
                <div class="overlay"></div>
            </li>
            <li style="background-image: url('webroot/image/slider/slide2.jpg');">
                <div class="overlay"></div>
            </li>
            <li style="background-image: url('webroot/image/slider/slide4.jpg');">
                <div class="overlay"></div>
            </li>
            <li style="background-image: url('webroot/image/slider/slide1.jpg');">
                <div class="overlay"></div>
            </li>
        </ul>
    </div>
</aside>


<div class="colorlib-product">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 offset-sm-2 text-center ">
                <h2>SẢN PHẨM NỔI BẬT</h2>
            </div>
        </div>
        <?php
        $product = featuredProductsL4();
        ?>

<div class="container ">
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
                                                }
                                                ; ?>
                                                </h6>
                                            </div>
                                        </div>
                                    </a>
                                </div><?php } ?>
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



<div class="colorlib-product">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 offset-sm-2 text-center ">
                <h2>SẢN PHẨM MỚI</h2>
            </div>
        </div>
        <?php
        $product = newsProductsL4();
        ?>


        <div class="container ">
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
                                                }
                                                ; ?>
                                                </h6>
                                            </div>
                                        </div>
                                    </a>
                                </div><?php } ?>
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
<div class="colorlib-product">
    <div class="container">
        <div class="row">
            <div class="col-sm-8 offset-sm-2 text-center ">
                <h2>SẢN PHẨM BÁN CHẠY</h2>
            </div>
        </div>
        <?php
        $product = sellingProductsL4();
        ?>


        <div class="container ">
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
                                                }
                                                ; ?>
                                                </h6>
                                            </div>
                                        </div>
                                    </a>
                                </div><?php } ?>
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

<div class="brand-showcase py-5 bg-light">
    <div class="container">
        <div class="text-center mb-5">
            <h2 class="display-6 fw-bold mb-3 text-primary">
                <i class="fas fa-handshake me-2"></i>Đối Tác Danh Tiếng
            </h2>
            <p class="lead text-muted">Cùng hợp tác với những thương hiệu hàng đầu thế giới</p>
        </div>

        <div class="row g-4 justify-content-center">
            <div class="col-6 col-md-4 col-lg-2">
                <div class="brand-card hover-lift">
                    <img src="webroot/image/brand/gucci.jpg" alt="Brand 1" class="img-fluid rounded-3 shadow">
                </div>
            </div>
        <div class="col-6 col-md-4 col-lg-2">
                        <div class="brand-card hover-lift">
                            <img src="webroot/image/brand/adidas.jpg" alt="Brand 2" class="img-fluid rounded-3 shadow">
                        </div>
                    </div>
                <div class="col-6 col-md-4 col-lg-2">
                                <div class="brand-card hover-lift">
                                    <img src="webroot/image/brand/nike.jpg" alt="Brand 3" class="img-fluid rounded-3 shadow">
                                </div>
                            </div>
                        <div class="col-6 col-md-4 col-lg-2">
                                        <div class="brand-card hover-lift">
                                            <img src="webroot/image/brand/varsace.jpg" alt="Brand 4" class="img-fluid rounded-3 shadow">
                                        </div>
                                    </div>
                                <div class="col-6 col-md-4 col-lg-2">
                                                <div class="brand-card hover-lift">
                                                    <img src="webroot/image/brand/louisvuitton.jpg" alt="Brand 5" class="img-fluid rounded-3 shadow">
                                                </div>

                                            </div>


            <!-- Repeat similar blocks for other brand images -->
        </div>
    </div>

</div>
