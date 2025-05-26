<?php
include_once('../../model/database.php');
	if(isset($_GET['them'])){
		$tengg=$_GET['tengg'];
		if ($_GET['tiengg']) { $tiengg=$_GET['tiengg']; } else { $tiengg=0; }
		$sql="INSERT INTO `phieugiamgia`( `TenGG`, `TienGG`)
							 VALUES ('$tengg',$tiengg)";
		$rs=mysqli_query($conn,$sql);
		if(isset($rs)){
			header('location:../index.php?action=phieugiamgia&thongbao=them');
		}
	}
	if (isset($_GET['xoa'])) {
        $magg = $_GET['MaGG'];
        $sql = "DELETE FROM `phieugiamgia` WHERE MaGG = '$magg'";
        $rs = mysqli_query($conn, $sql);

        if ($rs) {
            header('Location: ../index.php?action=phieugiamgia&thongbao=xoa');
            exit(); // tốt nên dừng sau khi redirect
        } else {
            echo "Lỗi khi xóa dữ liệu: " . mysqli_error($conn);
        }
    }

	if(isset($_GET['sua'])){
    		$magg=$_GET['MaGG'];
    		$tengg=$_GET['tengg'];
    		if ($_GET['tiengg']) { $tiengg=$_GET['tiengg']; } else { $tiengg=0; }
    		$sql="UPDATE `phieugiamgia` SET `TenGG`='$tengg',`TienGG`=$tiengg WHERE MaGG =$magg";
    		$rs=mysqli_query($conn,$sql);
    		if(isset($rs)){
    			header('location:../index.php?action=phieugiamgia&thongbao=sua');
    		}
    	}

?>