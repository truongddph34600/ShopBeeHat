
<?php
include_once('../../model/database.php');


	//----------------------------------------
	//Cập nhập
	if(isset($_POST['them'])){
		$ten=$_POST['tenkh'];
		$email=$_POST['email'];
		$sdt=$_POST['sdt'];
		$dc=$_POST['dc'];
		$mk=$_POST['mk'];
		$sql="INSERT INTO `khachhang`( `TenKH`, `Email`, `SDT`, `DiaChi`, `MatKhau` ) VALUES ('$ten','$email','$sdt','$dc','$mk')";
		$rs=mysqli_query($conn,$sql);
		if(isset($rs)){
			header('location:../index.php?action=khachhang&thongbao=them');
		}else{
			header('location:../index.php?action=khachhang&thongbao=loi');
		}
	}
if(isset($_POST['sua'])){
		$makh=$_POST['makh'];
		$ten=$_POST['tenkh'];
		$email=$_POST['email'];
		$sdt=$_POST['sdt'];
		$dc=$_POST['dc'];
		$mk=$_POST['mk'];
		$sql="UPDATE `khachhang` SET `TenKH`='$ten',`Email`='$email',`SDT`='$sdt',`DiaChi`='$dc',`MatKhau`='$mk' WHERE `MaKH`='$makh'";
		$rs=mysqli_query($conn,$sql);
		if(isset($rs)){
			header('location:../index.php?action=khachhang&thongbao=sua');
		}else{
			header('location:../index.php?action=khachhang&thongbao=loi');
		}
	}

	//----------------------------------------
// xóa
if(isset($_GET['xoa'])){
		$makh=$_GET['makh'];
		$sql="delete  from khachhang where MaKH='$makh'";
		$rs=mysqli_query($conn,$sql);
		if(isset($rs)){
			header('location:../index.php?action=khachhang&thongbao=xoa');
		}else{
			header('location:../index.php?action=khachhang&thongbao=loi');
		}
	}