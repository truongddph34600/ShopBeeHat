<!DOCTYPE html>
<html lang="vi">

<head>
    <title>BeeHat - MŨ THỜI TRANG SỐ 1 CHÂU Á</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="BeeHat - Cửa hàng chuyên cung cấp các loại mũ thời trang cao cấp số 1 châu Á">

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet" />

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@300;400;500;600;700&family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap & MDB -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/mdb-ui-kit/6.3.1/mdb.min.css" rel="stylesheet" />

    <!-- Template CSS -->
    <link rel="stylesheet" href="webroot/css/template/animate.css">
    <link rel="stylesheet" href="webroot/css/template/icomoon.css">
    <link rel="stylesheet" href="webroot/css/template/ionicons.min.css">
    <link rel="stylesheet" href="webroot/css/template/magnific-popup.css">
    <link rel="stylesheet" href="webroot/css/template/flexslider.css">
    <link rel="stylesheet" href="webroot/css/template/owl.carousel.min.css">
    <link rel="stylesheet" href="webroot/css/template/owl.theme.default.min.css">
    <link rel="stylesheet" href="webroot/css/template/bootstrap-datepicker.css">
    <link rel="stylesheet" href="webroot/css/template/style.css">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="webroot/css/style.css">

    <!-- Slick Carousel -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />

    <!-- Leaflet Maps -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/leaflet@1.7.1/dist/leaflet.css" />

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="webroot/image/logo/favicon.ico">

    <style>
        :root {
            --primary-color: #ffc107;
            --secondary-color: #333333;
            --light-color: #FFFFFF;
            --dark-color: #212529;
            --accent-color: #ffc107;
        }

        body {
                        font-family: 'Roboto', sans-serif;
                        background-color: #f9f9f9;
                        color: #444;
                        line-height: 1.7;
                    }

        .top-header {
            background-color: var(--light-color);
            padding: 10px 0;
            transition: all 0.3s ease;
        }

        .logo-header {
            max-height: 80px;
            transition: all 0.3s ease;
        }

        .nav-menu {
            background-color: white;
            border-top: 1px solid #eee;
            border-bottom: 1px solid #eee;
            transition: all 0.3s ease;
            padding: 10px 0;
        }

        .nav-menu ul {
            display: flex;
            margin: 0;
            padding: 0;
            list-style: none;
            justify-content: center;
        }

        .nav-menu ul li {
            margin: 0 15px;
            position: relative;
        }

        .nav-menu ul li a {
            color: var(--dark-color);
            font-weight: 500;
            font-size: 16px;
            text-decoration: none;
            text-transform: uppercase;
            letter-spacing: 0.5px;
            padding: 8px 0;
            display: block;
            position: relative;
            transition: all 0.3s ease;
        }

        .nav-menu ul li a:hover,
        .nav-menu ul li a.active {
            color: var(--primary-color);
        }

        .nav-menu ul li a:after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            background-color: var(--primary-color);
            left: 0;
            bottom: 0;
            transition: width 0.3s ease;
        }

        .nav-menu ul li a:hover:after,
        .nav-menu ul li a.active:after {
            width: 100%;
        }

        .header-actions {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .header-actions a {
            color: var(--dark-color);
            text-decoration: none;
            transition: all 0.3s ease;
            position: relative;
        }

        .header-actions a:hover {
            color: var(--primary-color);
        }

        .cart-icon {
            position: relative;
        }

        .cart-count {
            position: absolute;
            top: -10px;
            right: -10px;
            background-color: var(--primary-color);
            color: white;
            border-radius: 50%;
            width: 20px;
            height: 20px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 12px;
            font-weight: bold;
        }

        /* Sticky header */
        .sticky-header {
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            z-index: 1000;
            background-color: white;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
            animation: slideDown 0.5s ease;
        }

        .sticky-header .logo-header {
            max-height: 60px;
        }

        @keyframes slideDown {
            from {
                transform: translateY(-100%);
            }
            to {
                transform: translateY(0);
            }
        }

        /* Mobile menu */
        .mobile-menu-toggle {
            display: none;
            cursor: pointer;
            font-size: 24px;
        }

        @media (max-width: 991px) {
            .mobile-menu-toggle {
                display: block;
            }

            .nav-menu ul {
                flex-direction: column;
                position: absolute;
                top: 100%;
                left: 0;
                right: 0;
                background-color: white;
                box-shadow: 0 5px 10px rgba(0,0,0,0.1);
                padding: 10px 0;
                z-index: 1000;
                display: none;
            }

            .nav-menu ul.show {
                display: flex;
            }

            .nav-menu ul li {
                margin: 5px 15px;
            }

            .top-header .row {
                flex-wrap: wrap;
            }

            .top-header .col-md-4 {
                margin-bottom: 10px;
            }
        }

        /* Animation effects */
        @keyframes fadeIn {
            from {
                opacity: 0;
            }
            to {
                opacity: 1;
            }
        }

        .fade-in {
            animation: fadeIn 0.5s ease;
        }
    </style>
</head>

<body>
    <!-- Facebook SDK -->
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous"
        src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v20.0&appId=1533313497052295" nonce="OQyEMvbb">
    </script>

    <div id="page" class="fade-in">
        <!-- Header Area -->
        <header id="header">
            <!-- Top Header with Contact Info and Logo -->
            <div class="top-header">
                <div class="container">
                    <div class="row align-items-center py-2">
                        <!-- Logo -->
                                                <div class="col-lg-4 col-md-4 col-8 text-center">
                                                    <div id="site-logo">
                                                        <a href="?view">
                                                            <img class="logo-header img-fluid" src="webroot/image/logo/logos.png" alt="BeeHat Logo">
                                                        </a>
                                                    </div>
                                                </div>
                        <!-- Contact Information -->
                        <div class="col-lg-4 col-md-4 d-none d-md-block">
                            <div class="d-flex align-items-center">
                            </div>
                        </div>
                        <!-- User and Cart -->
                        <div class="col-lg-4 col-md-4 col-4 d-flex justify-content-end align-items-center">
                            <div class="header-actions">
                                <a href="?view=user" class="user-icon" title="Tài khoản">
                                    <i class="fas fa-user fs-5"></i>
                                </a>

                                <?php $dem = 0;
                                if (isset($_SESSION['cart_product'])) {
                                    foreach ($_SESSION['cart_product'] as $item_cart) {
                                        $dem = $dem + $item_cart['SoLuong'];
                                    }
                                } ?>

                                <a href="?view=cart" class="cart-icon" title="Giỏ hàng">
                                    <i class="fas fa-shopping-bag fs-5"></i>
                                    <span class="cart-count"><?php echo $dem; ?></span>
                                </a>

                                <div class="mobile-menu-toggle d-lg-none">
                                    <i class="fas fa-bars"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Main Navigation Menu -->
            <div class="nav-menu">
                <div class="container">
                    <div class="row">
                        <div class="col-12">
                            <nav id="main-nav">
                                <ul>
                                    <li><a href="?view" class="<?php echo empty($_GET['view']) || $_GET['view'] === 'index' ? 'active' : ''; ?>">Trang Chủ</a></li>
                                    <li><a href="?view=about" class="<?php echo isset($_GET['view']) && $_GET['view'] === 'about' ? 'active' : ''; ?>">Giới Thiệu</a></li>
                                    <li><a href="?view=products" class="<?php echo isset($_GET['view']) && $_GET['view'] === 'products' ? 'active' : ''; ?>">Sản Phẩm</a></li>

                                    <?php
                                    $category = categorys();
                                    while ($row = (mysqli_fetch_array($category))) {
                                        $isActive = isset($_GET['view']) && $_GET['view'] === 'products-category' && isset($_GET['id']) && $_GET['id'] == $row['MaNCC'];
                                        echo '<li><a href="?view=products-category&id=' . $row['MaNCC'] . '" class="' . ($isActive ? 'active' : '') . '">' . $row['TenNCC'] . '</a></li>';
                                    } ?>

                                    <li><a href="?view=contact" class="<?php echo isset($_GET['view']) && $_GET['view'] === 'contact' ? 'active' : ''; ?>">Liên Hệ</a></li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </header>

        <!-- Sticky Header Script -->
        <script>
            document.addEventListener("DOMContentLoaded", function () {
                const header = document.getElementById('header');
                const topHeader = document.querySelector('.top-header');
                const navMenu = document.querySelector('.nav-menu');
                const mobileMenuToggle = document.querySelector('.mobile-menu-toggle');
                const mainNav = document.getElementById('main-nav');
                const navList = mainNav.querySelector('ul');

                // Handle sticky header
                window.addEventListener('scroll', function () {
                    if (window.scrollY > topHeader.offsetHeight) {
                        navMenu.classList.add('sticky-header');
                    } else {
                        navMenu.classList.remove('sticky-header');
                    }
                });

                // Mobile menu toggle
                mobileMenuToggle.addEventListener('click', function() {
                    navList.classList.toggle('show');
                });

                // Hide mobile menu on resize
                window.addEventListener('resize', function() {
                    if (window.innerWidth > 991 && navList.classList.contains('show')) {
                        navList.classList.remove('show');
                    }
                });

                // Hide mobile menu when clicking outside
                document.addEventListener('click', function(event) {
                    const isClickInside = mainNav.contains(event.target) || mobileMenuToggle.contains(event.target);

                    if (!isClickInside && navList.classList.contains('show')) {
                        navList.classList.remove('show');
                    }
                });
            });
        </script>