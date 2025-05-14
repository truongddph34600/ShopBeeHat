<?php
include_once('../../model/database.php');

if (isset($_GET['them'])) {
    $ten   = mysqli_real_escape_string($conn, $_GET['tenphieu']);
    $st    = floatval($_GET['sotien']);
    $sql   = "INSERT INTO phieugiamgia (TenPhieu, SoTien) VALUES ('$ten', $st)";
    mysqli_query($conn, $sql);
    header('Location: ../index.php?action=phieugiamgia&thongbao=them');
    exit;
}

if (isset($_GET['xoa'])) {
    $id    = intval($_GET['id']);
    $sql   = "DELETE FROM phieugiamgia WHERE id=$id";
    mysqli_query($conn, $sql);
    header('Location: ../index.php?action=phieugiamgia&thongbao=xoa');
    exit;
}

if (isset($_GET['sua'])) {
    $id    = intval($_GET['id']);
    $ten   = mysqli_real_escape_string($conn, $_GET['tenphieu']);
    $st    = floatval($_GET['sotien']);
    $sql   = "UPDATE phieugiamgia
              SET TenPhieu='$ten', SoTien=$st
              WHERE id=$id";
    mysqli_query($conn, $sql);
    header('Location: ../index.php?action=phieugiamgia&thongbao=sua');
    exit;
}
