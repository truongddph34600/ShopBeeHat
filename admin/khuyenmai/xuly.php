<?php
include_once('../../model/database.php');

// Bật để hiển thị lỗi khi cần
define('DEBUG_MODE', false);

// Hàm escape chuỗi
function esc($conn, $str) {
    return mysqli_real_escape_string($conn, trim($str));
}

// Thêm khuyến mãi
if (isset($_GET['them'])) {
    $tkm = esc($conn, $_GET['tkm']);
    $nbd = esc($conn, $_GET['nbd']);
    $nkt = esc($conn, $_GET['nkt']);
    $tg  = isset($_GET['t']) ? floatval($_GET['t']) : 0;
    $pt  = isset($_GET['pt']) ? floatval($_GET['pt']) : 0;
    $mt  = esc($conn, $_GET['mt']);

    $sql = "INSERT INTO khuyenmai (TenKM, MoTa, KM_PT, TienKM, NgayBD, NgayKT)
            VALUES ('$tkm', '$mt', $pt, $tg, '$nbd', '$nkt')";
    $rs = mysqli_query($conn, $sql);

    if ($rs) {
        header('Location: ../index.php?action=khuyenmai&thongbao=them');
        exit;
    } elseif (DEBUG_MODE) {
        echo "Lỗi thêm khuyến mãi: " . mysqli_error($conn);
    }
}

// Xóa khuyến mãi
if (isset($_GET['xoa'])) {
    $id = intval($_GET['makm']);

    // Xóa bảng phụ trước
    mysqli_query($conn, "DELETE FROM sanphamkhuyenmai WHERE MaKM = $id");

    // Xóa chính
    $rs = mysqli_query($conn, "DELETE FROM khuyenmai WHERE MaKM = $id");

    if ($rs) {
        header('Location: ../index.php?action=khuyenmai&thongbao=xoa');
        exit;
    } elseif (DEBUG_MODE) {
        echo "Lỗi xóa khuyến mãi: " . mysqli_error($conn);
    }
}

// Cập nhật khuyến mãi
if (isset($_GET['sua'])) {
    $makm = intval($_GET['makm']);
    $tkm  = esc($conn, $_GET['tkm']);
    $nbd  = esc($conn, $_GET['nbd']);
    $nkt  = esc($conn, $_GET['nkt']);
    $tg   = isset($_GET['t']) ? floatval($_GET['t']) : 0;
    $pt   = isset($_GET['pt']) ? floatval($_GET['pt']) : 0;
    $mt   = esc($conn, $_GET['mt']);

    $sql = "UPDATE khuyenmai 
            SET TenKM = '$tkm', MoTa = '$mt', KM_PT = $pt, TienKM = $tg, NgayBD = '$nbd', NgayKT = '$nkt'
            WHERE MaKM = $makm";
    $rs = mysqli_query($conn, $sql);

    if ($rs) {
        header('Location: ../index.php?action=khuyenmai&thongbao=sua');
        exit;
    } elseif (DEBUG_MODE) {
        echo "Lỗi cập nhật khuyến mãi: " . mysqli_error($conn);
    }
}

// Áp dụng khuyến mãi cho nhiều sản phẩm
if (isset($_GET['apply'])) {
    $makm = intval($_GET['makm']);
    $chon = $_GET['chon'] ?? [];

    foreach ($chon as $masp) {
        $masp = intval($masp);
        $sql = "INSERT INTO sanphamkhuyenmai (MaSP, MaKM) VALUES ($masp, $makm)";
        mysqli_query($conn, $sql);
    }

    header('Location: ../index.php?action=khuyenmai&thongbao=them');
    exit;
}

// Áp dụng khuyến mãi cho 1 sản phẩm
if (isset($_GET['apply2'])) {
    $makm = intval($_GET['makm']);
    $masp = intval($_GET['masp']);

    $sql = "INSERT INTO sanphamkhuyenmai (MaSP, MaKM) VALUES ($masp, $makm)";
    $rs = mysqli_query($conn, $sql);

    if ($rs) {
        header('Location: ../index.php?action=khuyenmai&thongbao=them');
        exit;
    } elseif (DEBUG_MODE) {
        echo "Lỗi áp dụng khuyến mãi: " . mysqli_error($conn);
    }
}
?>
