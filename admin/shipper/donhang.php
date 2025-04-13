<?php
    // Lấy thông tin nhân viên đang đăng nhập
    $am = $_SESSION['admin'];
    $nv = $am['MaNV'];

    // Danh sách đơn hàng chưa giao (đã duyệt)
    $sql = "SELECT * FROM hoadon WHERE NgayGiao IS NOT NULL AND TinhTrang = 'Đã duyệt' ORDER BY NgayGiao ASC";
    $rs = mysqli_query($conn, $sql);    
    $dem = mysqli_num_rows($rs);

    // Tổng đơn hàng đã giao
    $sql3 = "SELECT * FROM hoadon WHERE MaNVGH = '$nv' AND TinhTrang = 'hoàn thành' ORDER BY NgayGiao ASC";
    $rs13 = mysqli_query($conn, $sql3);
    $order2 = mysqli_num_rows($rs13);

    // Tổng đơn hàng đã giao trong tháng hiện tại
    date_default_timezone_set('Asia/Ho_Chi_Minh');
    $date = getdate();
    $thang = $date['year'] . '-' . str_pad($date['mon'], 2, '0', STR_PAD_LEFT); // đảm bảo tháng 01, 02,...
    $sql32 = "SELECT * FROM hoadon WHERE MaNVGH = '$nv' AND TinhTrang = 'hoàn thành' 
              AND (NgayGiao BETWEEN '$thang-01' AND '$thang-31') ORDER BY NgayGiao ASC";
    $rs132 = mysqli_query($conn, $sql32);
    $order = mysqli_num_rows($rs132);

    // Trạng thái lọc đơn hàng
    $dk = $_POST['dk'] ?? 'Chưa Giao';
?>

<div class="container-fluid">
    <div class="alert alert-primary">
        <h4 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2"></span>
            ADMIN &#160;<i class="fas fa-chevron-right" style="font-size: 18px"></i>&#160; Giao Hàng &#160;<i class="fas fa-chevron-right" style="font-size: 18px"></i>
        </h4>
    </div>
    <br>

    <div class="row">
        <form action="?action=giaohang" method="POST" class="col-md-4 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <button type="submit" name="dk" value="Chưa Giao" class="btn btn-primary btn-sm" style="font-family: Comfortaa;">Chờ xử lý</button>
                    <span class="counter counter-sm"><?php echo $dem ?></span>
                    <button type="submit" name="dk" value="Đã Giao" class="btn btn-primary btn-sm" style="font-family: Comfortaa;">Đã Giao</button>
                </div>
            </div>
        </form>

        <!-- Đơn hàng tháng -->
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-warning shadow h-100 py-0">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Đơn Hàng (Tháng)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $order ?></div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Đơn hàng tất cả -->
        <div class="col-xl-4 col-md-4 mb-4">
            <div class="card border-left-warning shadow h-100 py-0">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">Đơn Hàng (ALL)</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800"><?php echo $order2 ?></div>
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

    <?php if ($dk === 'Chưa Giao'): ?>
        <div class="card">
            <div class="card-body">
                <table class="table table-hover m-auto text-center">
                    <thead class="badge-info">
                        <tr>
                            <th>Mã Hóa Đơn</th>
                            <th>Ngày Đặt</th>
                            <th>Ngày Giao</th>
                            <th>Tổng Tiền</th>
                            <th>Tình trạng</th>
                            <th></th>
                            <th colspan="2"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($rs)): ?>
                            <tr>
                                <td><?= $row['MaHD'] ?></td>
                                <td><?= $row['NgayDat'] ?></td>
                                <td><?= $row['NgayGiao'] ?></td>
                                <td><?= number_format($row['TongTien']) ?>.đ</td>
                                <td><?= $row['TinhTrang'] ?></td>
                                <td><a class="text-info" href="index.php?action=giaohang&view=ctgh&mahd=<?= $row['MaHD'] ?>">Chi tiết</a></td>
                                <td>
                                    <?php if ($row['TinhTrang'] === 'Đã duyệt'): ?>
                                        <a class="text-info" href="shipper/xuly.php?action=duyet&mahd=<?= $row['MaHD'] ?>">Đã Giao Hàng <i class="fas fa-check"></i></a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    
    <?php elseif ($dk === 'Đã Giao'): ?>
        <?php
            $sql12 = "SELECT * FROM hoadon WHERE MaNVGH = '$nv' AND TinhTrang = 'hoàn thành' ORDER BY NgayGiao ASC";
            $rs12 = mysqli_query($conn, $sql12);
        ?>
        <div class="card">
            <div class="card-body">
                <table class="table table-hover m-auto text-center" style="font-size: 13px;">
                    <thead class="badge-info">
                        <tr>
                            <th>Mã Hóa Đơn</th>
                            <th>Ngày Đặt</th>
                            <th>Ngày Giao</th>
                            <th>Tổng Tiền</th>
                            <th>Tình trạng</th>
                            <th>Chi Tiết</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row12 = mysqli_fetch_array($rs12)): ?>
                            <tr>
                                <td><?= $row12['MaHD'] ?></td>
                                <td><?= $row12['NgayDat'] ?></td>
                                <td><?= $row12['NgayGiao'] ?></td>
                                <td><?= number_format($row12['TongTien']) ?>.đ</td>
                                <td><?= $row12['TinhTrang'] ?></td>
                                <td><a href="index.php?action=giaohang&view=ctgh&mahd=<?= $row12['MaHD'] ?>">Chi tiết</a></td>
                            </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    <?php endif; ?>
</div>
