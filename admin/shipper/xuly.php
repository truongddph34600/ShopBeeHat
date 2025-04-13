<?php 
session_start();
include_once('../../model/database.php');
date_default_timezone_set('Asia/Ho_Chi_Minh');

if (isset($_GET['action']) && $_GET['action'] === 'duyet') {
    $mahd = isset($_GET['mahd']) ? (int)$_GET['mahd'] : 0;

    if ($mahd <= 0 || !isset($_SESSION['admin'])) {
        // Redirect hoặc xử lý lỗi tùy ý
        header('location:../index.php?action=giaohang&error=invalid');
        exit;
    }

    $admin = $_SESSION['admin'];
    $manv = $admin['MaNV'];

    $sql = "UPDATE hoadon SET MaNVGH = ?, TinhTrang = 'hoàn thành' WHERE MaHD = ?";
    $stmt = mysqli_prepare($conn, $sql);

    if ($stmt) {
        mysqli_stmt_bind_param($stmt, 'ii', $manv, $mahd);
        $result = mysqli_stmt_execute($stmt);
        mysqli_stmt_close($stmt);

        if ($result) {
            header('location:../index.php?action=giaohang');
            exit;
        } else {
            // Lỗi truy vấn
            header('location:../index.php?action=giaohang&error=updatefail');
            exit;
        }
    } else {
        // Lỗi prepare
        header('location:../index.php?action=giaohang&error=preparefail');
        exit;
    }
}
?>
