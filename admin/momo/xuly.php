<?php
session_start();
include_once('../../model/database.php');

if(isset($_GET['action'])) {
    $action = $_GET['action'];
    switch ($action) {
        case 'duyet':
            $mahd = $_GET['mahd'];
            $admin = $_SESSION['admin'];
            $manv = $admin['MaNV'];

            // Tính ngày giao (ngày hiện tại + 1)
            $ngaygiao = date('Y-m-d H:i:s', strtotime('+1 day'));

            mysqli_begin_transaction($conn);
            try {
                // Kiểm tra trạng thái hiện tại
                $check_sql = "SELECT TinhTrang, TrangThai FROM hoadonmomo WHERE MaHD = ?";
                $check_stmt = mysqli_prepare($conn, $check_sql);
                mysqli_stmt_bind_param($check_stmt, "i", $mahd);
                mysqli_stmt_execute($check_stmt);
                $result = mysqli_stmt_get_result($check_stmt);
                $current_status = mysqli_fetch_assoc($result);

                if($current_status['TinhTrang'] == 'Đã thanh toán' && $current_status['TrangThai'] == 'Chưa duyệt') {
                    // Cập nhật trạng thái đơn hàng
                    $sql = "UPDATE hoadonmomo
                           SET NgayGiao = ?, MaNV = ?, TrangThai = 'Đã duyệt'
                           WHERE MaHD = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "sii", $ngaygiao, $manv, $mahd);

                    if(mysqli_stmt_execute($stmt)) {
                        mysqli_commit($conn);
                        header('location: ../index.php?action=momo');
                    } else {
                        throw new Exception("Lỗi cập nhật trạng thái");
                    }
                } else {
                    throw new Exception("Đơn hàng không hợp lệ để duyệt");
                }
            } catch(Exception $e) {
                mysqli_rollback($conn);
                echo "Lỗi: " . $e->getMessage();
            }
            break;

        case 'huy':
            $mahd = $_GET['mahd'];
            $admin = $_SESSION['admin'];
            $manv = $admin['MaNV'];

            mysqli_begin_transaction($conn);
            try {
                // Kiểm tra trạng thái hiện tại
                $check_sql = "SELECT TinhTrang, TrangThai FROM hoadonmomo WHERE MaHD = ?";
                $check_stmt = mysqli_prepare($conn, $check_sql);
                mysqli_stmt_bind_param($check_stmt, "i", $mahd);
                mysqli_stmt_execute($check_stmt);
                $result = mysqli_stmt_get_result($check_stmt);
                $current_status = mysqli_fetch_assoc($result);

                if($current_status['TrangThai'] == 'Chưa duyệt') {
                    // Cập nhật trạng thái đơn hàng
                    $sql = "UPDATE hoadonmomo
                           SET MaNV = ?, TinhTrang = 'Đã hủy', TrangThai = 'Đã hủy'
                           WHERE MaHD = ?";
                    $stmt = mysqli_prepare($conn, $sql);
                    mysqli_stmt_bind_param($stmt, "ii", $manv, $mahd);
                    mysqli_stmt_execute($stmt);

                    // Hoàn lại số lượng sản phẩm
                    $sql_items = "SELECT * FROM chitiethoadonmomo WHERE MaHD = ?";
                    $stmt_items = mysqli_prepare($conn, $sql_items);
                    mysqli_stmt_bind_param($stmt_items, "i", $mahd);
                    mysqli_stmt_execute($stmt_items);
                    $result = mysqli_stmt_get_result($stmt_items);

                    while($row = mysqli_fetch_assoc($result)) {
                        $sql_update = "UPDATE chitietsanpham
                                     SET SoLuong = SoLuong + ?
                                     WHERE MaSP = ? AND MaSize = ? AND MaMau = ?";
                        $stmt_update = mysqli_prepare($conn, $sql_update);
                        mysqli_stmt_bind_param($stmt_update, "iiss",
                            $row['SoLuong'], $row['MaSP'], $row['Size'], $row['MaMau']);
                        mysqli_stmt_execute($stmt_update);
                    }

                    mysqli_commit($conn);
                    header('location: ../index.php?action=momo');
                } else {
                    throw new Exception("Đơn hàng không thể hủy");
                }
            } catch(Exception $e) {
                mysqli_rollback($conn);
                echo "Lỗi: " . $e->getMessage();
            }
            break;

        default:
            header('location: ../index.php?action=momo');
            break;
    }
}
?>