
<?php
include_once('../../model/database.php');
	// Thêm màu
	if(isset($_GET['themdm'])){
		$tendm=$_GET['tendm'];
		$sql="insert into nhacc(TenNCC) values(N'$tendm')";
		$rs=mysqli_query($conn,$sql);
		if(isset($rs)){
			header('location:../index.php?action=danhmuc&view=themdm&thongbao=them');
		}else{
			header('location:../index.php?action=danhmuc&view=themdm&thongbao=loi');
		}
	}
	//----------------------------------------
	//Cập nhập
	if(isset($_GET['suadm'])){
		$madm=$_GET['madm'];
		$tendm=$_GET['tendm'];
		$sql="UPDATE `nhacc` SET `TenNCC`= N'$tendm' where MaNCC=$madm";
		$rs=mysqli_query($conn,$sql);
		if(isset($rs)){
			header('location:../index.php?action=danhmuc&view=themdm&thongbao=sua');
		}else{
			header('location:../index.php?action=danhmuc&view=themdm&thongbao=loi');
		}
	}

	//----------------------------------------
// xóa màu
if(isset($_GET['xoa'])){
		$madm=$_GET['madm'];
		$sql="delete  from nhacc where MaNCC='$madm'";
		$rs=mysqli_query($conn,$sql);
		if(isset($rs)){
			header('location:../index.php?action=danhmuc&view=themdm&thongbao=xoa');
		}else{
			header('location:../index.php?action=danhmuc&view=themdm&thongbao=loi');
		}
	}