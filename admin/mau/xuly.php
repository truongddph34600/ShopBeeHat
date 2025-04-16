<?php
include_once('../../model/database.php');

// Hàm chuyển hướng và kết thúc script
function redirect($url) {
    header("Location: $url");
    exit();
}

// ===== THÊM MÀU =====
if (isset($_GET['themmau'])) {
    $mamau = trim($_GET['mamau'] ?? '');

    if ($mamau === '') {
        redirect('../index.php?action=mau&view=themmau&thongbao=trong');
    }

    // Kiểm tra màu đã tồn tại chưa
    $check = mysqli_query($conn, "SELECT * FROM mau WHERE MaMau = '$mamau'");
    if (mysqli_num_rows($check) > 0) {
        redirect('../index.php?action=mau&view=themmau&thongbao=trung');
    }

    $sql = "INSERT INTO mau(MaMau) VALUES ('$mamau')";
    $rs = mysqli_query($conn, $sql);

    if ($rs) {
        redirect('../index.php?action=mau&view=themmau&thongbao=them');
    } else {
        redirect('../index.php?action=mau&view=themmau&thongbao=loi');
    }
}

// ===== SỬA MÀU =====
if (isset($_GET['suamau'])) {
    $id = trim($_GET['id'] ?? '');
    $mamau = trim($_GET['mamau'] ?? '');

    if ($mamau === '' || $id === '') {
        redirect('../index.php?action=mau&view=themmau&thongbao=trong');
    }

    // Kiểm tra trùng nếu đổi tên
    if ($id !== $mamau) {
        $check = mysqli_query($conn, "SELECT * FROM mau WHERE MaMau = '$mamau'");
        if (mysqli_num_rows($check) > 0) {
            redirect('../index.php?action=mau&view=themmau&thongbao=trung');
        }
    }

    $sql = "UPDATE mau SET MaMau = '$mamau' WHERE MaMau = '$id'";
    $rs = mysqli_query($conn, $sql);

    if ($rs) {
        redirect('../index.php?action=mau&view=themmau&thongbao=sua');
    } else {
        redirect('../index.php?action=mau&view=themmau&thongbao=loi');
    }
}

// ===== XOÁ MÀU =====
if (isset($_GET['xoa'])) {
    $mamau = trim($_GET['mamau'] ?? '');

    if ($mamau === '') {
        redirect('../index.php?action=mau&view=themmau&thongbao=trong');
    }

    $sql = "DELETE FROM mau WHERE MaMau = '$mamau'";
    $rs = mysqli_query($conn, $sql);

    if ($rs) {
        redirect('../index.php?action=mau&view=themmau&thongbao=xoa');
    } else {
        redirect('../index.php?action=mau&view=themmau&thongbao=loi');
    }
}
?>
