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

    <link href="/onishoes/webroot/font/Font Awesome/css/all.min.css" rel="stylesheet" type="text/css">
    <link href="template/mdi/css/materialdesignicons.min.css" rel="stylesheet">
    <link href="template/cssfont.css" rel="stylesheet">

    <link href="template/css/sb-admin-2.min.css" rel="stylesheet">
    <link href="template/bootstrap/mdb.lite.min.css" rel="stylesheet">
    <script src="/onishoes/webroot/jquery/jquery.js"></script>
    <?php 
  if (isset($_SESSION['admin'])) {
      $nv=$_SESSION['admin'];
  }?>

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

            <!-- Khuyến Mãi -->
            <li class="nav-item">
                <a class="nav-link" href="?action=khuyenmai">
                    <i class="mdi mdi-sale menu-icon"></i>
                    <span>Khuyến Mãi</span></a>
            </li>

            <!-- Doanh Thu -->
            <li class="nav-item">
                <a class="nav-link" href="?action=danhthu">
                    <i class="mdi mdi-cash-multiple menu-icon"></i>
                    <span>Doanh Thu</span></a>
            </li>

            <!-- Quản lý nhân viên -->
            <li class="nav-item">
                <a class="nav-link" href="?action=nhanvien">
                    <i class="mdi mdi-account-group menu-icon"></i>
                    <span>Quản lý nhân viên</span></a>
            </li>
            <hr class="sidebar-divider d-none d-md-block">

        </ul>
