<!-- Khai báo DOCTYPE và HTML mở đầu (đặt ở phần đầu file) -->
<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Admin Dashboard">
    <meta name="author" content="">
    <title>Dashboard</title>

    <!-- Favicon -->
    <link rel="icon" type="image/x-icon" href="template/img/favicon.ico">

    <!-- Font Awesome với phiên bản mới nhất -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">

    <!-- Bootstrap core CSS -->
    <link href="template/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles -->
    <link href="template/css/sb-admin-2.min.css" rel="stylesheet">

    <!-- Custom CSS Overrides -->
    <style>
        :root {
            --primary: #4e73df;
            --primary-dark: #3a5fc7;
            --secondary: #858796;
            --success: #1cc88a;
            --info: #36b9cc;
            --warning: #f6c23e;
            --danger: #e74a3b;
            --light: #f8f9fc;
            --dark: #5a5c69;
        }

        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f8f9fc;
            overflow-x: hidden; /* Ngăn chặn thanh cuộn ngang */
            width: 100%;
            max-width: 100%;
        }

        #wrapper {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
        }

        #content-wrapper {
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
        }

        /* Header Styling */
        .topbar {
            height: 70px;
            background: linear-gradient(135deg, #4e73df 0%, #224abe 100%);
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.1);
            border-bottom: none;
            width: 100%;
        }

        .navbar-nav .nav-item:hover {
            background-color: rgba(255, 255, 255, 0.1);
            border-radius: 5px;
        }

        .topbar .navbar-light .navbar-nav .nav-link {
            color: rgba(255, 255, 255, 0.8);
            transition: all 0.2s ease;
        }

        .topbar .navbar-light .navbar-nav .nav-link:hover {
            color: #ffffff;
        }

        .topbar-divider {
            border-right: 1px solid rgba(255, 255, 255, 0.3);
            height: 30px;
            margin: auto 15px;
        }

        .img-profile {
            height: 40px;
            width: 40px;
            border: 2px solid #fff;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }

        .dropdown-menu {
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            border: none;
            padding: 8px 0;
        }

        .dropdown-item {
            padding: 10px 20px;
            transition: all 0.2s ease;
        }

        .dropdown-item:hover {
            background-color: #f8f9fc;
        }

        .dropdown-item i {
            margin-right: 10px;
            color: var(--primary);
        }

        #sidebarToggleTop {
            color: #fff;
            border: none;
            background: rgba(255, 255, 255, 0.2);
            border-radius: 5px;
            padding: 8px 12px;
        }

        #sidebarToggleTop:hover {
            background: rgba(255, 255, 255, 0.3);
        }

        .navbar-search .form-control {
            border-radius: 20px 0 0 20px;
            border: none;
            padding-left: 20px;
            background-color: rgba(255, 255, 255, 0.2);
            color: #fff;
        }

        .navbar-search .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }

        .navbar-search .btn {
            border-radius: 0 20px 20px 0;
            background-color: rgba(255, 255, 255, 0.2);
            border: none;
        }

        .notification-counter {
            position: absolute;
            top: -5px;
            right: -5px;
            font-size: 10px;
            padding: 3px 6px;
            border-radius: 50%;
            background-color: #e74a3b;
            color: white;
        }

        /* User dropdown styles */
        .user-dropdown .text-gray-600 {
            color: #fff !important;
            font-weight: 500;
        }

        /* Notification styles */
        .notification-icon {
            position: relative;
            font-size: 1.2rem;
            color: rgba(255, 255, 255, 0.8);
            margin-right: 15px;
        }

        /* Breadcrumbs styling */
        .breadcrumb {
            background: none;
            padding: 0;
            margin: 20px 0;
        }

        .breadcrumb-item {
            color: var(--secondary);
        }

        .breadcrumb-item.active {
            color: var(--primary);
            font-weight: 500;
        }

        /* Content area styling */
        #content {
            padding: 20px;
            width: 100%;
            max-width: 100%;
            overflow-x: hidden;
        }

        /* Loại bỏ padding/margin ở container-fluid */
        .container-fluid {
            padding-right: 0;
            padding-left: 0;
            max-width: 100%;
        }

        /* Card styling */
        .card {
            border: none;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.05);
            transition: transform 0.3s, box-shadow 0.3s;
        }

        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
        }

        .card-header {
            background-color: #fff;
            border-bottom: 1px solid #edf2f9;
            border-top-left-radius: 10px !important;
            border-top-right-radius: 10px !important;
            font-weight: 600;
        }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <!-- Sidebar - Giả sử sidebar của bạn đã được include ở nơi khác -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">
            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light topbar mb-4 static-top shadow">
                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>
                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw text-white"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in" aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small" placeholder="Tìm kiếm..." aria-label="Search" aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Notifications -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw text-white"></i>
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header bg-primary">
                                    Thông báo
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">14/05/2025</div>
                                        <span class="font-weight-bold">Báo cáo mới đã sẵn sàng!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">13/05/2025</div>
                                        Đơn hàng mới cần xử lý
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">12/05/2025</div>
                                        Cảnh báo: cần cập nhật hệ thống
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Xem tất cả thông báo</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw text-white"></i>
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header bg-primary">
                                    Tin nhắn
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="template/img/avatar-1.jpg" alt="User Avatar">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Tôi cần thông tin về đơn hàng mới nhất.</div>
                                        <div class="small text-gray-500">Nguyễn Văn A · 58 phút trước</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="template/img/avatar-2.jpg" alt="User Avatar">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Báo cáo tháng đã được gửi.</div>
                                        <div class="small text-gray-500">Trần Thị B · 1 ngày trước</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Xem tất cả tin nhắn</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>

                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow user-dropdown">
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $nv['TenNV'] ?></span>
                                <img class="img-profile rounded-circle" src="template/img/avatar.png">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-primary"></i>
                                    Hồ sơ
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-primary"></i>
                                    Cài đặt
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-primary"></i>
                                    Hoạt động
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="logout.php" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-primary"></i>
                                    Đăng xuất
                                </a>
                            </div>
                        </li>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Breadcrumb -->
                <div class="container-fluid">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="index.php">Trang chủ</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Dashboard</li>
                        </ol>
                    </nav>
                </div>


