<!DOCTYPE html>
<html>

<head>
    <title>BeeHat - MŨ THỜI TRANG SỐ 1 CHÂU Á</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700&display=swap" rel="stylesheet" />
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat&display=swap" rel="stylesheet">
    <!-- MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- Animate.css -->
    <link rel="stylesheet" href="webroot/css/template/animate.css">
    <!-- Icomoon Icon Fonts-->
    <link rel="stylesheet" href="webroot/css/template/icomoon.css">
    <!-- Ion Icon Fonts-->
    <link rel="stylesheet" href="webroot/css/template/ionicons.min.css">
    <!-- Bootstrap  -->
    <link rel="stylesheet" href="webroot/css/templats/bootstrap.min.css">

    <!-- Magnific Popup -->
    <link rel="stylesheet" href="webroot/css/template/magnific-popup.css">

    <!-- Flexslider  -->
    <link rel="stylesheet" href="webroot/css/template/flexslider.css">

    <!-- Owl Carousel -->
    <link rel="stylesheet" href="webroot/css/template/owl.carousel.min.css">
    <link rel="stylesheet" href="webroot/css/template/owl.theme.default.min.css">

    <!-- Date Picker -->
    <link rel="stylesheet" href="webroot/css/template/bootstrap-datepicker.css">
    <!-- Flaticons  -->
    <link rel="stylesheet" href="webroot/css/template/fonts/flaticon/font/flaticon.css">

    <!-- Theme style  -->
    <link rel="stylesheet" href="webroot/css/template/style.css">
    <!--  style of you -->
    <link rel="stylesheet" href="webroot/css/style.css">
    <link rel="stylesheet" href="path/to/flexslider.css">
    <script src="path/to/jquery.min.js"></script>
    <script src="path/to/jquery.flexslider-min.js"></script>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.js"></script>
    <!-- Thêm link CSS của Slick -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css"
        href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />

    <!-- Thêm link JavaScript của Slick -->
    <script type="text/javascript" src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script type="text/javascript" src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

</head>

<body>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v20.0&appId=1533313497052295" nonce="OQyEMvbb">
        </script>
    <div id="page">
        <nav class="colorlib-nav" role="navigation">

            <div class="top-menu">
                <div class="container">
                    <div class="row align-items-center">
                        <!-- Contact Information -->
                        <div class="col-sm-3 col-md-4 text-center text-md-left mb-3 mb-md-0">
                            <p class="text-dark fs-6 mb-0">
                                <i class="fa-solid fa-phone"></i> (+84) 123 456 789
                            </p>
                        </div>

                        <!-- Logo -->
                        <div class="col-sm-6 col-md-4 text-center mb-3 mb-md-0">
                            <div id="colorlib-logo">
                                <h2 class="text-center fw-bold">BeeHat</h2>
                                <h4 class="text-center">MŨ THỜI TRANG SỐ 1 CHÂU Á</h4>
                                <!-- <a href="?view">
                                        <img class="logo-header" src="webroot/image/logo/logos.jpg" alt="Logo">
                                    </a> -->
                            </div>
                        </div>
                        <div
                            class="col-md-3 d-flex justify-content-center justify-content-md-end align-items-center gap-2">
                            <li class="cart list-unstyled">
                                <a href="?view=user" class="d-inline-block">
                                    <i class="fas fa-user i-use fs-6"></i>
                                </a>
                                </li??>

                                <?php $dem = 0;
                                if (isset($_SESSION['cart_product'])) {
                                    foreach ($_SESSION['cart_product'] as $item_cart) {
                                        $dem = $dem + $item_cart['SoLuong'];
                                    }
                                } ?>
                            <li class="cart list-unstyled">
                                <a href="?view=cart">
                                    <i class="fas fa-basket-shopping"></i> Giỏ Hàng [<?php echo $dem; ?>]
                                </a>
                            </li>
                        </div>
                    </div>
                </div>

            </div>
            <div class="row border-top border-bottom border-secondary-subtle">
                <div class="container">
                    <div class="col-sm-12 text-left menu-1">
                        <ul>
                            <li><a href="?view">Trang Chủ</a></li>
                            <li><a href="?view=about">Giới thiệu</a></li>
                            <?php ;
                            $category = categorys();
                            while ($row = (mysqli_fetch_array($category))) {
                                echo '	<li><a href="?view=products-category&id=' . $row['MaNCC'] . '">' . $row['TenNCC'] . '</a></li>';
                            } ?>

                            <li><a href="?view=contact">Liên Hệ</a></li>

                        </ul>
                    </div>
                </div>

            </div>
    </div>
    <style>
        <style>#page {
            position: relative;
        }

        .fixed-row {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            background-color: white;
            /* Hoặc màu khác theo ý bạn */
            z-index: 1000;
            /* Để phần này nằm trên các phần tử khác */
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            /* Tạo bóng nhẹ */
        }

        .hidden-container {
            display: none;
            /* Ẩn container */
        }

        .top-menu {
            transition: opacity 0.3s ease;
            /* Hiệu ứng chuyển tiếp */
        }
    </style>


    </style>
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const container = document.querySelector('.top-menu');
            const fixedRow = document.querySelector('.row.border-top');

            window.addEventListener('scroll', function () {
                if (window.scrollY > container.offsetHeight) {
                    container.classList.add('hidden-container');
                    fixedRow.classList.add('fixed-row');
                } else {
                    container.classList.remove('hidden-container');
                    fixedRow.classList.remove('fixed-row');
                }
            });
        });
    </script>



    </nav>