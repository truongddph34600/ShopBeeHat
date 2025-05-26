<?php
    $am = $_SESSION['admin'];
    $nv = $am['MaNV'];
    // Lấy đơn hàng đã duyệt chưa có người giao
    $sql = "SELECT * FROM hoadonmomo WHERE TrangThai='Đã duyệt' AND TinhTrang='Đã thanh toán' ORDER BY NgayGiao ASC";
    $rs = mysqli_query($conn, $sql);
    $dem = mysqli_num_rows($rs);

    // Đơn hàng đã hoàn thành của shipper này
    $sql3 = "SELECT * FROM hoadonmomo WHERE MaNV='$nv' AND TrangThai='Hoàn thành' ORDER BY NgayGiao ASC";
    $rs13 = mysqli_query($conn, $sql3);
    $order2 = mysqli_num_rows($rs13);

    // Thống kê theo tháng
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $date = getdate();
    $thang = $date['year'].'-'.$date['mon'];
    $sql32 = "SELECT * FROM hoadonmomo
              WHERE MaNV='$nv'
              AND TrangThai='Hoàn thành'
              AND (NgayGiao BETWEEN '$thang-01' AND '$thang-31')";
    $rs132 = mysqli_query($conn, $sql32);
    $order = mysqli_num_rows($rs132);
?>

<div class="container-fluid">
    <div class="alert alert-primary">
        <h4 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2"></span>
            SHIPPER &#160;<i class="fas fa-chevron-right" style="font-size: 18px"></i>&#160; Giao Hàng MOMO
        </h4>
    </div>
    <br>
    <div class="row">
        <form action="?action=giaohangmomo" method="POST" class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <button type="submit" name="dk" value="Chưa Giao" class="btn btn-primary btn-sm">
                        Chờ xử lý
                    </button>
                    <span class="counter counter-sm"><?php echo $dem ?></span>
                    <button type="submit" name="dk" value="Đã Giao" class="btn btn-primary btn-sm">
                        Đã Giao
                    </button>
                </div>
            </div>
        </form>

        <!-- Thống kê tháng -->
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-warning shadow h-100 py-0">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Đơn Hàng MOMO (Tháng)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo $order ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Thống kê tổng -->
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-warning shadow h-100 py-0">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Đơn Hàng MOMO (Tổng)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo $order2 ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <br>

    <?php if(isset($_POST['dk'])) {
        $dk = $_POST['dk'];
    } else {
        $dk = 'Chưa Giao';
    }

    if($dk == 'Chưa Giao') { ?>
        <div class="card">
            <div class="card-body">
                <table class="table table-hover m-auto text-center">
                    <thead class="badge-info">
                        <tr>
                            <th>Mã Hóa Đơn</th>
                            <th>Ngày Đặt</th>
                            <th>Ngày Giao</th>
                            <th>Tổng Tiền</th>
                            <th>Trạng thái</th>
                            <th>Thanh toán</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while($row = mysqli_fetch_array($rs)) { ?>
                            <tr>
                                <td><?php echo $row['MaHD']; ?></td>
                                <td><?php echo $row['NgayDat']; ?></td>
                                <td><?php echo $row['NgayGiao']; ?></td>
                                <td><?php echo number_format($row['TongTien']).'.đ'; ?></td>
                                <td><?php echo $row['TrangThai']; ?></td>
                                <td><?php echo $row['TinhTrang']; ?></td>
                                <td>
                                    <a class="text-info" href="index.php?action=giaohangmomo&view=ctgh&mahd=<?php echo $row['MaHD']; ?>">
                                        Chi tiết
                                    </a>
                                    <?php if($row['TrangThai'] === "Đã duyệt"){ ?>
                                        <a class="text-info" href="shippermomo/xuly.php?action=giao&mahd=<?php echo $row['MaHD']; ?>">
                                            Đã Giao Hàng <i class="fas fa-check"></i>
                                        </a>
                                    <?php } ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } else { ?>
        <div class="card">
            <div class="card-body">
                <table class="table table-hover m-auto text-center">
                    <thead class="badge-info">
                        <tr>
                            <th>Mã Hóa Đơn</th>
                            <th>Ngày Đặt</th>
                            <th>Ngày Giao</th>
                            <th>Tổng Tiền</th>
                            <th>Trạng thái</th>
                            <th>Thanh toán</th>
                            <th>Chi tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql_completed = "SELECT * FROM hoadonmomo
                                        WHERE MaNV='$nv' AND TrangThai='Hoàn thành'
                                        ORDER BY NgayGiao DESC";
                        $rs_completed = mysqli_query($conn, $sql_completed);
                        while($row = mysqli_fetch_array($rs_completed)) { ?>
                            <tr>
                                <td><?php echo $row['MaHD']; ?></td>
                                <td><?php echo $row['NgayDat']; ?></td>
                                <td><?php echo $row['NgayGiao']; ?></td>
                                <td><?php echo number_format($row['TongTien']).'.đ'; ?></td>
                                <td><?php echo $row['TrangThai']; ?></td>
                                <td><?php echo $row['TinhTrang']; ?></td>
                                <td>
                                    <a href="index.php?action=giaohangmomo&view=ctgh&mahd=<?php echo $row['MaHD']; ?>">
                                        Chi tiết
                                    </a>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php } ?>
</div>