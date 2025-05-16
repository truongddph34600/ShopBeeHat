<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Admin - Dashboard</title>
    <!-- Custom fonts for this template-->

    <link href="/beehat/webroot/font/Font Awesome/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="template/mdi/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="template/cssfont.css" rel="stylesheet">

    <link href="template/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="template/bootstrap/mdb.lite.min.css" rel="stylesheet">
    <script src="/beehat/webroot/jquery/jquery.js"></script>
    <?php
  if (isset($_SESSION['admin'])) {
      $nv=$_SESSION['admin'];
  }?>
<style>
        :root {
            --primary: #4e73df;
            --primary-dark: #3a56a5;
            --secondary: #858796;
            --success: #1cc88a;
            --info: #36b9cc;
            --warning: #f6c23e;
            --danger: #e74a3b;
            --light: #f8f9fc;
            --dark: #5a5c69;
        }

        /* Custom Scrollbar */
        ::-webkit-scrollbar {
            width: 5px;
        }

        ::-webkit-scrollbar-track {
            background: rgba(255, 255, 255, 0.1);
        }

        ::-webkit-scrollbar-thumb {
            background: rgba(255, 255, 255, 0.3);
            border-radius: 3px;
        }

        ::-webkit-scrollbar-thumb:hover {
            background: rgba(255, 255, 255, 0.5);
        }

        /* Sidebar Styles */


        .sidebar .sidebar-brand {
            padding: 1.5rem 1rem;
            text-align: center;
        }

        .sidebar-logo {
            max-width: 120px;
            margin-bottom: 1rem;
        }

        .sidebar-divider {
            border-top: 1px solid rgba(255, 255, 255, 0.15);
            margin: 1rem 1rem;
        }

        .sidebar .nav-item {
            position: relative;
            margin-bottom: 0.25rem;
        }

        .sidebar .nav-item .nav-link {
            display: flex;
            align-items: center;
            padding: 0.75rem 1rem;
            margin: 0 0.5rem;
            border-radius: 0.35rem;
            color: rgba(255, 255, 255, 0.8);
            transition: all 0.2s ease;
        }

        .sidebar .nav-item .nav-link:hover {
            color: #fff;
            background: rgba(255, 255, 255, 0.1);
            transform: translateX(5px);
        }

        .sidebar .nav-item .nav-link.active {
            color: #fff;
            background: rgba(255, 255, 255, 0.2);
            font-weight: 600;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .sidebar .nav-item .nav-link i,
        .sidebar .nav-item .nav-link .mdi {
            font-size: 1.1rem;
            margin-right: 0.75rem;
            width: 1.5rem;
            text-align: center;
        }

        .sidebar .nav-item .nav-link span {
            font-size: 0.85rem;
            letter-spacing: 0.5px;
        }

        .sidebar .nav-item .nav-link .badge-container {
            margin-left: auto;
        }

        .sidebar .nav-item .nav-link .badge {
            font-size: 0.65rem;
            padding: 0.35em 0.65em;
            border-radius: 10px;
            background-color: var(--danger);
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.2);
            animation: pulse 2s infinite;
        }

        @keyframes pulse {
            0% {
                box-shadow: 0 0 0 0 rgba(231, 74, 59, 0.7);
            }
            70% {
                box-shadow: 0 0 0 5px rgba(231, 74, 59, 0);
            }
            100% {
                box-shadow: 0 0 0 0 rgba(231, 74, 59, 0);
            }
        }

        /* Submenu Styles */
        .sidebar .collapse-inner {
            border-radius: 0.35rem;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
            transition: all 0.2s ease;
        }

        .sidebar .collapse-item {
            padding: 0.5rem 1rem;
            margin: 0 0.5rem;
            display: block;
            color: var(--dark);
            font-size: 0.85rem;
            border-radius: 0.25rem;
            transition: all 0.15s ease;
        }

        .sidebar .collapse-item:hover {
            background-color: #f8f9fc;
            color: var(--primary);
            transform: translateX(3px);
        }

        /* Admin Brand Section */
        .admin-brand {
            padding: 1.5rem 1rem;
            text-align: center;
            background: rgba(0, 0, 0, 0.1);
            border-radius: 0.5rem;
            margin: 1rem;
            box-shadow: inset 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .admin-brand h4 {
            color: white;
            font-size: 1.5rem;
            margin: 0;
            font-weight: 600;
            letter-spacing: 1px;
            text-transform: uppercase;
        }

        .admin-brand .subtitle {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.75rem;
            margin-top: 0.25rem;
        }

        /* User Profile Section */
        .user-profile {
            display: flex;
            align-items: center;
            padding: 1rem;
            background: rgba(0, 0, 0, 0.1);
            margin: 1rem;
            border-radius: 0.5rem;
        }

        .user-avatar {
            width: 40px;
            height: 40px;
            border-radius: 50%;
            background: linear-gradient(45deg, #36b9cc, #1cc88a);
            display: flex;
            align-items: center;
            justify-content: center;
            color: white;
            font-weight: bold;
            margin-right: 0.75rem;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.2);
        }

        .user-info {
            flex: 1;
        }

        .user-name {
            color: white;
            font-weight: 600;
            font-size: 0.9rem;
            margin: 0;
        }

        .user-role {
            color: rgba(255, 255, 255, 0.7);
            font-size: 0.75rem;
            margin: 0;
        }
    </style>
</head>

<body id="page-top">
    <!-- Page Wrapper -->
    <div id="wrapper">
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
            <br>
            <!-- Sidebar - Brand -->
            <div class="text-center d-none d-md-inline">
                <h4 class="text-center text-white fw-bold">Admin</h4>
            </div>

            <hr class=" sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index.php">
                    <i class="mdi mdi-home menu-icon"></i>
                    <span>Dashboard</span></a>
            </li>

            <hr class="sidebar-divider">

            <!-- Orders Pending -->
            <?php
        $sql="SELECT * FROM hoadon WHERE TinhTrang = 'chưa duyệt'";
        $rs=mysqli_query($conn,$sql);
        $dem=mysqli_num_rows($rs);
      ?>
            <li class="nav-item">
                <a class="nav-link" href="?action=xldathang">
                    <i class="mdi mdi-cart menu-icon"></i>
                    <span>Đơn Đặt Hàng <sup style="border-radius: 10px;" class="badge-danger ">
                            &#160;<?php echo $dem ?>
                            &#160;</sup></span></a>
            </li>
<hr class="sidebar-divider d-none d-md-block">
            <!-- Shipping -->
            <?php
        $sql="SELECT * FROM hoadon WHERE NgayGiao is not null and TinhTrang='Đã duyệt' ORDER BY NgayGiao ASc";
        $rs=mysqli_query($conn,$sql);
        $dem=mysqli_num_rows($rs);
      ?>
            <li class="nav-item">
                <a class="nav-link" href="?action=giaohang">
                    <i class="mdi mdi-truck-delivery menu-icon"></i>
                    <span>Giao Hàng <sup style="border-radius: 10px;" class="badge-danger ">
                            &#160;<?php echo $dem ?>
                            &#160;</sup></span></a>
            </li>
<hr class="sidebar-divider d-none d-md-block">
            <!-- Kho Hàng -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
                    aria-expanded="true" aria-controls="collapseTwo">
                    <i class="mdi mdi-eye menu-icon"></i>
                    <span>Kho Hàng</span>
                </a>
                <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="?action=kho&view=xemdh"> Xem đơn hàng</a>
                        <a class="collapse-item" href="?action=kho&view=nhapkho"> Xuất / Nhập kho</a>
                        <a class="collapse-item" href="?action=kho&view=nhatky"> Nhật ký Nhập Kho</a>
                        <a class="collapse-item" href="?action=kho&view=nhatkyx">Nhật ký Xuất Kho</a>
                    </div>
                </div>
            </li>
<hr class="sidebar-divider d-none d-md-block">
            <!-- Danh Mục -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
                    aria-expanded="true" aria-controls="collapsePages">
                    <i class="mdi mdi-format-list-bulleted menu-icon"></i>
                    <span>Danh Mục</span>
                </a>
                <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="?action=danhmuc&">Danh Sách</a>
                        <a class="collapse-item" href="?action=danhmuc&view=them">Thêm</a>
                    </div>
                </div>
            </li>
<hr class="sidebar-divider d-none d-md-block">
            <!-- Sản Phẩm -->
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages1"
                    aria-expanded="true" aria-controls="collapsePages1">
                    <i class="mdi mdi-cube-outline menu-icon"></i>
                    <span>Sản Phẩm</span>
                </a>
                <div id="collapsePages1" class="collapse" aria-labelledby="headingPages"
                    data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        <a class="collapse-item" href="?action=sanpham">Danh Sách</a>
                        <a class="collapse-item" href="?action=sanpham&view=themsp">Thêm</a>
                        <a class="collapse-item" href="?action=mau&view=them">Thêm màu</a>
                    </div>
                </div>
            </li>
<hr class="sidebar-divider d-none d-md-block">
            <!-- Khuyến Mãi -->
            <li class="nav-item">
                <a class="nav-link" href="?action=khuyenmai">
                    <i class="mdi mdi-sale menu-icon"></i>
                    <span>Khuyến Mãi</span></a>
            </li>
<hr class="sidebar-divider d-none d-md-block">
         <!-- Phiếu giảm giá -->
                    <li class="nav-item">
                        <a class="nav-link" href="?action=phieugiamgia">
                            <i class="mdi mdi-ticket-percent menu-icon"></i>
                            <span>Phiếu Giảm Giá</span></a>
                    </li>
<hr class="sidebar-divider d-none d-md-block">
            <!-- Doanh Thu -->
            <li class="nav-item">
                <a class="nav-link" href="?action=danhthu">
                    <i class="mdi mdi-cash-multiple menu-icon"></i>
                    <span>Doanh Thu</span></a>
            </li>
<hr class="sidebar-divider d-none d-md-block">
        <!-- Khách hàng -->
                    <li class="nav-item">
                        <a class="nav-link" href="?action=khachhang">
                            <i class="mdi mdi-account menu-icon"></i>

                            <span>Khách hàng</span></a>
                    </li>
<hr class="sidebar-divider d-none d-md-block">
            <!-- Quản lý nhân viên -->
            <li class="nav-item">
                <a class="nav-link" href="?action=nhanvien">
                    <i class="mdi mdi-account-group menu-icon"></i>
                    <span>Quản lý nhân viên</span></a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">

        </ul>
