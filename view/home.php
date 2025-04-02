<aside id="colorlib-hero">
    <div class="flexslider">
        <ul class="slides">
            <li style="background-image: url('webroot/image/slider/banner9.jpg');">
                <div class="overlay"></div>
            </li>
            <li style="background-image: url('webroot/image/slider/banner7.jpg');">
                <div class="overlay"></div>
            </li>
            <li style="background-image: url('webroot/image/slider/banner8.jpg');">
                <div class="overlay"></div>
            </li>
            <li style="background-image: url('webroot/image/slider/banner6.jpg');">
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
<div class="flexslider">
    <img src="webroot/image/slider/brand-2.jpg" alt="" width="100%" height="50%">
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
<div class="flexslider">
    <h2 class="text-center">SPONSORSHIP</h2>
    <p class="text-center">Ngắm nhìn những bức ảnh từ khách hàng của chúng tôi</p>
    <div class="row justify-content-center">
        <div class="col-6 col-sm-4 col-md-2 p-2">
            <img src="webroot/image/brand/spon1.jpeg" class="img-fluid" alt="Sponsor 1">
        </div>
        <div class="col-6 col-sm-4 col-md-2 p-2">
            <img src="webroot/image/brand/spon2.jpeg" class="img-fluid" alt="Sponsor 2">
        </div>
        <div class="col-6 col-sm-4 col-md-2 p-2">
            <img src="webroot/image/brand/spon3.jpeg" class="img-fluid" alt="Sponsor 3">
        </div>
        <div class="col-6 col-sm-4 col-md-2 p-2">
            <img src="webroot/image/brand/spon4.jpeg" class="img-fluid" alt="Sponsor 4">
        </div>
        <div class="col-6 col-sm-4 col-md-2 p-2">
            <img src="webroot/image/brand/spon5.jpeg" class="img-fluid" alt="Sponsor 5">
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

    <div class="flexslider">
        <h2 class="text-center">TIN TỨC</h2>
        <p class="text-center">Cập nhật những tin tức mới nhất về xu hướng thời trang</p>
        <div class="row justify-content-center">
            <div class="col-4 col-md-2 mt-5 mb-5">
                <img src="webroot/image/brand/tt1.jpeg" class="img-fluid" alt="Sponsor 1">
                <p class="fw-bold">FORM DÁNG THAM KHẢO TẠI PGM</p>
            </div>
            <div class="col-8 col-md-4 ">
                <img src="webroot/image/brand/tt2.jpeg" class="img-fluid" alt="Sponsor 2">
                <p class="fw-bold">CHÍNH SÁCH BẢO HÀNH ÁO DA TẠI PGM</p>
            </div>
            <div class="col-4 col-md-2 mt-5 mb-5">
                <img src="webroot/image/brand/tt3.jpeg" class="img-fluid" alt="Sponsor 3">
                <p class="fw-bold">HƯỚNG DẪN CÁCH GIẶT BẢO QUẢN SẢN PHẨM PGM</p>
            </div>
        </div>
    </div>
