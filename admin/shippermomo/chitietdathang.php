
<?php
    include_once('../model/database.php');
    $mahd = $_GET['mahd'];
    $sql = "SELECT * FROM chitiethoadonmomo WHERE MaHD=$mahd";
    $rs = mysqli_query($conn, $sql);

    $sql2 = "SELECT * FROM nguoinhanmomo WHERE MaHD=$mahd";
    $rs2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_array($rs2);

    $sql3 = "SELECT k.* FROM khachhang k
             INNER JOIN hoadonmomo h ON k.MaKH = h.MaKH
             WHERE h.MaHD='$mahd'";
    $rs3 = mysqli_query($conn, $sql3);
    $row3 = mysqli_fetch_array($rs3);
?>

<div class="container-fluid">
    <div class="alert alert-primary">
        <h4 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2"></span>
            SHIPPER &#160;<i class="fas fa-chevron-right" style="font-size: 18px"></i>&#160; Chi Tiết Đơn MOMO
        </h4>
    </div>
    <br>

    <div class="card">
        <br>
        <h4 class="m-auto">CHI TIẾT ĐƠN HÀNG MOMO</h4>
        <br><hr>
        <div class="row">
            <div class="col-md-3"></div>
            <div class="col-md-3"><h5>Mã Hóa Đơn</h5></div>
            <div class="col-md-6"><h5>: &#160;<?php echo $mahd ?></h5></div>

            <div class="col-md-3"></div>
            <div class="col-md-3"><h5>Tên Người Đặt</h5></div>
            <div class="col-md-6"><h5>: &#160;<?php echo $row3['TenKH']; ?></h5></div>

            <div class="col-md-3"></div>
            <div class="col-md-3"><h5>Tên Người Nhận</h5></div>
            <div class="col-md-6"><h5>: &#160;<?php echo $row2['TenNN']; ?></h5></div>

            <div class="col-md-3"></div>
            <div class="col-md-3"><h5>Địa Chỉ Người Nhận</h5></div>
            <div class="col-md-6"><h5>: &#160;<?php echo $row2['DiaChiNN'] ?></h5></div>

            <div class="col-md-3"></div>
            <div class="col-md-3"><h5>SĐT Người Nhận</h5></div>
            <div class="col-md-6"><h5>: &#160;<?php echo $row2['SDTNN'] ?></h5></div>
        </div>
        <br><hr>

        <table class="table table-hover m-auto text-center">
            <thead class="badge-info">
                <tr>
                    <th>Mã Sản Phẩm</th>
                    <th>Số Lượng</th>
                    <th>Đơn Giá</th>
                    <th>Thành Tiền</th>
                    <th>Size</th>
                    <th>Màu</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $total = 0;
                while($row = mysqli_fetch_array($rs)) {
                    $total += $row['ThanhTien'];
                ?>
                <tr>
                    <td><?php echo $row['MaSP']; ?></td>
                    <td><?php echo $row['SoLuong']; ?></td>
                    <td><?php echo number_format($row['DonGia']).' đ'; ?></td>
                    <td><?php echo number_format($row['ThanhTien']).' đ'; ?></td>
                    <td><?php echo $row['Size']; ?></td>
                    <td><?php echo $row['MaMau']; ?></td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
        <br><hr>
        <h5 class="m-auto">Tổng : <?php echo number_format($total).' đ'; ?></h5>
        <br><hr>
    </div>
</div>