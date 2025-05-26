<?php
session_start();
include_once('../../model/database.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');

if(isset($_GET['action'])){
    $action = $_GET['action'];
    switch ($action) {
        case 'giao':
            $mahd = $_GET['mahd'];
            $admin = $_SESSION['admin'];
            $manv = $admin['MaNV'];

            // Bắt đầu transaction
            mysqli_begin_transaction($conn);

            try {
                // Cập nhật trạng thái đơn hàng
                $sql = "UPDATE hoadonmomo
                       SET MaNV = ?, TrangThai = 'Hoàn thành'
                       WHERE MaHD = ? AND TinhTrang = 'Đã thanh toán'";
                $stmt = mysqli_prepare($conn, $sql);
                mysqli_stmt_bind_param($stmt, "ii", $manv, $mahd);

                if(mysqli_stmt_execute($stmt)) {
                    mysqli_commit($conn);
                    header('location: ../index.php?action=giaohangmomo');
                } else {
                                        throw new Exception("Lỗi cập nhật trạng thái");
                                    }
                                } catch(Exception $e) {
                                    mysqli_rollback($conn);
                                    echo "Lỗi: " . $e->getMessage();
                                }
                                break;

                            default:
                                header('location: ../index.php?action=giaohangmomo');
                                break;
                        }
                    }
                    ?>