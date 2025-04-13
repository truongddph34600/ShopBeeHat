<?php
include_once('../model/database.php');

$mahd = isset($_GET['mahd']) ? (int)$_GET['mahd'] : 0;

// Lấy chi tiết hóa đơn
$sql = "SELECT * FROM chitiethoadon WHERE MaHD = $mahd";
$rs = mysqli_query($conn, $sql);

// Lấy thông tin người nhận
$sql2 = "SELECT * FROM nguoinhan WHERE MaHD = $mahd";
$rs2 = mysqli_query($conn, $sql2);
$row2 = mysqli_fetch_array($rs2);

// Lấy thông tin khách hàng
$sql3 = "SELECT * FROM khachhang WHERE MaKH = (SELECT MaKH FROM hoadon WHERE MaHD = '$mahd')";
$rs3 = mysqli_query($conn, $sql3);
$row3 = mysqli_fetch_array($rs3);
?>

<div class="container-fluid">
    <div class="alert alert-primary">
        <h4 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2"></span>
            ADMIN - ONI SHOES <i class="fas fa-chevron-right" style="font-size: 18px"></i> Đơn Đặt Hàng
        </h4>
    </div>

    <div class="card">
        <br>
        <h4 class="text-center">HÓA ĐƠN</h4><br><hr>

        <div class="row">
            <?php
            function displayRow($label, $value) {
                echo '
                <div class="col-md-3"></div>
                <div class="col-md-3"><h5 style="font-family: Alata;">' . $label . '</h5></div>
                <div class="col-md-6"><h5 style="font-family: Alata;">: &#160;' . $value . '</h5></div>
                ';
            }

            displayRow('Mã Hóa Đơn', $mahd);
            displayRow('Tên Người Đặt', $row3['TenKH']);
            displayRow('Tên Người Nhận', $row2['TenNN']);
            displayRow('Địa Chỉ Người Nhận', $row2['DiaChiNN']);
            displayRow('SĐT Người Nhận', $row2['SDTNN']);
            ?>
        </div>

        <br><hr>

        <table class="table table-hover m-auto text-center" style="font-size: 13px;">
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
                $tongTien = 0;
                while ($row = mysqli_fetch_array($rs)) {
                    $tongTien += $row['ThanhTien'];
                    echo '
                    <tr>
                        <td>' . $row['MaSP'] . '</td>
                        <td>' . $row['SoLuong'] . '</td>
                        <td>' . number_format($row['DonGia']) . ' đ</td>
                        <td>' . number_format($row['ThanhTien']) . ' đ</td>
                        <td>' . $row['Size'] . '</td>
                        <td>' . $row['MaMau'] . '</td>
                    </tr>';
                }
                ?>
            </tbody>
        </table>

        <br><hr>
        <h5 class="text-center" style="font-family: Alata;">Tổng: <?php echo number_format($tongTien) . ' đ'; ?></h5>
        <br><hr>
    </div>
</div>
