<?php
include_once('../model/database.php');
$date = getdate();
$thang = $date['year'].'-'.$date['mon'];

// Đếm tổng đơn hàng MOMO trong tháng
$sql32 = "SELECT COUNT(*) as total FROM hoadonmomo WHERE NgayDat BETWEEN '$thang-01' AND '$thang-31'";
$rs132 = mysqli_query($conn, $sql32);
$row_count = mysqli_fetch_assoc($rs132);
$total_orders = $row_count['total'];

// Đếm đơn chưa duyệt
$sql_pending = "SELECT COUNT(*) as pending FROM hoadonmomo WHERE TrangThai = 'Chưa duyệt' AND TinhTrang = 'Đã thanh toán'";
$rs_pending = mysqli_query($conn, $sql_pending);
$row_pending = mysqli_fetch_assoc($rs_pending);
$pending_orders = $row_pending['pending'];
?>

<div class="container-fluid">
    <div class="alert alert-primary">
        <h4 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
            </span> ADMIN &#160;<i class="fas fa-chevron-right" style="font-size: 18px"></i>&#160; Đơn Hàng MOMO
        </h4>
    </div>
    <br>

    <!-- Thống kê -->
    <div class="row">
        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Đơn Hàng Chờ Duyệt
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo $pending_orders; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-6 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Tổng Đơn Hàng (Tháng)
                            </div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">
                                <?php echo $total_orders; ?>
                            </div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bảng đơn hàng -->
    <div class="card">
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-info">
                        <tr class="text-center">
                            <th>#</th>
                            <th>Mã ĐH</th>
                            <th>Mã Momo</th>
                            <th>Khách hàng</th>
                            <th>Ngày đặt</th>
                            <th>Tổng tiền</th>
                            <th>Tình Trạng</th>
                            <th>Trạng Thái</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $sql = "SELECT h.*, k.TenKH
                               FROM hoadonmomo h
                               INNER JOIN khachhang k ON h.MaKH = k.MaKH
                               ORDER BY h.NgayDat DESC";
                        $rs = mysqli_query($conn, $sql);
                        $i = 1;
                        while($row = mysqli_fetch_assoc($rs)) {
                        ?>
                        <tr>
                            <td class="text-center"><?php echo $i++; ?></td>
                            <td class="text-center"><?php echo $row['MaHD']; ?></td>
                            <td class="text-center"><?php echo $row['MaMomo']; ?></td>
                            <td><?php echo $row['TenKH']; ?></td>
                            <td class="text-center"><?php echo date('d/m/Y H:i', strtotime($row['NgayDat'])); ?></td>
                            <td class="text-right"><?php echo number_format($row['TongTien']); ?>đ</td>
                            <td class="text-center">
                                <span class="badge badge-<?php echo get_status_class($row['TinhTrang']); ?>">
                                    <?php echo $row['TinhTrang']; ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <span class="badge bg-<?php echo get_order_status_class($row['TrangThai']); ?>">
                                    <?php echo $row['TrangThai']; ?>
                                </span>
                            </td>
                            <td class="text-center">
                                <a href="index.php?action=momo&view=chitiet&mahd=<?php echo $row['MaHD']; ?>"
                                   class="btn btn-info btn-sm">
                                    Chi tiết
                                </a>
                                <?php if ($row['TrangThai'] == 'Chưa duyệt' && $row['TinhTrang'] == 'Đã thanh toán') { ?>
                                    <a href="momo/xuly.php?action=duyet&mahd=<?php echo $row['MaHD']; ?>"
                                       class="btn btn-success btn-sm"
                                       onclick="return confirm('Xác nhận duyệt đơn hàng này?')">
                                        Duyệt
                                    </a>
                                    <a href="momo/xuly.php?action=huy&mahd=<?php echo $row['MaHD']; ?>"
                                       class="btn btn-danger btn-sm"
                                       onclick="return confirm('Xác nhận hủy đơn hàng này?')">
                                        Hủy
                                    </a>
                                <?php } ?>
                            </td>
                        </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?php
function get_status_class($status) {
    switch($status) {
        case 'Chờ thanh toán':
            return 'warning';
        case 'Đã thanh toán':
            return 'info';
        case 'Hoàn thành':
            return 'success';
        case 'Đã hủy':
            return 'danger';
        default:
            return 'secondary';
    }
}

function get_order_status_class($status) {
    switch($status) {
        case 'Chưa duyệt':
            return 'warning';
        case 'Đã duyệt':
            return 'info';
        case 'Hoàn thành':
            return 'success';
        case 'Đã hủy':
            return 'danger';
        default:
            return 'secondary';
    }
}
?>