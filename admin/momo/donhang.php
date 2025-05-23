<?php
include_once('../model/database.php');
$date = getdate();
$thang = $date['year'].'-'.$date['mon'];
$nam = $date['year'];

// Đếm tổng đơn hàng MOMO trong tháng
$sql32 = "SELECT COUNT(*) as total FROM hoadonmomo WHERE NgayDat BETWEEN '".$thang."-00' AND '".$thang."-31'";
$rs132 = mysqli_query($conn, $sql32);
$row_count = mysqli_fetch_assoc($rs132);
$total_orders = $row_count['total'];
?>

<div class="container-fluid">
    <div class="alert alert-primary">
        <h4 class="page-title">
            <span class="page-title-icon bg-gradient-primary text-white mr-2">
            </span> ADMIN &#160;<i class="fas fa-chevron-right" style="font-size: 18px"></i>&#160; Đơn Hàng MOMO
        </h4>
    </div>
    <br>
       <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="table-info">
                            <tr class="text-center">
                                <th>#</th>
                                <th>Mã ĐH</th>
                                <th>Khách hàng</th>
                                <th>Ngày đặt</th>
                                <th>Tổng tiền</th>
                                <th>Tình Trạng</th>
                                <th>Trạng Thái</th>
                                <th>Hành động</th>
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
                                <td><?php echo $row['TenKH']; ?></td>
                                <td class="text-center"><?php echo date('d/m/Y H:i', strtotime($row['NgayDat'])); ?></td>
                                <td class="text-right"><?php echo number_format($row['TongTien']); ?>đ</td>
                                <td class="text-center">
                                    <span class="badge badge-<?php echo get_status_class($row['TinhTrang']); ?>">
                                        <?php echo $row['TinhTrang']; ?>
                                    </span>
                                </td>
                            <td>
                                                            <?php
                                                            if ($row['TrangThai'] == 'Chưa duyệt') {
                                                                echo '<span class="badge bg-warning">Chưa duyệt</span>';
                                                            } elseif ($row['TrangThai'] == 'Đã duyệt') {
                                                                echo '<span class="badge bg-info">Đã duyệt</span>';
                                                            } elseif ($row['TrangThai'] == 'Đã hủy') {
                                                                echo '<span class="badge bg-danger">Đã hủy</span>';
                                                            } elseif ($row['TrangThai'] == 'Hoàn thành') {
                                                                echo '<span class="badge bg-success">Hoàn thành</span>';
                                                            }
                                                            ?>
                                                        </td>
                            <td>
                                                            <a href="index.php?action=momo&view=chitiet&mahd=<?php echo $row['MaHD']; ?>" class="btn btn-info btn-sm">Chi tiết</a>
                                                            <?php if ($row['TrangThai'] == 'Chưa duyệt') { ?>
                                                                <a href="momo/xuly.php?action=duyet&mahd=<?php echo $row['MaHD']; ?>"
                                                                   class="btn btn-success btn-sm"
                                                                   onclick="return confirm('Bạn có chắc muốn duyệt đơn hàng này?')">
                                                                    Duyệt
                                                                </a>
                                                                <a href="momo/xuly.php?action=huy&mahd=<?php echo $row['MaHD']; ?>"
                                                                   class="btn btn-danger btn-sm"
                                                                   onclick="return confirm('Bạn có chắc muốn hủy đơn hàng này?')">
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
</div>

<?php
function get_status_class($status) {
    switch($status) {
        case 'Chờ thanh toán':
            return 'warning';
        case 'Đã thanh toán':
            return 'info';
        case 'hoàn thành':
            return 'success';
        case 'Đã hủy':
            return 'danger';
        default:
            return 'secondary';
    }
}
?>