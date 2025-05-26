<?php
// xuly.php - Updated with fixes

include_once('../../model/database.php');

// Helper function to sanitize input
function sanitizeInput($input) {
    global $conn;
    return mysqli_real_escape_string($conn, trim($input));
}

// Helper function to validate date format and range
function validateDates($startDate, $endDate) {
    // Check if dates are in correct format
    if (!preg_match("/^\d{4}-\d{2}-\d{2}$/", $startDate) || !preg_match("/^\d{4}-\d{2}-\d{2}$/", $endDate)) {
        return false;
    }

    // Check if end date is after start date
    return strtotime($endDate) >= strtotime($startDate);
}

// Helper function to validate discount values
function validateDiscountValues($percentDiscount, $amountDiscount) {
    // Check if values are numeric and not negative
    if ((!empty($percentDiscount) && (!is_numeric($percentDiscount) || $percentDiscount < 0 || $percentDiscount > 100)) ||
        (!empty($amountDiscount) && (!is_numeric($amountDiscount) || $amountDiscount < 0))) {
        return false;
    }
    return true;
}

// Add new promotion
if(isset($_GET['them'])){
    $tkm = sanitizeInput($_GET['tkm']);
    $nbd = sanitizeInput($_GET['nbd']);
    $nkt = sanitizeInput($_GET['nkt']);
    $tg = !empty($_GET['t']) ? abs(floatval($_GET['t'])) : 0; // Ensure positive value
    $pt = !empty($_GET['pt']) ? abs(floatval($_GET['pt'])) : 0; // Ensure positive value

    // Limit percent discount to 100%
    if ($pt > 100) $pt = 100;

    $mt = sanitizeInput($_GET['mt']);

    // Validate dates
    if (!validateDates($nbd, $nkt)) {
        header('location:../index.php?action=khuyenmai&thongbao=loi-ngay');
        exit;
    }

    // Validate discount values
    if (!validateDiscountValues($pt, $tg)) {
        header('location:../index.php?action=khuyenmai&thongbao=loi-km');
        exit;
    }

    $sql = "INSERT INTO `khuyenmai`(`TenKM`, `MoTa`, `KM_PT`, `TienKM`, `NgayBD`, `NgayKT`)
            VALUES ('$tkm', '$mt', $pt, $tg, '$nbd', '$nkt')";

    $rs = mysqli_query($conn, $sql);
    if($rs){
        header('location:../index.php?action=khuyenmai&thongbao=them');
    } else {
        header('location:../index.php?action=khuyenmai&thongbao=loi');
    }
    exit;
}

// Delete promotion
if(isset($_GET['xoa'])){
    $id = intval($_GET['makm']); // Ensure integer value

    // Use transactions to ensure data consistency
    mysqli_begin_transaction($conn);

    try {
        // Delete from sanphamkhuyenmai first (foreign key constraint)
        $sql = "DELETE FROM `sanphamkhuyenmai` WHERE MaKM=$id";
        $rs = mysqli_query($conn, $sql);

        // Delete from khuyenmai
        $sql = "DELETE FROM `khuyenmai` WHERE MaKM=$id";
        $rs = mysqli_query($conn, $sql);

        mysqli_commit($conn);
        header('location:../index.php?action=khuyenmai&thongbao=xoa');
    } catch (Exception $e) {
        mysqli_rollback($conn);
        header('location:../index.php?action=khuyenmai&thongbao=loi');
    }
    exit;
}

// Update promotion
if(isset($_GET['sua'])){
    $makm = intval($_GET['makm']); // Ensure integer value
    $tkm = sanitizeInput($_GET['tkm']);
    $nbd = sanitizeInput($_GET['nbd']);
    $nkt = sanitizeInput($_GET['nkt']);
    $tg = !empty($_GET['t']) ? abs(floatval($_GET['t'])) : 0; // Ensure positive value
    $pt = !empty($_GET['pt']) ? abs(floatval($_GET['pt'])) : 0; // Ensure positive value

    // Limit percent discount to 100%
    if ($pt > 100) $pt = 100;

    $mt = sanitizeInput($_GET['mt']);

    // Validate dates
    if (!validateDates($nbd, $nkt)) {
        header('location:../index.php?action=khuyenmai&view=sua&makm='.$makm.'&thongbao=loi-ngay');
        exit;
    }

    // Validate discount values
    if (!validateDiscountValues($pt, $tg)) {
        header('location:../index.php?action=khuyenmai&view=sua&makm='.$makm.'&thongbao=loi-km');
        exit;
    }

    $sql = "UPDATE `khuyenmai` SET
            `TenKM`='$tkm',
            `TienKM`=$tg,
            `KM_PT`=$pt,
            `MoTa`='$mt',
            `NgayBD`='$nbd',
            `NgayKT`='$nkt'
            WHERE MaKM=$makm";

    $rs = mysqli_query($conn, $sql);
    if($rs){
        header('location:../index.php?action=khuyenmai&thongbao=sua');
    } else {
        header('location:../index.php?action=khuyenmai&thongbao=loi');
    }
    exit;
}

// Apply promotion to multiple products
if(isset($_GET['apply'])){
    if(!isset($_GET['chon']) || empty($_GET['chon'])) {
        header('location:../index.php?action=khuyenmai&view=apply&makm='.$_GET['makm'].'&thongbao=loi-chon');
        exit;
    }

    $makm = intval($_GET['makm']);
    $chon = $_GET['chon'];
    $success = true;

    foreach ($chon as $value) {
        $masp = sanitizeInput($value);

        // Check if this product is already applied to this promotion
        $check_sql = "SELECT COUNT(*) as count FROM `sanphamkhuyenmai` WHERE MaSP='$masp' AND MaKM=$makm";
        $check_rs = mysqli_query($conn, $check_sql);
        $check_row = mysqli_fetch_assoc($check_rs);

        // Only insert if not already exists
        if ($check_row['count'] == 0) {
            $sql = "INSERT INTO `sanphamkhuyenmai`(`MaSP`, `MaKM`) VALUES ('$masp', $makm)";
            $rs = mysqli_query($conn, $sql);
            if (!$rs) {
                $success = false;
            }
        }
    }

    if ($success) {
        header('location:../index.php?action=khuyenmai&thongbao=them');
    } else {
        header('location:../index.php?action=khuyenmai&thongbao=loi');
    }
    exit;
}

// Apply promotion to single product
if(isset($_GET['apply2'])){
    $makm = intval($_GET['makm']);
    $masp = sanitizeInput($_GET['masp']);

    // Check if this product is already applied to this promotion
    $check_sql = "SELECT COUNT(*) as count FROM `sanphamkhuyenmai` WHERE MaSP='$masp' AND MaKM=$makm";
    $check_rs = mysqli_query($conn, $check_sql);
    $check_row = mysqli_fetch_assoc($check_rs);

    // Only insert if not already exists
    if ($check_row['count'] == 0) {
        $sql = "INSERT INTO `sanphamkhuyenmai`(`MaSP`, `MaKM`) VALUES ('$masp', $makm)";
        $rs = mysqli_query($conn, $sql);

        if($rs){
            header('location:../index.php?action=khuyenmai&view=apply&makm='.$makm.'&thongbao=them');
        } else {
            header('location:../index.php?action=khuyenmai&view=apply&makm='.$makm.'&thongbao=loi');
        }
    } else {
        // Product already has this promotion
        header('location:../index.php?action=khuyenmai&view=apply&makm='.$makm.'&thongbao=da-km');
    }
    exit;
}
?>